@extends('dashboard')

@section('content')
<div class="container">
    <h1 class="p-5 text-2xl">Manage Orders</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Order ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Products
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->id }}
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->user->name ?? $order->user->phone }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @foreach($order->products as $product)
                                {{ $product->name }} ({{ $product->pivot->quantity }}),
                            @endforeach
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ucfirst($order->status) }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <form action="{{ route('dashboard.orders.approve', $order) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success bg-blue-800 hover:bg-blue-600 px-4 py-1 text-gray-200 text-sm rounded-md">Approve</button>
                            </form>
                            <form action="{{ route('dashboard.orders.reject', $order) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger bg-rose-700 hover:bg-rose-600 px-4 py-1 text-gray-200 text-sm rounded-md">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
