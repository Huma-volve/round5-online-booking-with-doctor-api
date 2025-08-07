<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Traits\API\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
    use apiTrait;

    /**
     * Get all notifications for the authenticated user
     */
    public function index(Request $request) {
        try {
            $user = Auth::user();

            $query = Notification::where('notifiable_type', 'App\Models\User')
                ->where('notifiable_id', $user->id);

            // Filter by read status
            if ($request->has('read')) {
                if ($request->read == 'true') {
                    $query->whereNotNull('read_at');
                } else {
                    $query->whereNull('read_at');
                }
            }

            // Filter by type
            if ($request->has('type')) {
                $query->where('type', 'like', '%' . $request->type . '%');
            }

            $notifications = $query->orderBy('created_at', 'desc')
                ->paginate($request->get('per_page', 15));

            // Transform notifications data
            $notifications->getCollection()->transform(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->data['title'] ?? 'إشعار',
                    'message' => $notification->data['message'] ?? '',
                    'icon' => $notification->data['icon'] ?? 'bell',
                    'color' => $notification->data['color'] ?? 'blue',
                    'type' => $notification->data['type'] ?? 'general',
                    'is_read' => !is_null($notification->read_at),
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at,
                    'created_at_formatted' => $notification->created_at->diffForHumans()
                ];
            });

            return $this->successResponse(
                $notifications,
                'Notifications retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                null,
                'Error occurred while retrieving notifications: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get unread notifications count
     */
    public function unreadCount() {
        try {
            $user = Auth::user();

            $count = Notification::where('notifiable_type', 'App\Models\User')
                ->where('notifiable_id', $user->id)
                ->whereNull('read_at')
                ->count();

            return $this->successResponse(
                ['count' => $count],
                'Unread notifications count retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                null,
                'Error occurred while retrieving unread notifications count: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id) {
        try {
            $user = Auth::user();

            $notification = Notification::where('id', $id)
                ->where('notifiable_type', 'App\Models\User')
                ->where('notifiable_id', $user->id)
                ->first();

            if (!$notification) {
                return $this->errorResponse(
                    null,
                    'Notification not found',
                    404
                );
            }

            $notification->update(['read_at' => now()]);

            return $this->successResponse(
                [
                    'id' => $notification->id,
                    'is_read' => true,
                    'read_at' => $notification->read_at
                ],
                'Notification marked as read successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                null,
                'Error occurred while marking notification as read: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead() {
        try {
            $user = Auth::user();

            $updatedCount = Notification::where('notifiable_type', 'App\Models\User')
                ->where('notifiable_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            return $this->successResponse(
                ['updated_count' => $updatedCount],
                'All notifications marked as read successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                null,
                'Error occurred while marking notifications as read: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Delete a notification
     */
    public function destroy($id) {
        try {
            $user = Auth::user();

            $notification = Notification::where('id', $id)
                ->where('notifiable_type', 'App\Models\User')
                ->where('notifiable_id', $user->id)
                ->first();

            if (!$notification) {
                return $this->errorResponse(
                    null,
                    'Notification not found',
                    404
                );
            }

            $notification->delete();

            return $this->successResponse(
                null,
                'Notification deleted successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                null,
                'Error occurred while deleting notification: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Delete all notifications
     */
    public function destroyAll() {
        try {
            $user = Auth::user();

            $deletedCount = Notification::where('notifiable_type', 'App\Models\User')
                ->where('notifiable_id', $user->id)
                ->delete();

            return $this->successResponse(
                ['deleted_count' => $deletedCount],
                'All notifications deleted successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                null,
                'Error occurred while deleting notifications: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get notification by ID
     */
    public function show($id) {
        try {
            $user = Auth::user();

            $notification = Notification::where('id', $id)
                ->where('notifiable_type', 'App\Models\User')
                ->where('notifiable_id', $user->id)
                ->first();

            if (!$notification) {
                return $this->errorResponse(
                    null,
                    'Notification not found',
                    404
                );
            }

            $notificationData = [
                'id' => $notification->id,
                'title' => $notification->data['title'] ?? 'Notification',
                'message' => $notification->data['message'] ?? '',
                'icon' => $notification->data['icon'] ?? 'bell',
                'color' => $notification->data['color'] ?? 'blue',
                'type' => $notification->data['type'] ?? 'general',
                'is_read' => !is_null($notification->read_at),
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at,
                'created_at_formatted' => $notification->created_at->diffForHumans()
            ];

            return $this->successResponse(
                $notificationData,
                'Notification retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                null,
                'Error occurred while retrieving notification: ' . $e->getMessage(),
                500
            );
        }
    }
}
