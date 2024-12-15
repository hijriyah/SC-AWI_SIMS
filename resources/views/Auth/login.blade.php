<!doctype html>
<html lang="en" >

<head>

    <meta charset="utf-8" />
    <title>Login SIMSUBA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('Qovex/HTML/dist/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('Qovex/HTML/dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('Qovex/HTML/dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('Qovex/HTML/dist/assets/css/app.min.css') }}"  id="app-style"  rel="stylesheet" type="text/css" />

</head>

<body>

    <script>
       
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}")
        @endif
    </script>

    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-reset"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">Selamat Datang</h5>
                                <p class="text-white-50 mb-0">Masuk untuk melanjutkan ke SIMSUBA</p>
                                <a href="index.html" class="logo logo-admin mt-4">
                                    <img src="{{ asset('Qovex/HTML/dist/assets/images/logo-sm-dark.png') }}" alt="" height="60">
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <div class="p-2">
                                <form class="form-horizontal" id="LoginSubmit" action="{{ route('login-process') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username">
                                        @error('username')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword"
                                        name="password">
                                        @error('password')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customControlInline">
                                        <label class="form-check-label" for="customControlInline">Ingatkan saya.</label>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" style="background-color: #CC5500; border-color: #CC5500;">Masuk</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="pages-recoverpw.html" class="text-muted"><i
                                                class="mdi mdi-lock me-1"></i> Lupa kata sandi Anda?</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <!--<p>Don't have an account ? <a href="pages-register.html"
                                class="fw-medium text-primary"> Signup now </a> </p>
                        <p>©-->
                            <script>document.write(new Date().getFullYear())</script> SIMSUBA. @SMP Islam Terpadu Utsman Bin Affan Surabaya
                            <!--<i  class="mdi mdi-heart text-danger"></i> by Themesbrand-->
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('Qovex/HTML/dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Qovex/HTML/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Qovex/HTML/dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('Qovex/HTML/dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('Qovex/HTML/dist/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('Qovex/HTML/dist/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('Qovex/HTML/dist/assets/js/app.js') }}"></script>

</body>

</html>