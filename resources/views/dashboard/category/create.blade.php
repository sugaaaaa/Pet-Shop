@extends('dashboard')

@section('content')
    <section class="max-w-screen-2xl mx-auto px-10">
        <div>
            <a href="javascript:void(0);" onclick="history.back()">
                <i class="fa-solid fa-arrow-left text-2xl bg-blue-300 px-4 py-2.5 text-gray-700 hover:bg-blue-400 rounded-full"></i>
            </a>
        </div>

        <div class="mt-10 border">
            <form class="form-group" method="POST" action="{{url('/dashboard/category/create')}}" enctype="multipart/form-data">

                {!! csrf_field() !!}
                <div class="bg-blue-200 py-4 text-center text-xl font-semibold">
                    <h1>Create New Category</h1>
                </div>
                <div class="flex items-center my-5 justify-between px-10">
                    <div class="flex flex-col gap-2">
                        <label for="crate-category">Name</label>
                        <input class="form-control bg-gray-100 py-4 px-2 w-[400px]" type="text" name="name" id="name" required placeholder="Name of Category">
                    </div>
                    <div>
                        <button style="float: right;" class="btn btn-primary text-uppercase" type="submit" name="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection 

