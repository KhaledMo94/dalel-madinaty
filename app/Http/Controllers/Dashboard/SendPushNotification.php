<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\SendFirebaseNotificationJob;
use App\Models\User;
use App\Services\FirebasePushNotifications;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;

class SendPushNotification extends Controller
{
    public function notifyUsers()
    {
        return view('admin.notifications.notify-users');
    }

    // public function notifyListingOwner()
    // {
    //     return view('admin.notifications.notify-listing-owners');
    // }

    public function sendUsersNotification(Request $request, FirebasePushNotifications $notification)
    {
        $request->validate([
            'title'                 => 'required|string',
            'description'           => 'required|string',
        ]);

        $users_tokens = User::whereDoesntHave('roles')
            ->whereNotNull('fcm_token')
            ->pluck('fcm_token')->toArray();

        foreach ($users_tokens as $token) {
            dispatch(new SendFirebaseNotificationJob($request->title , $request->description , $token));
        }

        return redirect()->route('dashboard')
            ->with('success', __('Notifications Sent Successfully'));
    }

}
