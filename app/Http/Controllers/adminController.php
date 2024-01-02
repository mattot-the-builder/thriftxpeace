<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use App\Models\Cart;
use Carbon\Carbon;

use App\Http\Controllers\Redirect;

class adminController extends Controller
{
    //
    
    public function listItems() {
        $items = Item::all();
        return view('dashboard', ['items'=>$items]);
    }
    
    public function listOrders() {
        $orders = Order::all();
        $items = Item::all();
        return view('order', ['orders'=>$orders, 'items'=>$items]);
    }
    
    public function selectItem($item_id) {
        $item = Item::find($item_id);
        
        return view('update-form', ['item'=>$item]);
    }
    
    public function updateItem($item_id, Request $req) {
        $item = Item::find($item_id);
        
        $item->name = $req->name;
        $item->size = $req->size;
        $item->price = $req->price;
        
        $item->save();
        
        return redirect('/dashboard');
    }
    
    public function soldItem($item_id) {
        $item = Item::find($item_id);
        
        $item->isAvailable = 0;
        
        $item->save();
        
        return redirect('/dashboard')->with('message', 'Item marked as sold successfully');
    }
    
    public function availableItem($item_id) {
        $item = Item::find($item_id);
        
        $item->isAvailable = 1;
        
        $item->save();
        
        return redirect('/dashboard')->with('messageB', 'Item marked as available successfully');
    }
    
    public function addItem(Request $req) {
        
        $item = new Item;
        
        $item->name = $req->name;
        $item->size = $req->size;
        $item->description = $req->description;
        $item->price = $req->price;
        
        if ($req->hasFile('image')) {
            $destination_path = 'public/img/items';
            $image = $req->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $req->file('image')->storeAs($destination_path, $image_name);
            
            $item->image = $image_name;
        }
        
        $item->save();
        
        return redirect('/dashboard');
    }
    
    public function deleteItem($item_id) {
        $item = Item::find($item_id);
        $item->delete();
        
        return redirect('/dashboard');
    }
    
    // Toyyibpay functions
    
    public function createBill($order_id) {
        
        $order = Order::find($order_id);
        
        $some_data = array(
            'userSecretKey'=>config('toyyibpay.key'),
            'categoryCode'=>config('toyyibpay.category'),
            'billName'=>'Thrift X Peace',
            'billDescription'=>'This is your bill for purchase',
            'billPriceSetting'=>0,
            'billPayorInfo'=>1,
            'billAmount'=>$order->price*100,
            'billReturnUrl'=>route('toyyibpay-status'),
            'billCallbackUrl'=>route('toyyibpay-callback'),
            'billExternalReferenceNo' => 'AFR341DFI',
            'billTo'=>Auth::user()->name,
            'billEmail'=>Auth::user()->email,
            'billPhone'=>Auth::user()->telephone,
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>'0',
            'billContentEmail'=>'Thank you for purchasing our product!',
            'billChargeToCustomer'=>1,
            'billExpiryDate'=>'17-12-2023 17:00:00',
            'billExpiryDays'=>3
        );  
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
        
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);  
        curl_close($curl);
        $obj = json_decode($result, true);
        
        
        
        $billCode = $obj[0]['BillCode'];
        
        $order->bill_code = $billCode;
        $order->save();
        
        return redirect('https://dev.toyyibpay.com/' . $billCode);
        
    }
    
    public function paymentStatus() {
        $response = request()->all(['status_id', 'billcode', 'order_id']);
        
        $order = Order::all()->where('bill_code', '=', $response['billcode'])->first();
        
        $items = Item::all();
        $carts = Cart::all()->where('user_id', '=', Auth::user()->id);
        
        $order->payment_status = 'NOT PAID';
        $order->save();
        
        $purchased_items_id = json_decode($order->items, true);
        
        $purchased_items = [];
        
        foreach ($items as $item) {
            foreach ($purchased_items_id as $purchased_item) {
                if ($item['item_id'] == $purchased_item) {
                    $item['isAvailable'] = 0;
                    $item->save();
                    array_push($purchased_items, $item);
                }
            }
        }
        
        // dd($purchased_items);
        
        foreach ($carts as $cart) {
            $cart->delete();
        }
        
        $currentDate = Carbon::now();
        
        if ($response['status_id'] == 1) {
            $order->payment_status = 'PAID';
            $order->save();
            return view('toyyibpay-status', ['order'=>$order, 'currentDate'=>$currentDate, 'items'=>$purchased_items]);
        } else if ($response['status_id'] == 2) {
            $order->payment_status = 'PENDING';
            $order->save();
            return view('toyyibpay-status', ['order'=>$order, 'currentDate'=>$currentDate, 'items'=>$purchased_items]);
        }
        else {
            $order->payment_status = 'NOT PAID';
            $order->save();
            return view('toyyibpay-status', ['order'=>$order, 'currentDate'=>$currentDate, 'items'=>$purchased_items]);
        }
        
    }
    
    public function callback(Request $req) {
        dd('im from callback');
        //     $response = request()->all(['status_id', 'billcode', 'order_id']);
        
        //     $order = Order::all()->where('bill_code', '=', $response->billcode);
        //     dd($response->billCode);
        
        //     if ($response->status_id == 1) {
            //         $order->payment_status = 'PAID';
            //         $order->save();
            //         dd('success');
            //     } else {
                //         dd('payment unsuccessfull');
                //     }
            }
            
        }
        