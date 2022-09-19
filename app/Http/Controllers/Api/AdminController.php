<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * to approve the loans
     */
    public function approval(Request $request){
        if(!\Auth::user()->hasRole('Admin'))
            return response()->json([
                'message' => 'You are not authorize for this action'
            ], 401);

        $this->validate($request, [
            'loan_id' => 'required|numeric|exists:loans,id'
        ]);

        $loan = Loan::where('id', $request->loan_id)->first();
        $loan->status = 1;
        $loan->save();

        foreach($loan->repays as $repay){
            $repay->status = 1;
            $repay->save();
        }

        return response()->json([
            'message' => 'Loan Approved'
        ], 200);
    }
}
