<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\NotificationResource;
    use App\Models\Notification;
    use Illuminate\Http\JsonResponse;

    class NotificationController extends Controller {
        /**
         * List all user notifications
         *
         * @return JsonResponse
         */
        public function index(): JsonResponse {
            $count = authUser()->unreadNotifications->count();

            return response()->json([
                "count" =>  $count,
                "data" =>  NotificationResource::collection(authUser()->notifications->take(7)),
                "message" => "Notification List"
            ]);
        }

        /**
         * Mark Notification as readed
         *
         * @param Notification $notification
         * @return JsonResponse
         */
        public function unRead(Notification $notification): JsonResponse {
            $notification->markAsRead();

            return response()->json([
                "data" =>  NotificationResource::make($notification),
                "message" => "Notification readed"
            ]);;
        }

        /**
         * Mark Notification as readed all
         *
         * @param Notification $notification
         * @return JsonResponse
         */
        public function readAll(): JsonResponse {
            authUser()->unreadNotifications->markAsRead();

            return response()->json([
                "message" => "Notifications readed"
            ]);;
        }

        /**
         * Count all active notifications
         *
         * @return JsonResponse
         */
        public function count(): JsonResponse {
            $count = authUser()->unreadNotifications->count();

            return response()->json([
                "count" =>  $count,
                "message" => "active notification count successfully"
            ]);
        }

        /**
         * Delete specified notification
         *
         * @param Notification $notification
         * @return JsonResponse
         */
        public function destroy(Notification $notification): JsonResponse {
            $notification->delete();

            return response()->json([
                "message" => "Notification deleted"
            ]);
        }
    }
