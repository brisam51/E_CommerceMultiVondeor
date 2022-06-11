
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url('admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{url('admin/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{url('admin/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{url('admin/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url('admin/images/favicon.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{url('admin/images/logo.svg')}}" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>


              @if(Session::has('error_message'))

              <div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
  <div>
    {{Session::get('error_message')}}
  </div>
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
              <form  action="{{url ('admin/login')}}" class="pt-3" method="post">
                @csrf
                <div class="form-group">

                  <input type="text"  name="email" class="form-control form-control-lg" id="email" placeholder="Insert your email" >
                </div>
                <div class="form-group">
                  <input type="password"  name="password" class="form-control form-control-lg" id="password" placeholder=" Insert Password" >
                </div>
                <div class="mt-3">
                 
                  <button  type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{url('admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{url('admin/js/off-canvas.js')}}"></script>
  <script src="{{url('admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{url('admin/js/template.js')}}"></script>
  <script src="{{url('admin/js/settings.js')}}"></script>
  <script src="{{url('admin/js/todolist.js')}}"></script>
  <!-- endinject -->
</body>

</html>
