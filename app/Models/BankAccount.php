<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'bank_name',
        'branch_name',
        'account_holder',
        'iban',
        'swift_code',
        'currency',
        'logo',
        'is_active',
        'order',
    ];
}
