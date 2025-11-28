<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AccountsTab extends Authenticatable
{
    protected $table = "accounts_tab";


    protected $primaryKey = 'account_empid';
    public $incrementing = false; // if your empid is string
    protected $keyType = 'string'; // or 'int' if numeric
    

    public function getAuthIdentifierName()
    {
        return 'account_empid';
    }

    public function getAuthIdentifier()
    {
        return (string) $this->attributes['account_empid'];
    }

}