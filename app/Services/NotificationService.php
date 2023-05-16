<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Bid;
use App\Models\Purchase;
use App\Models\ProductCategory;
use App\Traits\APITrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationService
{
    use APITrait;

    public function get_all_notifications_for_user()
    {
        $notification = Notification::where('user_id',auth()->user()->id)->get();
        return $this->apiResponse($notification);
    }
    public function get_unread_notifications_counts_for_user()
    {
        $notifications = Notification::where('user_id',auth()->user()->id)->where('is_read',0)->get();
        return $this->apiResponse(Count($notifications));
    }
    public function read_all_notifications_for_user()
    {
       Notification::where('user_id', auth()->user()->id)
       ->update([
           'is_read' => true
        ]);
        return $this->apiResponse(true);
    }
}
