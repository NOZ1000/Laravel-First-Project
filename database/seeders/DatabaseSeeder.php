<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Product;
use App\User;
use App\Order;
use App\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(50)->create();

        $users = User::factory(20)->create();
        
        $orders = Order::factory(10)
                    ->make()
                    ->each(function ($order) use ($users) {
                        $order->customer_id = $users->random()->id;
                        $order->save();

                        $payment = Payment::factory()->make();
                        
                        // $payment->order_id = $order->id;
                        // $payment->save;

                        $order->payment()->save($payment); # more coolest solution to store payment with realtion to order
                    });
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
