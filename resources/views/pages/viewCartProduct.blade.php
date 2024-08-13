<!-- resources/views/pages/viewCartProduct.blade.php -->
<x-app-layout>
    <section class="max-w-screen-xl mx-auto my-10">
        <div>
            @if(session('success'))
                <div class="alert alert-success bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="grid grid-cols-3 gap-10">
            <div class="col-span-2">
                <div class="flex justify-between items-end">
                    <h1 class="text-2xl font-semibold">Shopping Cart</h1>
                    <a href="/" class="text-sm underline hover:text-blue-700">Continue Shopping</a>
                </div>
                <div>
                    {{-- Cart Items Form --}}
                    <form id="cart-form" action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        @foreach($cartProducts as $product)
                            <div class="flex justify-between mt-5 border-b pb-5" data-stock="{{ $product->stock }}">
                                <div class="flex items-center gap-4">
                                    <a href="#" class="flex gap-4">
                                        <img src="{{ asset('images/' . $product->images) }}" alt="" class="h-20">
                                    </a>
                                    <div>
                                        <a href="#">
                                            <h1 class="text-lg font-medium">{{ $product->name }}</h1>
                                            <p class="text-sm text-gray-500">{{ $product->price }}$</p>
                                        </a>
                                        <div class="flex items-center">
                                            <button type="button" class="decrement-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" class="counter-input w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" name="quantities[{{ $product->id }}]" value="{{ $cart[$product->id] }}" required />
                                            <button type="button" class="increment-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-between items-end">
                                    <button type="button" class="remove-button">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                    <p class="item-total-price">${{ $product->price * $cart[$product->id] }}</p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Update Cart Button --}}
                        <div class="bg-[#17554B] w-full py-2 mt-4 rounded-full">
                            <button type="submit" class="text-center text-gray-100 text-sm w-full">Update Cart</button>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <h1 class="text-2xl font-semibold">Cart Totals</h1>
                <div class="mt-5 p-4">
                    <div class="flex justify-between border-b-2 border-t-2 py-4">
                        <h1 class="font-bold text-xl">Subtotal</h1>
                        <h1 id="cart-subtotal">${{ $subtotal }}</h1>
                    </div>
                    <div class="bg-[#17554B] w-full py-2 mt-4 rounded-full">
                        <a href="{{ route('orders.indexOrder') }}">
                            <p class="text-center text-gray-100 text-sm">Check Out</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <h1 class="text-2xl font-semibold">Products You May Like</h1>
            <div class="grid grid-cols-4 gap-4 mt-5">
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
        </div>
    </section>

    <form id="remove-form" action="{{ route('cart.remove') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="product_id" id="remove-product-id">
    </form>

    <script>
        document.querySelectorAll('.increment-button').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const itemElement = this.closest('.flex.justify-between.mt-5.border-b.pb-5');
                const stock = parseInt(itemElement.getAttribute('data-stock'));
                if (parseInt(input.value) < stock) {
                    input.value = parseInt(input.value) + 1;
                    updatePrice(itemElement, input.value);
                } else {
                    alert('Maximum stock limit reached.');
                }
            });
        });

        document.querySelectorAll('.decrement-button').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling;
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updatePrice(this.closest('.flex.justify-between.mt-5.border-b.pb-5'), input.value);
                }
            });
        });

        document.querySelectorAll('.remove-button').forEach(button => {
            button.addEventListener('click', function() {
                const productElement = this.closest('.flex.justify-between.mt-5.border-b.pb-5');
                const productId = productElement.querySelector('.counter-input').name.match(/\d+/)[0];
                document.getElementById('remove-product-id').value = productId;
                document.getElementById('remove-form').submit();
            });
        });

        function updatePrice(itemElement, quantity) {
            const priceElement = itemElement.querySelector('.text-sm.text-gray-500');
            const totalPriceElement = itemElement.querySelector('.item-total-price');
            const price = parseFloat(priceElement.textContent.replace('$', ''));
            const totalPrice = price * quantity;
            totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
            updateSubtotal();
        }

        function updateSubtotal() {
            let subtotal = 0;
            document.querySelectorAll('.item-total-price').forEach(priceElement => {
                subtotal += parseFloat(priceElement.textContent.replace('$', ''));
            });
            document.getElementById('cart-subtotal').textContent = `$${subtotal.toFixed(2)}`;
        }
    </script>
</x-app-layout>
