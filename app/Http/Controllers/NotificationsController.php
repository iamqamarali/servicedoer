<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function markAsRead($notification){
        $notification = Notification::findOrFail($notification);
        $notification->read = true;
        $notification->save();
        return "done";
    }

}
