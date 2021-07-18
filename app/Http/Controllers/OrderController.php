<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; 
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;


class OrderController extends Controller{

    public function setOrder(Request $request)
    {
        $validatedData = $request->validate([
            'pickup_day'    => 'required|max:20',
            'pickup_time'   => 'required|max:20',
            'address'       => 'required|max:250',
            'payment_type'  => 'required|max:100',
            'items'         => 'required|max:1000'
        ]);

        $user_id = auth()->user()->id;
        $validatedData['user_id'] = $user_id;

        $validatedData['pickup_day'] = $date = Carbon::createFromFormat('m/d/Y', $validatedData['pickup_day'])
            ->format('Y-m-d');
        
        $validatedData['pickup_time'] = $date = Carbon::createFromFormat('H:i:s', $validatedData['pickup_time'])
            ->format('H:i:s');

        $order = Order::create($validatedData);    

        $items = $validatedData['items'];
        $items = json_decode($items, true);

        foreach($items as $item){

            $unit_price = Product::find($item['product_id'])->price;

            $data = [
                'order_id'      => $order->id, 
                'product_id'    => $item['product_id'], 
                'quantity'      => $item['quantity'], 
                'unit_price'    => $unit_price
            ];

            $orderItem = OrderItem::create($data); 
        }

        return response(['order' => $order, 
            'items' => $items,
            'message' => 'Order created successfully' ]);

    }

    public function historyGet(Request $request){

        $user_id = auth()->user()->id;

        $orders = Order::where(['user_id' => $user_id])->get();

        $orders =  $orders->map(function ($order) {

            $items = OrderItem::where(['order_id' => $order['id']])->get();
            $items =  $items->map(function ($item) {
                return collect($item)->except(['order_id', 'created_at', 'updated_at'])->toArray();
            });    

            return [
                'order' => collect($order)->except(['user_id', 'created_at', 'updated_at'])->toArray(),
                'items' => $items
            ];
            
        });
        return  $orders;
    }

}
