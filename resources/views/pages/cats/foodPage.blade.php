@extends('pages.cats.index')
@section('content')
    @if ($catfoods->isEmpty())
        <p class="text-center mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">No Products Related.</p>
    @else
        <div class="grid grid-cols-4 gap-4 mt-10">
            @foreach ($catfoods as $catfood)
                <div class="border border-gray-200">
                    <div>
                        <a href="{{ route('products.detail', $catfood->id) }}">
                            <img src="{{ asset('/images/' . $catfood->images) }}" alt="" class="w-full h-[350px] object-cover">
                        </a>
                    </div>
                    <div class="bg-[#48b194] p-4">
                        <h1 class="font-bold text-[#602b05]">{{ $catfood->name }}</h1>
                        <div class="flex justify-between items-end mt-2">
                            <div>
                                <a href="{{ route('products.detail', $catfood->id) }}">
                                    <h1 class="font-semibold text-gray-100">${{ $catfood->price }}</h1>
                                    <h1 class="line-through text-sm">$160.00</h1>
                                </a>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="flex gap-2">
                                    <a href="#" class="bg-white hover:border-[#115542] hover:border rounded-md">
                                        <i class="fa-regular fa-heart p-2"></i>
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
        </div>
    @endif
@endsection