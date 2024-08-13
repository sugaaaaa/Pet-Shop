@extends('dashboard')

@section('content')
    <h1>Apply Coupon to Product</h1>
    <form action="{{ route('coupons.apply') }}" method="POST">
        @csrf
        <div>
            <label for="coupon_id">Select Coupon:</label>
            <select name="coupon_id" id="coupon_id" required>
                @foreach($coupons as $coupon)
                    <option value="{{ $coupon->id }}">{{ $coupon->name }} ({{ $coupon->discount_amount }}% off)</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="product_id">Select Product:</label>
            <select name="product_id" id="product_id" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Apply Coupon</button>
    </form>
@endsection
