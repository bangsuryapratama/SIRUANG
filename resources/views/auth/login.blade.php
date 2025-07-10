<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/backend/img/logo.png')}}" />
  <link rel="stylesheet" href="{{ asset('assets/backend/css/styles.css')}}" />
  <title>LOGIN</title>
</head>
<body>
  <div class="preloader">
    <img src="{{ asset('assets/backend/images/logos/favicon.png')}}" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper" class="auth-customizer-none">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row">
          <div class="col-xl-7 col-xxl-8">
            <a href="{{ url('/') }}" class="text-nowrap logo-img d-block px-4 py-9 w-100">
              <img src="{{ asset('assets/backend/img/logo.png')}}" class="dark-logo" alt="Logo-Dark" style="height: 50px;"/>
            </a>
            <div class="d-none d-xl-flex align-items-center justify-content-center h-n80">
              <img src="{{ asset('assets/backend/images/backgrounds/login-security.svg')}}" alt="modernize-img" class="img-fluid" width="500">
            </div>
          </div>
          <div class="col-xl-5 col-xxl-4">
            <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
              <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-4">
                <h2 class="mb-1 fs-7 fw-bolder">Selamat datang!</h2>
                <p class="mb-7">Silahkan login untuk melanjutkan.</p>
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                      name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                      name="password" required autocomplete="current-password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">{{ __('Login') }}</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function handleColorTheme(e) {
        document.documentElement.setAttribute("data-color-theme", e);
      }
    </script>
    <!-- Customizer & Theme Settings (tidak diubah) -->
    <!-- ... -->
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <script src="{{ asset('assets/backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/backend/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{ asset('assets/backend/js/theme/app.init.js')}}"></script>
  <script src="{{ asset('assets/backend/js/theme/theme.js')}}"></script>
  <script src="{{ asset('assets/backend/js/theme/app.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>
</html>
