<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function read(int $id)
    {
        $notification = Notification::where('user_id', user()->id)
            ->findOrFail($id);

        $notification->read_at = now();

        $notification->save();

        return redirect($notification->url ?? url()->previous());
    }

    public function deleteAll()
    {
        Notification::where('user_id', user()->id)->delete();

        return back();
    }
}
