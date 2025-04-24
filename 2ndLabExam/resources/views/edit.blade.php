<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks - Edit</title>

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

              <h1 class="card-title">Edit Task</h1>
              <form method="POST" action="{{ route('tasks.update', $task->TaskID) }}">
                @csrf
                @method('PUT')
                <div class="row g-3">
                  <div class="col-span">
                    <div class="form-floating mb-2">
                      <input type="text" class="form-control" id="PostTitle" name="Title"
                        placeholder="{{ $task->Title }}" value="{{ old('Title', $task->Title) }}" required>
                      <label for="Title">Title</label>
                      @error('Title')
                        <div class="text-danger ms-2">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-floating mb-2">
                      <textarea class="form-control" placeholder="Description..." id="PostContent" name="Description" style="height: 100px"
                        required>{{ old('Description', $task->Description) }}</textarea>
                      <label for="PostContent">Description</label>
                      @error('Description')
                        <div class="text-danger ms-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="modal-footer mt-2 p-0">
                  <div class="mt-2">
                    <a href="{{ route('tasks.index') }}" type="button" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form>
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
                    <textarea class="form-control" placeholder="Write your thoughts here..." id="PostContent" name="Description"
                      style="height: 100px" required></textarea>
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
