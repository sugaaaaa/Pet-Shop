@extends('dashboard')

@section('content')
<head>
    <title>Product</title>
</head>

<section>
    <div class="grid grid-cols-3 gap-4"> 
        {{-- Table of Category --}}
        <div class="bg-white border dark:bg-gray-800 sm:rounded-lg col-span-2">
            <div class="px-4 py-3 space-y-3 lg:space-y-0 lg:space-x-4">
                <div class="flex items-center flex-1 space-x-4">
                    <h5>
                        <span class="text-gray-500">Total Categories:</span>
                        <span class="dark:text-white">{{ $categories->count() }}</span>
                    </h5>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center">Id</th>
                            <th scope="col" class="px-4 py-3 text-center">Category Name</th>
                            <th scope="col" class="px-4 py-3 text-center">Actions</th>
                            <th scope="col" class="px-4 py-3 text-center">Delete/Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{-- Id --}}
                            <td scope="row" class="w-4 px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Type Name --}}
                            <td class="px-4 py-2 text-center font-medium text-gray-900 whitespace-nowrap">
                                {{ $category->name }}
                            </td>

                            {{-- Action --}}
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                <a href="{{ url('/dashboard/category/show/'. $category->id) }}" title="View Item" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                </a>
                            </td>

                            {{-- Edit and Delete --}}
                            <td class="px-4 py-2 text-center">
                                <button id="{{ $loop->iteration }}" data-dropdown-toggle="{{ $category->name }}" class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="{{ $category->name }}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="pt-4 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="{{ $loop->iteration }}">
                                        <li>
                                            <form method="POST" action="{{ url('/dashboard/category/index/' . $category->id) }}" accept-charset="UTF-8" style="display:inline" class="block py-4 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                {{ csrf_field() }}
                                                <button type="submit" class="w-full text-start" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <a href="{{ url('/dashboard/category/update/'. $category->id) }}" title="Edit Item" class="block text-start py-4 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                                Edit
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Create Category --}}
        <div class="border rounded-lg">
            <form class="form-group" method="POST" action="{{url('/dashboard/category/create')}}" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="bg-blue-200 py-4 text-center text-xl font-semibold rounded-t-lg">
                    <h1><i class="fa-solid fa-plus pr-2"></i>Create New Category</h1>
                </div>
                <div class="my-5 px-5">
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flex flex-col gap-2">
                        <label for="crate-category">Name</label>
                        <input class="form-control py-2.5 px-2 rounded-lg border" type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Name of Category">
                    </div>
                    <div class="mt-4">
                        <button style="float: right;" class="bg-blue-300 py-2 px-4 rounded-lg hover:bg-blue-400" type="submit" name="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
