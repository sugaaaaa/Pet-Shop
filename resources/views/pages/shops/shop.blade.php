<x-app-layout>
    <div style="background-image: url({{ url('image/main-banner.jpeg') }});">
        <div class="h-[487px] relative max-w-screen-xl mx-auto">
            <div class="absolute top-20 right-0">
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-[#192a82] from-[#828ecf]">Making healthier dog <br> food a reality.</span>
                </h1>
                <p class="text-2xl text-gray-100 mt-4">High quality ingredients, balanced by experts.</p>
            </div>
        </div>
    </div>

    <section class="max-w-screen-xl mx-auto my-10">
        <div class="flex justify-center gap-5">
            <div class="bg-white py-2 px-8 rounded-xl">
                <a href={{ route('dog.index')}}>
                    <h1 class="mb-2 font-bold">Dogs</h1>
                    <img src="{{asset('image/dog.png')}}" alt="" class="w-32 object-cover">
                </a>
            </div>
            <div class="bg-white py-2 px-8 rounded-xl">
                <a href="/pages/cats/allProduct">
                    <h1 class="mb-2 font-bold">Cats</h1>
                    <img src="{{asset('image/cat.png')}}" alt="" class="w-32 object-cover">
                </a>
            </div>
        </div>
        <div class="mt-10">
            <div class="mb-5">
                <h1 class="text-4xl font-bold text-center font-serif">Find Products For Your Pets</h1>
                <div class="flex justify-center gap-5 mt-5">
                    <a href="#" class="bg-[#48b194] px-5 py-1.5 rounded-full">
                        <h1 class="text-white font-medium">All</h1>
                    </a>
                    <a href="#" class="border border-[#48b194] px-5 py-1.5 rounded-full">
                        <h1 class="text-gray-900 font-medium">Food</h1>
                    </a>
                    <a href="/healthcare-dog" class="border border-[#48b194] px-5 py-1.5 rounded-full">
                        <h1 class="text-gray-900 font-medium">Healthcare</h1>
                    </a>
                    <a href="/toy-dog" class="border border-[#48b194] px-5 py-1.5 rounded-full">
                        <h1 class="text-gray-900 font-medium">Toy</h1>
                    </a>
                    <a href="/treat-dog" class="border border-[#48b194] px-5 py-1.5 rounded-full">
                        <h1 class="text-gray-900 font-medium">Treat</h1>
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 mt-10">
                @if($products->isEmpty())
                    <p>No products available.</p>
                @else
                    @foreach($products as $product)
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
        </div>
    </section>
</x-app-layout>
