
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>CRM - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/retronotify.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
            /** Loader **/
            .loader{
              display: none;
              position: fixed;
              top: 0;bottom: 0;left: 0;right: 0;
              width: 100%;
              height: 100vh;
              background-color: rgba(2,2,2,0.4);
              text-align: center;
              z-index: 9999;
            }
            .lds-ellipsis {
              display: inline-block;
              position: relative;
              top: 40%;
              width: 80px;
              height: 80px;
            }
            .lds-ellipsis div {
              position: absolute;
              top: 33px;
              width: 13px;
              height: 13px;
              border-radius: 50%;
              background: #fff;
              animation-timing-function: cubic-bezier(0, 1, 1, 0);
            }
            .lds-ellipsis div:nth-child(1) {
              left: 8px;
              animation: lds-ellipsis1 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(2) {
              left: 8px;
              animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(3) {
              left: 32px;
              animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(4) {
              left: 56px;
              animation: lds-ellipsis3 0.6s infinite;
            }
            @keyframes lds-ellipsis1 {
              0% {
                transform: scale(0);
              }
              100% {
                transform: scale(1);
              }
            }
            @keyframes lds-ellipsis3 {
              0% {
                transform: scale(1);
              }
              100% {
                transform: scale(0);
              }
            }
            @keyframes lds-ellipsis2 {
              0% {
                transform: translate(0, 0);
              }
              100% {
                transform: translate(24px, 0);
              }
            }
            
        </style>
    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="loader">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>    
        </div>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="{{ url('login') }}">
                                      @include('layouts/logo')
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access CRM system.</p>
                                </div>

                                <h5 class="auth-title">Sign In</h5>

                                <form action="{{ url('login') }}" method="POST" class="ajax-form" data-redirect="{{ url('/') }}">
                                    @csrf
                                    @include('layouts/error')
                                    <div class="form-group mb-3">
                                        <label for="email">Email address</label>
                                        <input class="form-control" type="email" name="email" id="email" required="" value="ahmedh12491@gmail.com" placeholder="Enter your email" @error('email') is-invalid @enderror>
                                    </div>
                                    <div class="form-group">
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" value="24882533" placeholder="Enter your password">
                                    </div>
                                    <div class="form-group">
                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-danger btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="{{ route('password.request') }}" class="text-muted ml-1">Forgot your password?</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <footer class="footer footer-alt">
            {{ date('Y') }} &copy; developed by <a href="https://91ahmed.github.io" target="_blank" class="text-muted">ahmed hassan</a> 
        </footer>

        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/js/retronotify.js') }}"></script>
        <script src="{{ asset('assets/js/form-ajax.js') }}"></script>
    </body>
</html>