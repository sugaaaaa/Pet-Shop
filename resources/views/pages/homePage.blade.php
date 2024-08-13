<x-app-layout>    
<!-- Search bar results -->
    @if(isset($search) && $search)
        <div class="max-w-screen-xl mx-auto my-10">
            <div class="mb-5">
                <div class="flex items-center justify-between">
                    <hr class="w-[520px] h-1 bg-gray-400 border-0 rounded">
                    <h1 class="text-2xl font-semibold">Search Results</h1>
                    <hr class="w-[520px] h-1 bg-gray-400 border-0 rounded">
                </div>
                <div class="text-center text-[#af9a4f]">
                    <i class="fa-solid fa-star-of-david text-sm"></i>
                    <i class="fa-solid fa-star-of-david text-sm"></i>
                    <i class="fa-solid fa-star-of-david text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                @if($products->isEmpty())
                    <p>No products found for "{{ request('query') }}".</p>
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
                                            <a href="#" class="add-to-cart bg-white hover:border-[#115542] hover:border rounded-md" data-product-id="{{ $product->id }}">
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
    @endif

    <div style="background-image: url({{ url('image/main-banner.jpeg') }});">
        <div class="h-[487px] relative max-w-screen-xl mx-auto">
            <div class="absolute top-20 right-0">
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-[#192a82] from-[#828ecf]">Making healthier dog <br> food a reality.</span>
                </h1>
                <p class="text-2xl text-gray-100 mt-4">High quality ingredients, balanced by experts.</p>
            </div>
            
            <nav class="absolute bottom-[-20px] right-0">
                <div class="flex justify-end gap-5">
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
            </nav>
         </div>
    </div>

    {{-- for food pet --}}
    <div class="max-w-screen-xl mx-auto">
        <div>
            {{-- for new products --}}
            <div class="my-10">
                <div class="mb-5">
                    <div class="flex items-center justify-between">
                        <hr class="w-[520px] h-1 bg-gray-400 border-0 rounded">
                        <h1 class="text-2xl font-semibold">New Products</h1>
                        <hr class="w-[520px] h-1 bg-gray-400 border-0 rounded">
                    </div>
                    <div class="text-center text-[#af9a4f]">
                        <i class="fa-solid fa-star-of-david text-sm"></i>
                        <i class="fa-solid fa-star-of-david text-sm"></i>
                        <i class="fa-solid fa-star-of-david text-sm"></i>
                    </div>
                </div>
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
                                                <a href="#" class="add-to-cart bg-white hover:border-[#115542] hover:border rounded-md" data-product-id="{{ $product->id }}">
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
        </div>
    </div>

    {{-- for discount --}}
    <div class="my-20">
        <div class="bg-[#48b194] h-[350px]">
            <div class="max-w-screen-xl mx-auto">
                <div class="flex items-center">
                    <div> 
                        <h1 class="text-sm font-bold">OVER 200 PRODUCTS</h1>
                        <h1 class="text-3xl mt-2 font-extrabold text-[#602b05] dark:text-white">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r to-[#0a4723] from-[#602b05]">
                                SALE OFF
                            </span><br> UP TO 50%
                        </h1>
                        <ul class="text-[#602b05]">
                            <li>
                                <i class="fa-regular fa-circle-check"></i>
                                Dry Food
                            </li>
                            <li>
                                <i class="fa-regular fa-circle-check"></i>
                                Wet Food
                            </li>
                            <li>
                                <i class="fa-regular fa-circle-check"></i>
                                Pet Toys
                            </li>
                        </ul>
                    </div>
                    <div class="w-[949px]">
                        <img src="{{asset('image/banner-content2.png')}}" alt="">
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-[#602b05]">FROM $3.00</h1>
                        <div class="flex items-center gap-2">
                            <hr class="h-3 bg-yellow-300 border-0 w-[50px]">
                            <h1 class="text-sm font-semibold text-[#602b05]">TO </h1>
                            <h1 class="text-xl font-semibold text-[#602b05]">$25.00</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-screen-xl mx-auto mt-20">
            {{-- card --}}
            <div class="grid grid-cols-4 gap-4">
                {{-- loop --}}
                @foreach ($products as $product)
                    @if ($product->coupons->isNotEmpty())
                        <div class="border border-gray-200 relative top-0">
                            <div class="absolute top-0 left-0 bg-[#499e86] hover:bg-[#115542] ml-4 rounded-b-full cursor-pointer">
                                <h1 style="writing-mode: vertical-lr;" class="px-0.5 pt-2 pb-5 text-sm text-gray-100 font-bold">
                                    {{number_format( $product->coupons->first()->discount_amount,0)}}% Off
                                </h1>
                            </div>
                            <div>
                                <a href="{{ route('products.detail', $product->id) }}">
                                    <img src="{{ asset('/images/' . $product->images) }}" alt="" class="w-full h-[350px] object-cover">
                                </a>
                            </div>
                            <div class="bg-[#48b194]">
                                <div class="flex justify-between items-end p-4">
                                    <div>
                                        <a href="{{ route('products.detail', $product->id) }}">
                                            <h1 class="font-bold text-[#602b05]">ETIAM GRADRE</h1>
                                            <h1 class="text-sm"><span class="font-semibold">WEIGHT:</span> {{ $product->weight . 'kg'}}</h1>
                                            <h1 class="font-semibold text-gray-100">${{ number_format($product->discounted_price, 2) }}</h1>
                                            <h1 class="line-through text-sm">{{ $product->price }}$</h1>
                                        </a>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="flex gap-2">
                                            <a href="#" class="bg-white hover:border-[#115542] hover:border rounded-md">
                                                <i class="fa-solid fa-heart p-2 text-red-900"></i>
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
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wishlistButtons = document.querySelectorAll('.add-to-wishlist');

        wishlistButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const productId = this.getAttribute('data-product-id');
                const url = "{{ route('wishlist.add') }}";
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const heartIcon = this.querySelector('i');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        heartIcon.classList.toggle('favorite');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
    
    document.addEventListener('DOMContentLoaded', function () {
    const cartButtons = document.querySelectorAll('.add-to-cart');

        cartButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const productId = this.getAttribute('data-product-id');
                const url = "{{ route('cart.add') }}";
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ product_id: productId, quantity: 1 })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('pages.viewCartProduct') }}"; // Redirect to cart page
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });

    // Check for success or error message in the session
    @if(session('success'))
            swal({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success",
                button: "OK",
            });
        @endif

        @if(session('error'))
            swal({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error",
                button: "OK",
                timer: 3000,
            });
        @endif
</script>
