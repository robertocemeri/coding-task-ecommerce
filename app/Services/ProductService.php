<?php

namespace App\Services;

use App\Models\Product;
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

    public function store_product(object $data)
    {
        // Store product
        $products = Product::create([
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

        return $this->apiResponse($products);
    }

    public function get_product(int $id)
    {
        // get product by id
        $product = Product::where('id',$id)->with('categories','bids')->get();
        return $this->apiResponse($product);
    }
}
