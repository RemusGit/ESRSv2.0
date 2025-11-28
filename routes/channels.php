<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\AccountsTab;
/*
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
*/
/*
Broadcast::channel('App.Models.AccountsTab.{account_empid}', function ($user, $accountID) {
    return $user->account_empid === $accountID;
});
*/

Broadcast::channel('user.{account_empid}', function ($user, $accountID) {
    //$removeDash = str_replace('-', '', $accountID); 

    return (string) $user->account_empid === (string) $accountID;
});