@extends('layouts.app')
@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }

    .login-left,
    .login-right {
        flex: 1;
        padding: 40px;
    }

    .login-left {
        background-color: #fff;
        text-align: center;
    }

    .login-left img {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
    }

    .login-right {
        background-color: #e9eef6;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-login {
        border-radius: 8px;
        background-color: #334eac;
        color: white;
        padding: 10px;
    }

    .btn-login:hover {
        background-color: #2c4194;
    }

</style>


<div class="login-container">
    <div class="login-box">
        <!-- LEFT SIDE -->
        <div class="login-left d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('assets/img/bg.png') }}" alt="">
        </div>

        <!-- RIGHT SIDE -->
        <div class="login-right">
            <h3 class="fw-bold">Selamat Datang!</h3>
            <p class="text-muted mb-4">Login untuk melanjutkan.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Masukan email" required autofocus>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-login w-100">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
