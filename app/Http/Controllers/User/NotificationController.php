<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->with('order.orderItems.menu')
            ->latest()
            ->get();

        // Mark all as read when page is viewed
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('user.notifications.index', compact('notifications'));
    }
}
