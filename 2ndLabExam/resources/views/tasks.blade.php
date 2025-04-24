<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts | List</title>

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
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

  <div class="container-fluid">
    <div class="d-flex justify-content-center align-items-center vh-100">
      <div class="col col-xl-5 col-lg-8 col-sm-10 p-3" style="overflow-y: auto; max-height: 95vh;">
        <div class="card">
          <div class="card-body">

            <h1 class="card-title">Tasks</h1>
            <div class="d-grid">
              <a href="{{ route('tasks.create') }}" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#AddTaskModal"><i class="bi bi-person-fill-add"></i> Add
                Task</a>
            </div>

            @forelse($tasks as $task)
        <div class="mt-3 d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center gap-2">
            <input type="checkbox" class="form-check-input mt-8" onchange="this.form.submit()" {{ $task->IsCompleted == 1 ? "Completed" : "Pending" }}>
          </div>
          <div>
            <h4 class="m-0 text-wrap">{{ $task->Title }}</h4>
            <small class="badge rounded-pill text-bg-{{ $task->IsCompleted == 1 ? "success" : "warning" }}">
            {{ $task->IsCompleted == 1 ? "Completed" : "Pending" }}
            </small>
            <p class="m-0 text-secondary text-wrap">{{ $task->Description }}</p>

          </div>
          </div>

          <div class="d-flex gap-2">
          <form action="{{ route('tasks.edit', $task->TaskID) }}" method="GET">
            @csrf
            <button class="btn btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="left"
            data-bs-title="Edit"><i class="bi bi-pencil-square"></i></button>
            <input type="hidden" name="ID" value="{{ $task->TaskID }}">
          </form>

          <form action="{{ route('tasks.destroy', $task->TaskID) }}" method="POST">
            <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="right"
            data-bs-title="Delete"><i class="bi bi-trash3"></i></button>
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="ID" value="{{ $task->TaskID }}">
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
                </div>
                <div class="form-floating mb-2">
                  <textarea class="form-control" placeholder="Write your thoughts here..." id="PostContent"
                    name="Description" style="height: 100px" required></textarea>
                  <label for="PostContent">Description</label>
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
  </script>
</body>

</html>