@extends('admin.layouts.master')

@section('title','Products Edit Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-5 offset-5 mb-2">
                @if (session('updateSuccess'))
                        <div class="">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                {{-- <a href=" {{ route('product#list') }}"> --}}
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                {{-- </a> --}}
                            </div>
                            <div class="card-title">
                                {{-- <h3 class="text-center title-2">Pizza Details</h3> --}}
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    <img src="{{asset('storage/'. $pizza->image )}}" class="img-thumbnail shadow-sm">
                                </div>
                                <div class="col-7">
                                    <div class="my-3 btn bg-warning text-white d-block w-75 fs-5"> <i class="fa-solid fs-5 fa-pizza-slice me-2"></i> {{ $pizza->name }}</div>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-money-check-dollar me-2"></i> {{ $pizza->price }} kyats</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-clock me-2"></i> {{ $pizza->waiting_time }}mins</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-eye me-2"></i> {{ $pizza->view_count }}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-clone me-2"></i> {{ $pizza->category_name }}</span>
                                    <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-calendar me-2"></i> {{ $pizza->created_at->format('j-F-Y')}}</span>

                                    <div class="my-3"> <i class="fa-solid fs-4 fa-note-sticky me-2"></i>Description</div>
                                    <div>{{ $pizza->description }}</div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-4 offset-2 mt-3">
                                    <a href="{{ route('admin#edit')}}">
                                        <button class="btn bg-dark text-white">
                                            <i class="fa-solid fa-file-pen me-2"></i>Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
