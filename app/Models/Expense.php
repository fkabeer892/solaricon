<?php

namespace App\Models;

use App\Model;

class Expense extends Model
{

    protected $fillable = [
        "expense_type_id",
        "branch_id",
        "name",
        "amount",
        "status_id"
    ];

    function status()
    {
        return $this->belongsTo(Status::class);
    }

    function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }

    function branch()
    {
        return $this->belongsTo(Branch::class);
    }


}
