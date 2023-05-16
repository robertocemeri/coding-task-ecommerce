<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Services\NotificationService;

use Illuminate\Http\JsonResponse;
use App\Traits\APITrait;

class NotificationController extends Controller
{
    use APITrait;

    private NotificationService $notificationService;

    public function __construct(
        NotificationService $notificationService,
    ) {

        $this->notificationService = $notificationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function get_all_notifications_for_user ()
    {
        //
        try {
            return $this->notificationService->get_all_notifications_for_user();
        } catch (\Exception $e) {
            return $this->apiResponse([], 500, $e->getMessage());
        }
    }

    public function get_unread_notifications_counts_for_user()
    {
        //
        try {
            return $this->notificationService->get_unread_notifications_counts_for_user();
        } catch (\Exception $e) {
            return $this->apiResponse([], 500, $e->getMessage());
        }
    }

    public function read_all_notifications_for_user()
    {
        //
        try {
            return $this->notificationService->read_all_notifications_for_user();
        } catch (\Exception $e) {
            return $this->apiResponse([], 500, $e->getMessage());
        }
    }
}
