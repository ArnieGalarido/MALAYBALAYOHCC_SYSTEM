<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications() {
        return response()->json([
            'notifications' => Auth::user()->notifications,
            'notify_count' => Auth::user()->notify_count
        ], 200);
    }

    public function read($id) {
        $notification = Notification::find($id);
        $notification->update([
            'read' => true,
        ]);
        return response()->json([
            'notifications' => Auth::user()->notifications,
        ], 200);
    }
}
