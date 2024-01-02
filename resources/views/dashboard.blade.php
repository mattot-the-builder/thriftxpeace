<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                    Available Items
                </div>
                <div class="m-5 mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th scope="col" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            @if ($item['isAvailable'])
                            <tr>
                                <th scope="row">{{ $item['item_id'] }}</th>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>{{ $item['size'] }}</td>
                                <td>RM {{ $item['price'] }}</td>
                                <td align="right">
                                    <a href="{{ '/sold-item/'.$item['item_id'] }}" class="btn btn-secondary">Sold</a>
                                    <a href="{{ '/update-item/'.$item['item_id'] }}" class="btn btn-primary">Update</a>
                                    <a href="{{ '/delete/'.$item['item_id'] }}" class="btn btn-danger" onclick="return confirm('Confirm delete item?')">Delete</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Sold Items
                </div>
                <div class="m-5 mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th scope="col" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            @if (!($item['isAvailable']))
                            <tr>
                                <th scope="row">{{ $item['item_id'] }}</th>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>{{ $item['size'] }}</td>
                                <td>RM {{ $item['price'] }}</td>
                                <td align="right">
                                    <a href="{{ '/available-item/'.$item['item_id'] }}" class="btn btn-secondary">Available</a>
                                    <a href="{{ '/update-item/'.$item['item_id'] }}" class="btn btn-primary">Update</a>
                                    <a href="{{ '/delete/'.$item['item_id'] }}" class="btn btn-danger" onclick="return confirm('Confirm delete item?')">Delete</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
