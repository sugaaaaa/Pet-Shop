@extends('dashboard')

@section('content')
<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4 mt-4">
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#ffe7ab] rounded-lg">
            <div>
                <i class="fa-solid fa-heart-pulse text-6xl pb-5 text-[#ffe7ab]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#ffe7ab]">Total Products: {{ $productCount }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#a5dfe0] rounded-lg">
            <div>
                <i class="fa-solid fa-users text-6xl pb-5 text-[#a5dfe0]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#a5dfe0]">Total Categories: {{ $categoryCount }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#ffabab] rounded-lg">
            <div>
                <i class="fa-solid fa-exclamation-triangle text-6xl pb-5 text-[#ffabab]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#ffabab]">Nearly Out of Stock:    @foreach ($products as $product)
            @if ($product->lowStock)
                <div class="alert alert-warning">
                     {{ $product->name }}
                </div>
            @endif
    @endforeach</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#ffcdab] rounded-lg">
            <div>
                <i class="fa-solid fa-hourglass-half text-6xl pb-5 text-[#ffcdab]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#ffcdab]">Pending Approval: {{ $pendingApprovalCount }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#abc6ff] rounded-lg">
            <div>
                <i class="fa-solid fa-shopping-cart text-6xl pb-5 text-[#abc6ff]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#abc6ff]">Orders This Month: {{ $orderCount }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#abc6ff] rounded-lg">
            <div>
                <i class="fa-solid fa-hourglass-half text-6xl pb-5 text-[#abc6ff]"></i>
                    <h1 class="text-3xl font-mono font-semibold text-[#abc6ff]">Total Quantity Ordered: {{ $pendingApprovalCount }} </h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#abc6ff] rounded-lg">
            <div>
                <i class="fa-solid fa-check-circle text-6xl pb-5 text-[#abc6ff]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#abc6ff]">Approved Orders: {{ $approvedOrders }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#abc6ff] rounded-lg">
            <div>
                <i class="fa-solid fa-ban text-6xl pb-5 text-[#abc6ff]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#abc6ff]">Cancelled Orders: {{ $cancelledOrders }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#abc6ff] rounded-lg">
            <div>
                <i class="fa-solid fa-truck text-6xl pb-5 text-[#abc6ff]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#abc6ff]">Shipped Orders: {{ $shippedOrders }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#abc6ff] rounded-lg">
            <div>
                <i class="fa-solid fa-box-open text-6xl pb-5 text-[#abc6ff]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#abc6ff]">Delivered Orders: {{ $deliveredOrders }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#ffc6ff] rounded-lg">
            <div>
                <i class="fa-solid fa-tags text-6xl pb-5 text-[#ffc6ff]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#ffc6ff]">Total Coupons: {{ $coupons }}</h1>
            </div>
        </div>
        <div class="text-center pt-5 pb-5 border-2 border-dashed border-[#c6ffc6] rounded-lg">
            <div>
                <i class="fa-solid fa-percentage text-6xl pb-5 text-[#c6ffc6]"></i>
                <h1 class="text-3xl font-mono font-semibold text-[#c6ffc6]">Products with Discount: {{ $product_discount }}</h1>
            </div>
        </div>
    </div>
    <div class="mt-10">
        <canvas id="entityChart" width="400" height="400"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('entityChart').getContext('2d');
    var entityChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Product', 'Category', 'Nearly Out of Stock', 'Pending Approval', 'Orders This Month', 'Pending Orders', 'Approved Orders', 'Cancelled Orders', 'Shipped Orders', 'Delivered Orders'],
            datasets: [{
                label: 'Entity Distribution',
                data: [{{ $productCount }}, {{ $categoryCount }}, {{ $nearlyOutOfStockCount }}, {{ $pendingApprovalCount }}, {{ $orderCount }}, {{ $approvedOrders }}, {{ $cancelledOrders }}, {{ $shippedOrders }}, {{ $deliveredOrders }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 71, 0.5)',
                    'rgba(60, 179, 113, 0.5)',
                    'rgba(30, 144, 255, 0.5)',
                    'rgba(138, 43, 226, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 71, 1)',
                    'rgba(60, 179, 113, 1)',
                    'rgba(30, 144, 255, 1)',
                    'rgba(138, 43, 226, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Entity Distribution'
            },
            legend: {
                display: true,
                position: 'right'
            }
        }
    });
</script>
@endsection
