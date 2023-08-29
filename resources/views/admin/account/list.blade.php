@extends('admin.layouts.master')

@section('title', 'Admin List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin Lists</h2>

                            </div>
                        </div>
                        {{-- <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Admin
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div> --}}
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- Data Searching --}}
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>

                        <div class="col-3 offset-6 mb-3">
                            <form action="{{ route('admin#list') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..."
                                        value="{{ request('key') }}">
                                    <button type="submit" class="btn bg-dark text-white">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-5 mb-2">
                            <h3><i class="fa-solid fa-database mr-2 text-info"></i>{{ $admin->total()}}</h3>
                        </div>
                    </div>

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <td class="col-2">
                                                @if($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/default_user_male.png') }}" class="img-thumbnail shadow-sm">
                                                    @else
                                                        <img src="{{ asset('image/default_user_female.png') }}" class="img-thumbnail shadow-sm">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm"></td>
                                                @endif
                                            <td>{{$a->name}}</td>
                                            <td>{{$a->email}}</td>
                                            <td>{{$a->gender}}</td>
                                            <td>{{$a->phone}}</td>
                                            <td>{{$a->address}}</td>


                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- cannot delete self admin account --}}
                                                    @if(Auth::user()->id == $a->id)

                                                    @else
                                                        <a href="{{ route('admin#changeRole',$a->id)}}">
                                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                                <i class="fa-solid fa-person-circle-minus"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin#delete', $a->id) }}">
                                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Pagination --}}
                            <div class="mt-3">
                                {{ $admin->links() }}
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
