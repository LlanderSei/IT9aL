<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
      .text-wrap {
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
      }
    </style>
  </head>

  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <div class="container-fluid">
      <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col col-xl-5 col-lg-8 col-sm-10 p-3" style="overflow-y: auto; max-height: 95vh;">
          <div class="card">
            <div class="card-body">

              <h1 class="card-title">Tasks</h1>
              <div class="d-grid">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddTaskModal">
                  <i class="bi bi-pencil-square"></i> Add Task
                </button>
              </div>
              @if (session('success'))
                <div class="alert alert-success mt-2">{{ session('success') }}</div>
              @endif

              @forelse($tasks as $task)
                <div class="mt-3 d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                      <form action="{{ route('tasks.complete', $task->TaskID) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" name="IsCompleted" class="form-check-input mt-0"
                          onchange="this.form.submit()" {{ $task->IsCompleted ? 'checked' : '' }}>
                      </form>
                    </div>
                    <div>
                      <div class="d-flex align-items-center gap-2">
                        <h4 class="m-0 text-wrap">{{ $task->Title ?? 'Title Missing' }}</h4>
                        <small class="badge rounded-pill text-bg-{{ $task->IsCompleted ? 'success' : 'warning' }}">
                          {{ $task->IsCompleted ? 'Completed' : 'Pending' }}
                        </small>
                      </div>
                      <h3 class="m-0 text-wrap">{{ $task->Description ?? 'Description Missing' }}</h3>
                    </div>
                  </div>

                  <div class="d-flex gap-2">
                    <form action="{{ route('tasks.edit', $task->TaskID) }}" method="GET">
                      <button class="btn btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="left"
                        data-bs-title="Edit"><i class="bi bi-pencil-square"></i></button>
                    </form>

                    <form action="{{ route('tasks.destroy', $task->TaskID) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-title="Delete">
                        <i class="bi bi-trash3"></i>
                      </button>
                    </form>
                  </div>
                </div>
              @empty
                <div class="mt-3 justify-content-between align-items-center">
                  <h3 class="text-center">There are no tasks available.</h3>
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal: Create Post -->
    <div class="modal fade" id="AddTaskModal">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="CreatePostModalLabel">Add Task</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('tasks.store') }}">
              @csrf
              <div class="row g-3">
                <div class="col-span">
                  <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="PostTitle" name="Title" placeholder="" required>
                    <label for="Title">Title</label>
                    @error('Title')
                      <div class="text-danger ms-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Write your thoughts here..." id="PostContent" name="Description"
                      style="height: 100px" required></textarea>
                    <label for="PostContent">Description</label>
                    @error('Description')
                      <div class="text-danger ms-2">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="modal-footer mt-2 p-0">
                <div class="mt-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

      @if ($errors->any())
        new bootstrap.Modal(document.getElementById('AddTaskModal')).show();
      @endif
    </script>
  </body>

</html>
