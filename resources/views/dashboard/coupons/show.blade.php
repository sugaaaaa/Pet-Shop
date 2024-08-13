@extends('dashboard')
@section('content')
    <section class="max-w-screen-2xl mx-auto px-10">
        <div class="flex justify-between items-center">
            <a href="javascript:void(0);" onclick="history.back()">
                <i class="fa-solid fa-arrow-left text-2xl bg-blue-300 px-4 py-2.5 text-gray-700 hover:bg-blue-400 rounded-full"></i>
            </a>
            <div class="flex items-center gap-2 font-semibold">
                <i class="fa-solid fa-pen-to-square"></i>
             </div>
        </div>
        {{-- Show Products --}}
        <div class="mt-20 grid grid-cols-2">

            {{-- About product --}}
            <div class="text-lg font-medium">
                <h1 class="text-2xl mb-5 font-semibold">For   :</h1>
                <h1>Code  : {{ $coupon->code }}</h1>
                <h1>Name  : {{ $coupon->name }}</h1>
                <h1 class="text-rose-500">Price : {{ $coupon->discount_amount }}</h1>
                <h1>Size  : {{ $coupon->starts_at}}</h1>
                <h1>Detail: {{ $coupon->expires_at}}</h1>
                <h1>Detail: {{ $coupon->status}}</h1>
        </div>
    </section>
@endsection  
