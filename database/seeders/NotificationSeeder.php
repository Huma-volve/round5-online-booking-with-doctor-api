<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        $notificationTypes = [
            'appointment_reminder' => [
                'title' => 'Appointment Reminder',
                'message' => 'You have a medical appointment tomorrow with Dr. Ahmed Mohamed at 10:00 AM',
                'icon' => 'calendar',
                'color' => 'blue'
            ],
            'appointment_confirmed' => [
                'title' => 'Appointment Confirmed',
                'message' => 'Your medical appointment with Dr. Sara Ahmed has been confirmed for next Thursday',
                'icon' => 'check-circle',
                'color' => 'green'
            ],
            'appointment_cancelled' => [
                'title' => 'Appointment Cancelled',
                'message' => 'Your medical appointment with Dr. Mohamed Ali has been cancelled. You can book a new appointment',
                'icon' => 'x-circle',
                'color' => 'red'
            ],
            'payment_success' => [
                'title' => 'Payment Successful',
                'message' => 'Amount of 150 SAR has been successfully deducted from your account for medical consultation',
                'icon' => 'credit-card',
                'color' => 'green'
            ],
            'new_message' => [
                'title' => 'New Message',
                'message' => 'You have a new message from Dr. Ahmed Mohamed regarding your health condition',
                'icon' => 'message-circle',
                'color' => 'blue'
            ],
            'prescription_ready' => [
                'title' => 'Prescription Ready',
                'message' => 'Your prescription from Dr. Sara Ahmed is ready for download',
                'icon' => 'file-text',
                'color' => 'purple'
            ],
            'test_results' => [
                'title' => 'Test Results Available',
                'message' => 'Your medical test results are now available for viewing and download',
                'icon' => 'clipboard',
                'color' => 'orange'
            ],
            'system_maintenance' => [
                'title' => 'System Maintenance',
                'message' => 'System maintenance will be performed on Sunday from 2:00 AM to 4:00 AM',
                'icon' => 'settings',
                'color' => 'yellow'
            ]
        ];

        foreach ($users as $user) {
            // إنشاء 3-8 إشعارات لكل مستخدم
            $notificationCount = rand(3, 8);
            
            for ($i = 0; $i < $notificationCount; $i++) {
                $type = array_rand($notificationTypes);
                $notificationData = $notificationTypes[$type];
                
                // إضافة بعض الإشعارات كمقروءة
                $isRead = rand(0, 1) === 1;
                
                Notification::create([
                    'id' => Str::uuid(),
                    'type' => 'App\\Notifications\\' . ucfirst($type) . 'Notification',
                    'notifiable_type' => User::class,
                    'notifiable_id' => $user->id,
                    'data' => [
                        'title' => $notificationData['title'],
                        'message' => $notificationData['message'],
                        'icon' => $notificationData['icon'],
                        'color' => $notificationData['color'],
                        'type' => $type,
                        'created_at' => now()->subDays(rand(0, 30))->toISOString()
                    ],
                    'read_at' => $isRead ? now()->subDays(rand(0, 7)) : null,
                    'created_at' => now()->subDays(rand(0, 30)),
                    'updated_at' => now()->subDays(rand(0, 30))
                ]);
            }
        }

        $this->command->info('Notifications seeded successfully!');
    }
} 