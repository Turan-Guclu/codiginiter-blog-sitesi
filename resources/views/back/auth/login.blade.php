@include('back.layouts.header')
@section('title','blog sitesi admin panel giriş')
@section('title','Panel')
<body class="bg-gradient-primary">
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Admin Panel'e Hoş Geldiniz.</h1>
                            </div>
                            @if(session('success'))
                            <div class="alert alert-success">
                                  {{ session('success') }}
                                  </div>
                            @endif
                            @if($errors->any())
                            <div class="alert alert-danger">
                                {!! $errors->first() !!}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('admin.login.post') }}" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" required class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="E-Posta Adresi...">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Şifre">
                                </div>
                               
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                  Giriş Yap
                                </button>
                     
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>



@include('back.layouts.footer')

