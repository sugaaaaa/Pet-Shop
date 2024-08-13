@extends('dashboard')

@section('content')
    <section class="max-w-screen-xl mx-auto">
        <div class="flex justify-between items-center px-10">
            <a href="javascript:void(0);" onclick="history.back()">
                <i class="fa-solid fa-arrow-left text-2xl bg-blue-300 px-4 py-2.5 text-gray-700 hover:bg-blue-400 rounded-full"></i>
            </a>
            <div class="flex items-center gap-2 font-semibold">
                <i class="fa-solid fa-pen-to-square"></i>
                <h1>Please update the Product information</h1>
            </div>
        </div>

        {{-- form --}}
        <div class="mt-10 px-10">
            <form action="{{ url('/dashboard/products/update/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                {{-- @csrf --}}
                {!! csrf_field() !!}
                <div class="grid grid-cols-2 gap-4">
                    {{-- For name --}}
                    <div class="flex flex-col">
                        <label for="name" class="font-semibold">Name</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}" placeholder="Product Name" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full">
                    </div>

                    {{-- For size --}}
                    <div class="flex flex-col">
                        <label for="stock" class="font-semibold">Stock</label>
                        <input type="text" name="stock" id="stock" value="{{ $product->stock }}" placeholder="Product stock" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full">
                    </div>

                    {{-- For weight --}}
                    <div class="flex flex-col">
                        <label for="weight" class="font-semibold">Weight</label>
                        <input type="number" step="0.01" name="weight" id="weight" value="{{ $product->weight }}" placeholder="Product Weight" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full" oninput="calculatePrice()">
                    </div>

                    {{-- For price (read-only) --}}
                    <div class="flex flex-col">
                        <label for="price" class="font-semibold">Price</label>
                        <input type="text" name="price" id="price" value="{{ $product->price }}$" placeholder="Product Price" readonly class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full">
                    </div>

                    <div>
                        <label for="category" class="font-semibold">Category:</label><br>
                        <select name="category_name" class="form-control hover:cursor-pointer w-full bg-gray-100 px-4 py-2 mt-2">
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="subcategory" class="font-semibold">SubCategory:</label><br>
                        <select name="sub_category_name" class="form-control hover:cursor-pointer w-full bg-gray-100 px-4 py-2 mt-2">
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->name }}" {{ $subcategory->id == $product->sub_category_id ? 'selected' : '' }}> {{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-10 flex gap-10">
                    {{-- Image --}}
                    <div>
                        <label for="image" class="form-label font-semibold">Image</label>
                        <label for="image" class="cursor-pointer">
                            <div class="w-[450px] h-[430px] border-2 border-gray-300 flex flex-col items-center justify-center relative">
                                <i class="fa-regular fa-image text-9xl text-gray-400"></i>
                                <img src="{{ asset('/images/' . $product->images) }}" id="image-preview" class="text-white absolute w-full h-full object-cover rounded-lg" alt="Product Image">
                                <p class="mb-2 text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <input class="form-control hidden" type="file" name="image" id="image" accept="images/*" onchange="showFile(event)">
                            </div>
                        </label>
                    </div>

                    <div class="w-full">
                        {{-- Detail --}}
                        <div class="form-group">
                            <label for="detail" class="font-semibold">Detail</label>
                            <textarea class="form-control w-full mt-2 bg-gray-100 p-4 rounded-lg" rows="13" name="detail" id="detail" required placeholder="Detail your product">{!! $product->detail !!}</textarea>
                        </div>

                        {{-- Category --}}
                        <div class="flex mt-5 text-gray-200">
                            <button type="submit" name="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg px-5 py-2.5 text-center">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Include CKEditor CDN -->
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script>
            function showFile(event) {
                var input = event.target;
                var reader = new FileReader();
                reader.onload = function () {
                    var dataURL = reader.result;
                    var output = document.getElementById('image-preview');
                    output.src = dataURL;
                };
                reader.readAsDataURL(input.files[0]);
            }
            
            function calculatePrice() {
                var weight = parseFloat(document.getElementById('weight').value);
                if (!isNaN(weight)) {
                    var price = weight * 10; // Assuming price is $10 per kg
                    document.getElementById('price').value = `$${price.toFixed(2)}`;
                } else {
                    document.getElementById('price').value = '';
                }
            }

            // Initialize CKEditor for the detail textarea
            CKEDITOR.replace('detail');
        </script>
    </section>
@endsection
