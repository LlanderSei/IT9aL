<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>

  <body>
    <div class="d-flex justify-content-center align-items-center vh-100">
      <div class="card shadow-lg" style="width: 25rem;">
        <div class="card-body">
          <h5 class="card-title text-center mb-3">Login</h5>
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="hidden" name="AuthType" value="Login">
            <div class="row g-3">
              <div class="col-span">
                <div class="form-floating mb-2">
                  <input type="email" class="form-control" id="LoginEmail" placeholder="Enter Email" name="email"
                    value="{{ old('email') }}" required>
                  <label for="LoginEmail">Email</label>
                  @error('email')
                    <div class="text-danger ms-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-span">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="LoginPassword" placeholder="Enter Password"
                      name="password" required>
                    <label for="LoginPassword">Password</label>
                    @error('password')
                      <div class="text-danger ms-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="d-grid mt-3 text-center g-3">
                  <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
          </form>

          <div class="d-grid mt-2 text-center g-3">
            <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
              data-bs-target="#RegisterModal">Register</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="RegisterModal">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <input type="hidden" name="AuthType" value="Register">
              <div class="row g-3">
                <div class="col-span">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="Name" placeholder="Enter your name"
                      name="name" value="{{ old('name') }}" required>
                    <label for="Name">Name</label>
                    @error('name', 'register')
                      <div class="text-danger ms-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-span">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="RegEmail" placeholder="Enter email" name="email"
                      value="{{ old('email') }}" required>
                    <label for="RegEmail">Email</label>
                    @error('email', 'register')
                      <div class="text-danger ms-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-span">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="RegPassword" placeholder="Enter Password"
                      name="password" required>
                    <label for="RegPassword">Password</label>
                    @error('password', 'register')
                      <div class="text-danger ms-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-span">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="ConfPassword" placeholder="Retype Password"
                      name="password_confirmation" required>
                    <label for="ConfPassword">Confirm Password</label>
                    @error('password_confirmation', 'register')
                      <div class="text-danger ms-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="modal-footer mt-2 p-0">
                <div class="mt-2">
                  <button type="button" id="ModalCloseBtn" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Toast -->
    <div id="toastsContainer"
      style="z-index: 9999; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: 300px;">
      @if (session('toast_success'))
        <div class="toast align-items-center text-bg-success mb-2" role="alert" aria-live="polite"
          aria-atomic="true">
          <div class="d-flex justify-content-center">
            <div class="toast-body text-center">
              {{ session('toast_success') }}
            </div>
          </div>
        </div>
      @endif
      @if (session('toast_error'))
        <div class="toast align-items-center text-bg-danger mb-2" role="alert" aria-live="polite"
          aria-atomic="true">
          <div class="d-flex justify-content-center">
            <div class="toast-body text-center">
              {{ session('toast_error') }}
            </div>
          </div>
        </div>
      @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      @if ($errors->register->any())
        new bootstrap.Modal(document.getElementById('RegisterModal')).show();
      @endif

      document.querySelectorAll('.toast').forEach(toast => {
        new bootstrap.Toast(toast).show();
      });
    </script>
  </body>

</html>
