<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
      .text-wrap {
        word-wrap: break-word;
        word-break: break-word;
        white-space: pre-line;
      }

      .post-body {
        max-height: 5em;
        overflow: hidden;
        transition: max-height 0.3s ease;
      }

      .post-body.expanded {
        max-height: none;
      }
    </style>
  </head>

  <body>
    <div class="container-fluid vh-100">
      <div class="row h-100 justify-content-center align-items-start">
        <div class="col col-8 p-3">
          <div class="card">
            <div class="card-body">
              <h1 class="card-title text-center">Welcome, {{ auth()->user()->name }}!</h1>
              <p class="card-title text-center text-secondary">You are logged in as {{ auth()->user()->email }}</p>
              <div class="d-grid mt-2 text-center g-3">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-danger w-100">Logout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- TOAST --}}
    <div id="toastsContainer"
      style="z-index: 9999; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: 300px;">
      @if (session('toast_success'))
        <div class="toast align-items-center text-bg-success mb-2" role="alert" aria-live="polite" aria-atomic="true">
          <div class="d-flex justify-content-center">
            <div class="toast-body text-center">
              {{ session('toast_success') }}
            </div>
          </div>
        </div>
      @endif
      @if (session('toast_error'))
        <div class="toast align-items-center text-bg-danger mb-2" role="alert" aria-live="polite" aria-atomic="true">
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
      document.addEventListener('DOMContentLoaded', function() {
        const toasts = document.querySelectorAll('#toastsContainer .toast');
        toasts.forEach(toast => {
          const bsToast = new bootstrap.Toast(toast, {
            delay: 5000
          });
          bsToast.show();
        });

      });
    </script>
  </body>

</html>
