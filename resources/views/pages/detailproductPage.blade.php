<!-- resources/views/pages/viewCartProduct.blade.php -->
<x-app-layout>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <section class="bg-white dark:bg-gray-900 antialiased pb-20">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 mt-10 pt-10">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img class="w-full dark:hidden" src="{{ asset('/images/' . $product->images) }}" alt="" />
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $product->name }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            {{ $product->price }}$
                        </p>

                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                            <div class="flex items-center gap-1">
                                @php
                                    $averageRating = round($product->approvedRatings()->avg('rating'));
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $averageRating ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                ({{ round($product->approvedRatings()->avg('rating'), 1) }})
                            </p>
                            <a href="#ratings"
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                                {{ $product->approvedRatings()->count() }} Reviews
                            </a>
                        </div>
                    </div>
                    <div class="mt-5">
                        <p>
                             <span class="text-sm font-bold">CATEGORY: </span>
                            @if ($product->category)
                                <a href="{{ route(strtolower($product->category->name) . '.index') }}" class="text-blue-500 underline">
                                    {{ $product->category->name }}
                                </a>
                            @else
                                <span>No category</span>
                            @endif
                        </p>
                        <p><span class="text-sm font-bold">WEIGHT: </span> {{ $product->weight }} kg</p>
                    </div>

                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <div class="flex items-center">
                            <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                </svg>
                            </button>
                            <input type="text" id="counter-input" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="1" required />
                            <button type="button" id="increment-button" data-input-counter-increment="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                            </button>
                        </div>
                        <form id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" id="product-quantity" value="1">
                            <button type="button" class="add-to-cart text-white mt-4 sm:mt-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center justify-center" role="button">
                                <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                </svg>
                                Add to cart
                            </button>
                        </form>
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                    <div class="mt-2 p-4 rounded-lg ck-content">
                        {!! $product->detail !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- relation products --}}
        <div class="max-w-screen-xl mx-auto mt-20">
            <div class="mb-5">
                <div class="flex items-center justify-between">
                    <hr class="w-[520px] h-1 bg-gray-400 border-0 rounded">
                    <h1 class="text-2xl font-semibold">Related Product</h1>
                    <hr class="w-[520px] h-1 bg-gray-400 border-0 rounded">
                </div>
                <div class="text-center text-[#af9a4f]">
                    <i class="fa-solid fa-star-of-david text-sm"></i>
                    <i class="fa-solid fa-star-of-david text-sm"></i>
                    <i class="fa-solid fa-star-of-david text-sm"></i>
                </div>
            </div>
            @if ($relatedProducts->isEmpty())
                <p class="text-center mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">No Products Related.</p>
            @else
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="border border-gray-200 bg-[#48b194]">
                            <div>
                                <a href="{{ route('products.detail', $relatedProduct->id) }}">
                                    <img src="{{ asset('/images/' . $relatedProduct->images) }}" alt="{{ $relatedProduct->name }}" class="w-full h-[350px] object-cover">
                                </a>
                            </div>
                            <div class="p-4">
                                <h1 class="font-bold text-[#602b05]">{{ $relatedProduct->name }}</h1>
                                <div class="flex justify-between items-center mt-2">
                                    <div>
                                        <a href="{{ route('products.detail', $relatedProduct->id) }}">
                                            <h1 class="font-semibold text-gray-100">{{ $relatedProduct->price }}$</h1>
                                            <h1 class="line-through text-sm">$160.0</h1>
                                        </a>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="flex gap-2">
                                            <a href="#" class="bg-white hover:border-[#115542] hover:border rounded-md">
                                                <i class="fa-solid fa-heart p-2 text-red-900"></i>
                                            </a>
                                            <a href="#" class="add-to-cart bg-white hover:border-[#115542] hover:border rounded-md" data-product-id="{{ $relatedProduct->id }}">
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
        </div>

        {{-- Ratings --}}
        <div id="ratings" class="max-w-screen-xl mx-auto mt-20">
            <h2 class="text-2xl font-semibold">Customer Ratings</h2>
            @forelse ($product->approvedRatings as $rating)
                <div class="mt-4">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                            ({{ $rating->rating }})
                        </p>
                    </div>
                    <p class="text-gray-900 dark:text-white mt-1">{{ $rating->review }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">by {{ $rating->user->name }}</p>
                </div>
            @empty
                <p>No ratings yet.</p>
            @endforelse
        </div>
       
    </section>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const productId = this.getAttribute('data-product-id');
            const quantity = document.getElementById('counter-input').value;

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product has been added to your cart!');
                    window.location.href = '{{ route('pages.viewCartProduct') }}';
                } else {
                    alert('Error: ' + data.message);
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the product to your cart.');
            });
        });
    });

    document.getElementById('increment-button').addEventListener('click', function () {
        const input = document.getElementById('counter-input');
        input.value = parseInt(input.value) + 1;
    });

    document.getElementById('decrement-button').addEventListener('click', function () {
        const input = document.getElementById('counter-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });
});
</script>

