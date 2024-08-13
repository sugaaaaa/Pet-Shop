<x-app-layout>
    <section class="max-w-screen-xl mx-auto my-20">
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
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <h1 class="text-xl font-semibold">Delivery Detail</h1>
                <div class="mt-5">
                    <form action="{{ route('orders.create') }}" method="POST" id="orderForm">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="name">Name*</label><br>
                                <input type="text" name="name" placeholder="Receiver Name" class="w-full px-4 py-2 mt-2 rounded-md border" required>
                            </div>
                            <div>
                                <label for="phone">Your Phone Number*</label><br>
                                <input type="number" name="phone" placeholder="Receiver Phone Number" class="w-full px-4 py-2 mt-2 rounded-md border" required>
                            </div>
                            <div>
                                <label for="province">Province/City*</label><br>
                                <input type="text" name="province" placeholder="Select Province/City" class="w-full px-4 py-2 mt-2 rounded-md border" required>
                            </div>
                            <div>
                                <label for="district">District*</label><br>
                                <input type="text" name="district" placeholder="Select District" class="w-full px-4 py-2 mt-2 rounded-md border" required>
                            </div>
                            <div>
                                <label for="commune">Commune*</label><br>
                                <input type="text" name="commune" placeholder="Select Commune" class="w-full px-4 py-2 mt-2 rounded-md border" required>
                            </div>
                            <div>
                                <label for="village">Village*</label><br>
                                <input type="text" name="village" placeholder="Enter Your Village" class="w-full px-4 py-2 mt-2 rounded-md border" required>
                            </div>
                        </div>
                        <div>
                            <label for="order_notes">Order Notes</label><br>
                            <textarea name="order_notes" placeholder="Enter any notes about the order" class="w-full h-24 px-4 py-2 mt-2 rounded-md border"></textarea>
                        </div>
                        @foreach($selectedProducts as $product)
                            <input type="hidden" name="selected_products[]" value="{{ $product->id }}">
                        @endforeach
                        <input type="hidden" name="delivery_fee" id="delivery_fee" value="0">
                        <button type="submit" class="px-4 py-2 mt-4 bg-[#17554B] rounded-full text-white text-sm w-full">Place Order</button>
                    </form>
                </div>
            </div>

            <div class="bg-[#edece5] px-10 py-5">
                @foreach($selectedProducts as $product)
                    <div class="flex justify-between items-center mt-5 border-b border-gray-500 pb-5 gap-10">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('images/' . $product->images) }}" alt="" class="h-20">
                            <div>
                                <h1 class="text-lg font-medium">{{ $product->name }}</h1>
                                <p class="text-sm text-gray-800 font-bold">Quantity: {{ $cart[$product->id] }}</p>
                            </div>
                        </div>
                        <h1 class="text-sm">${{ $product->price * $cart[$product->id] }}</h1>
                    </div>
                @endforeach

                <div class="border border-gray-300 p-5 mt-5">
                    <div class="flex justify-between border-b border-gray-300 pb-4">
                        <p>Subtotal</p>
                        <h1 class="text-sm" id="subtotal">
                            ${{ collect($selectedProducts)->sum(function($product) use ($cart) { return $product->price * $cart[$product->id]; }) }}
                        </h1>
                    </div>

                    <p class="mt-5">Delivery Method</p>
                    <div class="flex items-center justify-between mb-4 bg-blue-300 py-2 px-4 rounded-md mt-5 text-gray-800">
                        <div>
                            <i class="fa-solid fa-truck"></i>
                            <label for="delivery_8_36" class="ms-2 text-sm font-medium dark:text-gray-300">Deliver in 8-36 Hours:</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <span>$1.50</span>
                            <input id="delivery_8_36" type="radio" name="delivery_method" value="1.50" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onchange="updateTotal(this)">
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4 bg-yellow-100 py-2 px-4 rounded-md">
                        <div>
                            <label for="pickup" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pick up at shop</label>
                        </div>
                        <input id="pickup" type="radio" name="delivery_method" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onchange="updateTotal(this)" checked>
                    </div>

                    <div class="mt-5 border-t border-gray-300 pt-4">
                        <div class="flex justify-between">
                            <p class="text-xl font-semibold">Total</p>
                            <h1 class="text-lg font-semibold" id="total">
                                ${{ collect($selectedProducts)->sum(function($product) use ($cart) { return $product->price * $cart[$product->id]; }) }}
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-300 p-5 mt-5">
                    <div id="accordion-flush" data-accordion="collapse" data-active-classes="dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                        <h2 id="accordion-flush-heading-2">
                            <button type="button" class="w-full py-5 text-start font-medium rtl:text-right text-gray-800 border-b border-gray-300 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                                <input type="radio" value="" name="pay-via" class="w-4 h-4 text-blue-600 bg-gray-600 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span>Transfer to (ABA, Acleda, TrueMoney or Wing)</span>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Make your payment into our bank account or Phone Number (ABA, Acleda, Wing, True Money, Pi Pay or Weiluy). Please use your Order ID as the payment reference. Bank details provided when you click “Place Order”.</p>
                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-1">
                            <button type="button" class="w-full text-start py-5 font-medium rtl:text-right text-gray-800 border-b border-gray-300 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                                <input type="radio" value="" name="pay-via" class="w-4 h-4 text-blue-600 bg-gray-600 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span>ABA / Cash on Delivery</span>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                            <div class="py-5 border-b border-gray-300 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Pay Cash / ABA to the deliveryman when you receive your package. Please keep enough changes ready.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function updateTotal(element) {
            const deliveryFee = parseFloat(element.value);
            document.getElementById('delivery_fee').value = deliveryFee;
            
            const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace('$', ''));
            const total = subtotal + deliveryFee;
            
            document.getElementById('total').textContent = '$' + total.toFixed(2);
        }
    </script>
</x-app-layout>
