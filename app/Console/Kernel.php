<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Product;
use App\Models\Bid;
use App\Models\Purchase;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $products = Product::all();
            foreach($products as $product){
                $endDate = \Carbon\Carbon::create($product->end_time);
                $now = \Carbon\Carbon::create(\Carbon\Carbon::now());
                if($now->greaterThan($endDate)){
                    $max_bid = Bid::where('product_id',$product->id)->orderBy('bid_price','DESC')->first();
                    $purchase_exists = Purchase::where('product_id',$max_bid->product_id)->get();
                    if(Count($purchase_exists) === 0){
                        Purchase::create([
                            'user_id' => $max_bid->user_id,
                            'product_id' => $max_bid->product_id,
                            'price' => $max_bid->bid_price,
                        ]);
                        $product->sold = 1;
                        $product->save();
                        info('Winner added for a product');
                    }
                    
                }

            }
        })->everyMinute();;
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
