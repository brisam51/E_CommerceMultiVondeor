@extends('admin.layout.layout')
@section('content')
    <div class="container">
        
        <div class="col-lg-6 col-offset-6 centered">


            <div class="card-body ">
                <h4 class="card-title">Update personal Informatiom</h4>

                @if (Session::has('error_message'))
                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                            aria-label="Warning:">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <div>
                            {{ Session::get('error_message') }}
                        </div>
                    </div>
                @endif

                @if (Session::has('sucess_message'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{ Session::get('sucess_message') }}
                    </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
               <ul>
                @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
            </ul>
           </div>
           @endif

                <form class="forms-sample" action="{{ url('admin/update-admin-detials') }}" enctype="multipart/form-data"  method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Username/Email</label>
                        <input type="text" class="form-control" id="exampleInputUsername1"
                            value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Admin Type</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"
                            value="{{ Auth::guard('admin')->user()->type }}" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="admin_name">Name</label>
                        <input type="text" class="form-control" id="admin_name"
                            value="{{ Auth::guard('admin')->user()->name }}" name="admin_name">

                    </div>
                    <div class="form-group">
                        <label for="admin_mobile">Mobile</label>
                        <input type="text" class="form-control" id="admin_mobile"
                            value="{{ Auth::guard('admin')->user()->mobile }}" name="admin_mobile" 
                             placeholder="Inter 10 digte for mobile number">
                    </div>
                    <div class="form-group">
                        <label for="admin_image">Admin Image</label>
                        <input type="file" class="form-control" id="admin_image"
                            value="" name="admin_image" >
                            @if(!empty(Auth::guard('admin')->user()->image))
                            <a href="{{url('admin/images/photos/'.Auth::guard('admin')->user()->image)}}">view image</a>

                            <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                            @endif
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>

    </div>
@endsection
