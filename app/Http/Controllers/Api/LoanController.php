<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Http\Request;
use Auth;

class LoanController extends Controller
{
    /***
     * Get loan list
     */
    public function index(){
        if(!\Auth::user()->hasRole('Customer'))
            return response()->json([
                'message' => 'You are not authorize for this action'
            ], 401);

        return response()->json(Loan::where('user_id', Auth::id())->with('repays')->get(), 200); 
    }

    /**
     * create loan
     */
    public function create(Request $request){
        if(!\Auth::user()->hasRole('Customer'))
            return response()->json([
                'message' => 'You are not authorize for this action'
            ], 401);

        $this->validate($request, [
            'amount' => 'required|numeric|max:10000',
            'term' => 'required|numeric|min:1|max:1000',
            'date' => 'required|date|after:today'
        ]);

        $loan = new Loan();
        $loan->user_id = Auth::id();
        $loan->amount = $request->amount;
        $loan->term = $request->term;
        $loan->date = date('Y-m-d', strtotime($request->date));
        $loan->save();
        $emi = $request->amount / $request->term;
        for($i = 1; $i <= $request->term; $i++){
            $repay = new LoanRepayment();
            $repay->loan_id = $loan->id;
            $repay->amount = $emi;
            $repay->date = date('Y-m-d', strtotime($request->date.' + '.($i*7).' days'));
            $repay->save();
        }
        return response()->json([
            'loan_id' => $loan->id,
            'message' => 'Loan Created'
        ], 200);
    }

    /***
     * loan repayment
     */
    public function repay(Request $request){
        if(!\Auth::user()->hasRole('Customer'))
            return response()->json([
                'message' => 'You are not authorize for this action'
            ], 401);
        
        $repay = LoanRepayment::where('id', $request->repay_id)->first();
        $this->validate($request, [
            'repay_id' => 'required|numeric|exists:loan_repayments,id',
            'amount' => 'required|numeric|max:10000|min:'.($repay ? $repay->amount : 1)
        ]);
        $loan = Loan::where('id', $repay->loan_id)->first();

        if($loan->status != 1)
            return response()->json([
                'message' => 'Your loan is not approved yet!'
            ], 422);

        $repay->status = 2;
        $repay->save();

        
        if(!count($loan->repays->where('status', 1))){
            $loan->status = 2;
            $loan->save();
        }

        return response()->json([
            'message' => 'EMI Credited'
        ], 200);
    }
}
