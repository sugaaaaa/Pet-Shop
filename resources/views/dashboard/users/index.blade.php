@extends('dashboard')

@section('content')
<section>
    <div class="m-5">
        <a class="font-bold">
            User
        </a>
    </div>
    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
        <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h5>
                    <span class="text-gray-500">All User:</span>
                    <span class="dark:text-white">2</span>
                </h5>
                <h5>
                    <span class="text-gray-500">Total User:</span>
                    <span class="dark:text-white">$88.4k</span>
                </h5>

                {{-- for search --}}
                <div class="card-header">
                    <div class="row">
                          @if ($message = Session::get('success'))
                          <div class="alert alert-success my-2">
                            <p>{{ $message }}</p>
                          </div>
                          @endif

                        <div class="">
                            <form class="" role="search" action="" method="GET" name="search">
                                <input name="query" type="search" placeholder="Search" aria-label="Search" class="bg-blue-200 px-10 py-1.5 rounded-lg" required>
                                <button class="text-gray-700 btn btn-outline-success bg-blue-200 hover:bg-blue-400 rounded-lg px-4 py-1.5" type="submit">Search</button>
                            </form>
                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
            <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <a href="{{ route('users.create') }}">
                    <button type="button" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-blue-200 border border-blue-300 rounded-lg focus:outline-none hover:bg-blue-400 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Craete New User
                    </button>
                </a>
            </div>

            
        </div>
        {{-- Display --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center">Id</th>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3 text-center">Phone Number</th>
                            <th scope="col" class="px-4 py-3 text-center">Actions</th>
                            <th scope="col" class="px-4 py-3 text-center">Delete/Edite</th>
                        </tr>
                    </thead>

                    <tbody>
                      @foreach ($data as $key => $user)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{-- Id --}}   
                                <td scope="row" class="w-4 px-4 py-3 text-center font-medium text-gray-900 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Name --}}
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                  {{ $user->name }}
                                </td>
                                 {{-- email --}}
                                 <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                  {{ $user->phone }}
                                </td>
                                  @if(!empty($user->getRoleNames()))
                                  @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-secondary text-dark">{{ $v }}</label>
                                  @endforeach
                                @endif

                                 {{-- Actions --}}
                                 <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                  <a href="{{ route('users.show',$user->id) }}" title="View Item" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                              </td>

                                {{-- Edit and Delete --}}
                                <td class="px-4 py-2 text-center">
                                    <button id="{{ $loop->iteration }}" data-dropdown-toggle="{{ $user->name}}" class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="{{ $user->name}}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="pt-4 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="{{ $loop->iteration }}">
                                            
                                            {{-- delete --}}
                                            <li>
                                                <form method="POST" action="{{ url('users.destroy' . $user->id)}}" accept-charset="UTF-8" style="display:inline" class="block py-4 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="w-full text-start" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                        <i class="fa fa-trash" class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                            {{-- edit --}}
                                            <li>
                                                <a href="{{ route('users.edit',$user->id) }}" title="Edit Item" class="block text-start py-4 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
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
</section>
@endsection