@extends('pages.dogs.index')
@section('content')
    @if ($dogtoys->isEmpty())
        <p class="text-center mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">No Products Toy.</p>
    @else
        <div class="grid grid-cols-4 gap-4 mt-10">
            @foreach ($dogtoys as $dogtoy)
                <div class="border border-gray-200">
                    <div>
                        <a href="{{ route('products.detail', $dogtoy->id) }}">
                            <img src="{{ asset('/images/' . $dogtoy->images) }}" alt="" class="w-full h-[350px] object-cover">
                        </a>
                    </div>
                    <div class="bg-[#48b194] p-4">
                        <h1 class="font-bold text-[#602b05]">{{ $dogtoy->name }}</h1>
                        <div class="flex justify-between items-end mt-4">
                            <div>
                                <a href="{{ route('products.detail', $dogtoy->id) }}">
                                    <h1 class="font-semibold text-gray-100">${{ $dogtoy->price }}</h1>
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