<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .full-height {
            height: 100%;
        }
    </style>
</head>
<body class="bg-light">
<div class="container-fluid full-height d-flex align-items-center justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <div class="p-4 border-0 shadow-sm card">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Travel System</h2>
                    @if (session('message'))
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                @endif
                
                @if (session('verified'))
                    <div class="alert alert-success">
                        Your email has been verified successfully. You can now log in.
                    </div>
                @endif
                    <form method="post" action="{{route('login')}}">
                        @csrf
                        <div class="mb-2 form-group">
                            <label class="form-label">Email Address
                                @error('email')
                                <span class="text-danger small">{{$message}}</span>
                                @enderror
                            </label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-2 form-group">
                    <label class="form-label">Password
                                @error('password')
                                <span class="text-danger small">{{$message}}</span>
                                @enderror
                            </label>

                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                            <a href="#" class="text-primary text-decoration-none small float-end">Forgot?</a>
                        </div>

                        <button type="submit" class="mb-3 btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
