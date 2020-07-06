<?php

namespace App\Observers;

class UserObserver
{
    public function creating($user){
        $user->search = false;
    }
}
