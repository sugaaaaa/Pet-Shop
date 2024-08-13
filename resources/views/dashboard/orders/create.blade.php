@extends('dashboard')

@section('content')
<div class="container">
    <h1>Create Order</h1>
    <form action="{{ url('dashboard.orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="products">Select Products</label>
            <select multiple class="form-control" id="products" name="products[]">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>
@endsection
