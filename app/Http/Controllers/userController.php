<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Cart;
use App\Models\Order;

use App\Http\Controllers\Redirect;


class userController extends Controller
{
    public function listItems() {
        $items = Item::all()->sortByDesc('isAvailable');
        return view('shop', ['items'=>$items]);
    }
    
    public function addToCart($item_id) {

        if (Auth::check()) {
            $cart_item = new Cart;
        
            $cart_item->user_id = Auth::user()->id;
            $cart_item->item_id = $item_id;
            
            $cart_item->save();
            
            return redirect('shop')->with('message', 'Item added to cart');
        } else {
            return redirect('login');
        }
        
        
    }
    
    public function listCartItems() {
        $items = Item::all();
        $cart_items = Cart::all()->where('user_id', '=', Auth::user()->id)->toArray();
        
        return view('cart', ['cart_items'=>$cart_items, 'items'=>$items]);
    }
    
    public function removeCartItem($cart_id) {
        $cart_item = Cart::find($cart_id);
        
        $cart_item->delete();
        
        return redirect('cart')->with('message', 'Item removed from cart');
    }
    
    public function checkout(Request $req) {
        
        $all_items = Item::all();


        $items = json_encode($req->items);
        
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->address = $req->address;
        $order->price = $req->total_price;
        $order->payment_status = 'NOT PAID';
        $order->items = $items;
        
        $order->save();
        
        return redirect('toyyibpay/'.$order->order_id);
        
    }
    
    
    
    public function destroy(Request $request) {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('home');
    }

    public function listUserOrder() {
        $orders = Order::all()->where('user_id', '=', Auth::user()->id);

        $allItems = Item::all();

        return view('order-list', ['orders'=>$orders, 'allItems'=>$allItems]);
    }
    
}
