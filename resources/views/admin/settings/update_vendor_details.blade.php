@extends('admin.layout.layout')
@section('content')
   
        <div class="container">
            @if ($slug == 'personal')
            <div class="col-lg-8 col-offset-6 centered">


                <div class="card-body ">
                    <h4 class="card-title">Update personal details</h4>

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

                    <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="vendor_email">Username/Email</label>
                            <input type="text" class="form-control" id="exampleInputUsername1"
                                value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="vendor_name">Name</label>
                                    <input type="text" class="form-control" id="vendor_name"  name="vendor_name"
                                        value="{{ Auth::guard('admin')->user()->name }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="vendor_mobile">mobile</label>
                                    <input type="text" class="form-control" id="vendor_mobile" name="vendor_mobile"
                                        value="{{ Auth::guard('admin')->user()->mobile }}">
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="vendor_city">City</label>
                                    <input type="text" class="form-control" id="vendor_city" name="vendor_city" 
                                    value="{{$vendorDetails['city']}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="vendor_state">state</label>
                                    <input type="text" class="form-control" id="vendor_state" name="vendor_state" 
                                    value="{{$vendorDetails['state']}}">
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="vendor_country">Country</label>
                                    <input type="text" class="form-control" id="vendor_country" name="vendor_country" 
                                    value="{{$vendorDetails['country']}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="vendor_pincode">Pin Code</label>
                                    <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode" 
                                    value="{{$vendorDetails['pincode']}}">
                                </div>

                            </div>
                        </div>



                        <div class="form-group">
                            <label for="vendor_address">address</label>
                            <input type="text" class="form-control" id="vendor_address" name="vendor_address"
                                value="{{$vendorDetails['address']}}">
                        </div>



                        <div class="form-group">
                            <label for="vendor_image">Admin Image</label>
                            <input type="file" class="form-control" id="admin_image" value="" name="vendor_image">
                            @if (!empty(Auth::guard('admin')->user()->image))
                                <a href="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}">view
                                    image</a>

                                <input type="hidden" name="current_vendor_image"
                                    value="{{ Auth::guard('admin')->user()->image }}">
                            @endif
                        </div>




                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>

                    </form>
                </div>

            </div>
            @elseif($slug =="bussiness")
            <div class="container">
                <div class="col-lg-8 col-offset-6 centered">
                    <div class="card-body ">
                        <h4 class="card-title">Update Business Details</h4>
    
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
    
                        <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}"
                            enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="vendor_email">Username/Email</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_name">Shop Name</label>
                                        <input type="text" class="form-control" id="shop_name"  name="shop_name"
                                            value="{{ Auth::guard('admin')->user()->name }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_mobile">shop mobile</label>
                                        <input type="text" class="form-control" id="shop_mobile" name="shop_mobile"
                                            value="{{ Auth::guard('admin')->user()->mobile }}">
                                    </div>
    
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_city">City</label>
                                        <input type="text" class="form-control" id="shop_city" name="shop_city" 
                                        value="{{$vendorDetails['city']}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_state">state</label>
                                        <input type="text" class="form-control" id="shop_state" name="shop_state" 
                                        value="{{$vendorDetails['state']}}">
                                    </div>
    
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_country">Country</label>
                                        <input type="text" class="form-control" id="shop_country" name="shop_country" 
                                        value="{{$vendorDetails['country']}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_pincode">Pin Code</label>
                                        <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" 
                                        value="{{$vendorDetails['pincode']}}">
                                    </div>
    
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_websit">Country</label>
                                        <input type="text" class="form-control" id="shop_websit" name="shopr_websit" 
                                        value="{{$vendorDetails['country']}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_pincode">Pin Code</label>
                                        <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" 
                                        value="{{$vendorDetails['pincode']}}">
                                    </div>
    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shop_address">address</label>
                                <input type="text" class="form-control" id="shop_address" name="shop_address"
                                    value="{{$vendorDetails['address']}}">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_gst">gst number</label>
                                        <input type="text" class="form-control" id="shop_gst" name="shopr_gst" 
                                        value="{{$vendorDetails['country']}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_pan_number">pan number</label>
                                        <input type="text" class="form-control" id="shop_pan_number" name="shop_pan_number" 
                                        value="{{$vendorDetails['pincode']}}">
                                    </div>
    
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shop_Address_proof">Address Proof</label>
                                        <select class="form-control" name="shop_address_proof" id="shop_address_proof">
                                            <option value="passport">Passport</option>
                                            <option value="voting carde">Voting Carde</option>
                                            <option value="pan">Pan</option>
                                            <option value="drivun license">Deriving License</option>
                                        </select>                                   
                                    </div>
                                </div>
                               
                            </div>
                            <div class="form-group">
                                <label for="shop_address_proof_image">Address proof image</label>
                                <input type="file" class="form-control" id="shop_address_proof_image" value="" name="shop_address_proof_image">
                                @if (!empty(Auth::guard('admin')->user()->image))
                                    <a href="{{ url('admin/images/proof/' . Auth::guard('admin')->user()->image) }}">view
                                        image</a>
    
                                    <input type="hidden" name="current_vendor_image"
                                        value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
                            </div>
    
    
    
    
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
    
                        </form>
                    </div>
                </div>
    
            @elseif($slug == 'bank')
        @endif
    </div>
@endsection
