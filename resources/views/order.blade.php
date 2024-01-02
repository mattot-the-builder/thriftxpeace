<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>
    
    @if (session('message'))
    <div class="alert alert-success my-5 mx-auto w-75" role="alert">
        Item marked as sold successfully
    </div>
    @elseif (session ('messageB'))
    <div class="alert alert-success my-5 mx-auto w-75" role="alert">
        Item marked as available successfully
    </div>
    @endif
    
    
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Orders
                </div>
                <div class="m-5 mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Address</th>
                                <th scope="col">Price</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Items</th>
                                <th scope="col">billCode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                @php
                                $order_items = json_decode($order->items, true);
                                @endphp
                                <th scope="row">{{ $order['order_id'] }}</th>
                                <td>{{ $order['address'] }}</td>
                                <td>RM {{ $order['price'] }}</td>
                                <td>{{ $order['payment_status'] }}</td>
                                <td>
                                    

                                    @foreach ($items as $item)
                                        @if (in_array($item['item_id'], $order_items))
                                            {{ $item['item_id'] }}, {{ $item['name'] }} <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $order['bill_code'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
