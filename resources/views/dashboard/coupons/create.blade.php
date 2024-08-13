<section>
    <div class="mt-10 px-10">
        <form action="{{ route('coupons.store') }}" method="post" class="grid grid-cols-2 gap-5">
            @csrf

            <div class="flex flex-col">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" value="{{ old('code') }}" placeholder="Coupon Code" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full">
            </div>

            <div class="flex flex-col">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Coupon Name" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full">
            </div>

            <div class="flex flex-col">
                <label for="discount_amount">Discount Amount ($)</label>
                <input type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount') }}" placeholder="Discount Amount" required class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full">
            </div>

            <div class="flex flex-col">
                <label for="status">Status</label>
                <select name="status" id="status" class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="starts_at">Starts At</label>
                <input type="datetime-local" name="starts_at" id="starts_at" value="{{ old('starts_at') }}" class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full" required>
            </div>

            <div class="flex flex-col">
                <label for="expires_at">Expires At</label>
                <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}" class="bg-gray-100 px-4 py-2 mt-2 rounded-md w-full" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create
                </button>
            </div>
        </form>
    </div>
</section>