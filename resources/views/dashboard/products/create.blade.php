<section>
    {{-- form --}}
    <div class="mt-10">
        <form action="/dashboard/products/create" method="post" enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-2 gap-4">
                {{-- For name --}}
                <div class="flex flex-col">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Product Name" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md">
                </div>

                {{-- For stock --}}
                <div class="flex flex-col">
                    <label for="stock">Stock Product</label>
                    <input type="number" name="stock" id="stock" placeholder="Product stock" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md">
                </div>

                {{-- For weight --}}
                <div class="flex flex-col">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" step="0.01" name="weight" id="weight" placeholder="Product Weight (e.g., 1.5kg)" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md" oninput="calculatePrice()">
                </div>

                {{-- For price --}}
                <div class="flex flex-col">
                    <label for="price">Price ($)</label>
                    <input type="text" name="price" id="price" placeholder="Product Price" readonly required class="bg-gray-100 px-4 py-2 mt-2 rounded-md">
                </div>
            </div>

            <div class="mt-10 flex gap-10">
                {{-- image --}}
                <div>
                    <label for="image" class="form-label">Image</label>
                    <label for="image" class="cursor-pointer">
                        <div class="w-[450px] h-[430px] border-2 border-gray-300 border-dashed flex flex-col items-center justify-center relative">
                            <i class="fa-regular fa-image text-9xl text-gray-400"></i>
                            <img src="" id="file-preview" class="text-white absolute w-full h-full object-cover rounded-lg">
                            <p class="mb-2 text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <input class="form-control" type="file" name="image" id="image" accept="images/*" onchange="showFile(event)" required>
                        </div>
                    </label>
                </div>

                <div class="w-full">
                    {{-- detail --}}
                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <textarea class="form-control w-full mt-2 bg-gray-100 p-4 rounded-lg" rows="14" name="detail" id="detail" required placeholder="Describe your product here"></textarea>
                    </div>

                    {{-- Category and SubCategory --}}
                    <div class="flex items-center justify-between mt-5 text-gray-200">
                        <div class="flex gap-4">
                            <div class="flex gap-2 font-medium bg-blue-600 px-5 py-2.5 text-center rounded-lg">
                                <label for="category">Category:</label><br>
                                <select name="category_name" class="form-control hover:cursor-pointer bg-blue-600">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex gap-2 font-medium bg-blue-600 px-5 py-2.5 text-center rounded-lg">
                                <label for="subcategory">SubCategory:</label><br>
                                <select name="sub_category_name" class="form-control hover:cursor-pointer bg-blue-600">
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->name }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button type="submit" name="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg px-5 py-2.5 text-center">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Include CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
    function showFile(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('file-preview');
            output.src = dataURL;
            output.style.display = 'block';
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

@push('scripts')
@endpush
