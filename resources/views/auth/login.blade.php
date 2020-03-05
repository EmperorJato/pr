@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has("error"))
    <script type="text/javascript">
        $(function(){
            swal("Login Failed", "Please contact the administrator to access your account. Thank You", "error").then(function(){
                window.location.href = "{{url('/')}}";
            });
        });
    </script>
    @endif
    @if(session()->has("sessionTimeOut"))
    <script type="text/javascript">
        $(function(){
            swal("Inactive", "This user is inactive. Please Login again", "error");
        });
    </script>
    @endif

    <img class="wave" src="{{asset('images/bg2.png')}}">
	<div class="container">
		
		<div class="login-content">
			<form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div class="cent">
                    <img src="{{asset('images/avatar.svg')}}">
                    <h2 class="title">Sign in</h2>
                </div>
				
                <div class="md-form">

                    <i class="fas fa-user prefix"></i>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                    <label for="username">{{ __('Username') }}</label>
            

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <div class="text-center">
                                <strong>{{ $message }}</strong>
                            </div>
                        </span>
                        @enderror
                   
                </div>
                <div class="md-form">

                    <i class="fas fa-lock prefix"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <label for="password">{{ __('Password') }}</label>
                    
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <div class="text-center">
                            <strong>{{ $message }}</strong>
                        </div>
                    </span>
                    @enderror
                </div>
                
            	<button type="submit" class="btn">
                    {{ __('Login') }}
                </button>
            </form>
        </div>
        <div class="img">
			<img src="{{asset('images/login-bg.svg')}}">
		</div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user"> </i>
                                    {{ __('Login') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
