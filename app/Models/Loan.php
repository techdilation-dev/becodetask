<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * to get actual status in readable format
     */
    protected $appends = ['loan_status'];

    /**
     * get all repayments schedules
     */
    public function repays(){
        return $this->hasMany(LoanRepayment::class, 'loan_id');
    }

    /**
     * get human readable status
     */
    public function getLoanStatusAttribute(){
        return $this->status == 0 ? 'Pending' : ($this->status == 1 ? 'Approved' : 'Paid');
    }
}
