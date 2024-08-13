@extends('pages.dogs.index')
@section('content')
    <div class="grid grid-cols-4 gap-4">
        @if($products->isEmpty())
            <p>No products available.</p>
        @else
            @foreach($products->take(4) as $product)
                <div class="border border-gray-200 bg-[#48b194]">
                    <div class="bg-gray-100">
                        <a href="{{ route('products.detail', $product->id) }}">
                            <img src="{{ asset('/images/' . $product->images) }}" alt="" class="w-full h-[350px] object-cover">
                        </a>
                    </div>
                    <div class="p-4">
                        <h1 class="font-bold text-[#602b05]">{{ $product->name }}</h1>
                        <div class="flex justify-between items-center mt-2">
                            <div>
                                <a href="{{ route('products.detail', $product->id) }}">
                                    <h1 class="font-semibold text-gray-100">{{ $product->price }}$</h1>
                                    <h1 class="text-sm"><span class="font-semibold">WEIGHT:</span> {{ $product->weight . 'kg'}}</h1>
                                </a>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="flex gap-2">
                                    <a href="#" class="add-to-wishlist bg-white hover:border-[#115542] hover:border rounded-md" data-product-id="{{ $product->id }}">
                                        <i class="fa-solid fa-heart p-2 {{ $product->isFavorited() ? 'favorite' : '' }}"></i>
                                    </a>
                                    <a href="#" class="bg-white hover:border-[#115542] hover:border rounded-md">
                                        <i class="fa-solid fa-cart-plus p-2"></i>
                                    </a>
                                </div>
                                <div>
                                    <i class="fa-solid fa-star text-sm text-yellow-700"></i>
                                    <i class="fa-solid fa-star text-sm text-yellow-700"></i>
                                    <i class="fa-solid fa-star text-sm text-yellow-700"></i>
                                    <i class="fa-solid fa-star text-sm text-yellow-700"></i>
                                    <i class="fa-solid fa-star text-sm text-yellow-700"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection