<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
DB::table('payments')->insert([
    [
        'user_id'        => 1, // حط ID مستخدم موجود عندك
        'amount'         => 100.00,
        'payment_method' => 'Cash',
        'status'         => 'completed',
        'transaction_id' => 1001,
        'created_at'     => now(),
        'updated_at'     => now(),
    ],
    [
        'user_id'        => 1,
        'amount'         => 200.00,
        'payment_method' => 'Credit Card',
        'status'         => 'completed',
        'transaction_id' => 1002,
        'created_at'     => now(),
        'updated_at'     => now(),
    ],
    [
        'user_id'        => 1,
        'amount'         => 300.00,
        'payment_method' => 'PayPal',
        'status'         => 'completed',
        'transaction_id' => 1003,
        'created_at'     => now(),
        'updated_at'     => now(),
    ],
]);


        
    }
}
