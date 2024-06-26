<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Bid;
use App\Models\Notification;
use App\Models\Purchase;
use App\Models\ProductCategory;
use App\Traits\APITrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductService
{
    use APITrait;

    public function get_all_products()
    {
        $products = Product::with('categories','bids')->get();
        return $this->apiResponse($products);
    }
    public function get_all_products_by_user()
    {
        $products = Product::where('user_id',auth()->user()->id)->with('categories','bids')->get();
        return $this->apiResponse($products);
    }
    
    public function get_all_purchases_by_user()
    {
        $purchases = Purchase::where('user_id',auth()->user()->id)->with('product')->get();
        return $this->apiResponse($purchases);
    }

    public function store_product(object $data)
    {
        // Store product
        $product = Product::create([
            'title' => $data->title,
            'user_id' => auth()->user()->id,
            'description' => $data->description,
            'picture' => $data->picture,
            'start_price' => $data->start_price,
            'buy_now_price' => $data->buy_now_price,
            'price_steps' => $data->price_steps,
            'start_time' => $data->start_time,
            'end_time' => $data->end_time,
        ]);
        if($product->id){
            foreach($data->categories as $category){
                ProductCategory::create([
                    'product_id'=>$product->id,
                    'category_id'=>$category,
                ]);
            }
        }
        

        return $this->apiResponse($product);
    }

    public function get_product(int $id)
    {
        // get product by id
        $product = Product::where('id',$id)->with(['categories','bids','bids.user','purchase.user'])->get();
        $max_bid = 0;
        foreach($product[0]->bids as $bid){
            if($bid->bid_price > $max_bid) $max_bid = $bid->bid_price;
        }
        $product[0]->max_bid = $max_bid;

        return $this->apiResponse($product);
    }


    public function place_bid_product(object $data)
    {
        // Store product bid
        $product = Product::find($data->product_id);

        $startDate = \Carbon\Carbon::create($product->start_time);
        $endDate = \Carbon\Carbon::create($product->end_time);
        $now = \Carbon\Carbon::create(\Carbon\Carbon::now());

        if($now->between($startDate,$endDate)){
            $bid = Bid::create([
                'user_id' => $data->user_id,
                'product_id' => $data->product_id,
                'bid_price' => $data->bid_price,
            ]);
    
            return $this->apiResponse($bid);
        }
        return $this->apiResponse([], 500, "Bid wasn't placed!");
       
    }

    public function buy_now(int $id)
    {
        // get product by id
        $product = Product::find($id);
        if($product->id){
            $purchase = Purchase::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
                'price' => $product->buy_now_price,
            ]);
            Notification::create([
                'user_id' => auth()->user()->id,
                'text' => "You bought new product you can find it in your inventory!",
            ]);
            $product->sold = 1;
            $product->save();
        }

        return $this->apiResponse($product);
    }
}
