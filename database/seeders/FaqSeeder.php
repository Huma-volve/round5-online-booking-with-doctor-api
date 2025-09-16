<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder {
    public function run(): void {
        $faqs = [
            [
                'question' => 'How do I book an appointment?',
                'answer' => 'Log in, search for a doctor, pick an available slot, and confirm.',
                'order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'Can I cancel or reschedule?',
                'answer' => 'Yes. From My Appointments you can cancel or reschedule within policy limits.',
                'order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'What payment methods are supported?',
                'answer' => 'We support secure online payments via trusted gateways. Details appear before confirmation.',
                'order' => 3,
                'status' => 'active',
            ],
            [
                'question' => 'Is my data secure?',
                'answer' => 'Yes. We follow industry best practices and our Privacy Policy to protect your data.',
                'order' => 4,
                'status' => 'active',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}


