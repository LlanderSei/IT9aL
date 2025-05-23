<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>

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
              <h1 class="card-title text-center">My Blogs</h1>
              <div class="d-grid mt-2 text-center g-3">
                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal"
                  data-bs-target="#CreatePostModal">Post something...</button>
              </div>

              {{-- POST CONTAINER --}}
              @forelse ($posts as $post)
                <div class="mt-3 d-flex flex-column">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                      <h1 class="bi bi-person-circle m-0"></h1>
                      <div>
                        <h5 class="m-0 text-wrap">The Chaos Star</h5>
                        <p class="m-0 text-secondary text-wrap">
                          #{{ $post->PostID }} | Posted at: {{ $post->created_at->format('m-d-Y h:i:s A') }}
                          @if ($post->created_at->notEqualTo($post->updated_at))
                            <span class="text-muted">(Edited)</span>
                          @endif
                        </p>
                      </div>
                    </div>
                    <div class="d-flex gap-2">
                      <button type="button" class="btn btn-outline-success edit-post-btn" data-bs-toggle="modal"
                        data-bs-target="#EditPostModal" data-post-id="{{ $post->PostID }}"
                        data-post-title="{{ e($post->Title) }}" data-post-body="{{ e($post->Body) }}"
                        data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Edit">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <form action="{{ route('posts.destroy', $post->PostID) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="right"
                          data-bs-title="Delete">
                          <i class="bi bi-trash3"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                  <div style="margin-left: 55px" class="mt-2">
                    <h4 class="m-0 text text-wrap">{{ $post->Title }}</h4>
                    <div class="post-container">
                      <h5 class="m-0 text text-wrap post-body">{!! nl2br(e($post->Body)) !!}</h5>
                      @if (str($post->Body)->explode("\n")->count() > 3)
                        <button type="button" class="btn btn-link p-0 mt-1 toggle-btn">Read more</button>
                      @endif
                    </div>
                    @if ($post->created_at->notEqualTo($post->updated_at))
                      <p class="mt-1 mb-0 text-secondary text-wrap">Edited at:
                        {{ $post->updated_at->format('m-d-Y h:i:s A') }}</p>
                    @endif
                  </div>
                </div>
              @empty
                <div class="mt-3 justify-content-between align-items-center">
                  <h3 class="text-center">There's nothing here but tumbleweeds... Post something instead.</h3>
                </div>
              @endforelse
              {{-- POST CONTAINER END --}}

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal: Create Post -->
    <div class="modal fade" id="CreatePostModal">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="CreatePostModalLabel">Post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('posts.store') }}">
              @csrf
              <div class="row g-3">
                <div class="col-span">
                  <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="PostTitle" name="Title" placeholder="" required>
                    <label for="PostTitle">Title</label>
                  </div>
                  <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Write your thoughts here..." id="PostContent" name="Body"
                      style="height: 300px" required></textarea>
                    <label for="PostContent">Comments</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer mt-2 p-0">
                <div class="mt-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Publish</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal: Edit Post -->
    <div class="modal fade" id="EditPostModal">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Edit Post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" id="editPostForm">
              @csrf
              @method('PUT')
              <input type="hidden" name="PostID" id="editPostId">
              <div class="row g-3">
                <div class="col-span">
                  <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="editPostTitle" name="Title" placeholder=""
                      required>
                    <label for="editPostTitle">Title</label>
                  </div>
                  <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Write your thoughts here..." id="editPostContent" name="Body"
                      style="height: 300px" required></textarea>
                    <label for="editPostContent">Comments</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer mt-2 p-0">
                <div class="mt-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- TOAST --}}
    <div id="toastsContainer"
      style="z-index: 9999; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: 300px;">
      @if (session('success'))
        <div class="toast align-items-center text-bg-success mb-2" role="alert" aria-live="polite"
          aria-atomic="true">
          <div class="d-flex justify-content-center">
            <div class="toast-body text-center">
              {{ session('success') }}
            </div>
          </div>
        </div>
      @endif
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <div class="toast align-items-center text-bg-danger mb-2" role="alert" aria-live="polite"
            aria-atomic="true">
            <div class="d-flex justify-content-center">
              <div class="toast-body text-center">
                {{ $error }}
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
      // Initialize tooltips
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

      document.addEventListener('DOMContentLoaded', function() {
        // Initialize toasts
        const toasts = document.querySelectorAll('#toastsContainer .toast');
        toasts.forEach(toast => {
          const bsToast = new bootstrap.Toast(toast, {
            delay: 5000
          });
          bsToast.show();
        });

        // Handle edit button click to populate modal
        document.querySelectorAll('.edit-post-btn').forEach(button => {
          button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const postTitle = this.getAttribute('data-post-title');
            const postBody = this.getAttribute('data-post-body');

            // Populate modal fields
            document.getElementById('editPostId').value = postId;
            document.getElementById('editPostTitle').value = postTitle;
            document.getElementById('editPostContent').value = postBody;

            // Set form action dynamically
            const form = document.getElementById('editPostForm');
            form.action = `/posts/${postId}`;
          });
        });

        document.querySelectorAll('.toggle-btn').forEach(button => {
          button.addEventListener('click', function() {
            const postContainer = this.closest('.post-container');
            const postBody = postContainer.querySelector('.post-body');
            postBody.classList.toggle('expanded');
            this.textContent = postBody.classList.contains('expanded') ? 'Collapse' : 'Read more';
          });
        });
      });

      @if (isset($editPost))
        document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('editPostId').value = "{{ $editPost->PostID }}";
          document.getElementById('editPostTitle').value = "{{ e($editPost->Title) }}";
          document.getElementById('editPostContent').value = "{{ e($editPost->Body) }}";
          document.getElementById('editPostForm').action = "{{ route('posts.update', $editPost->PostID) }}";
          new bootstrap.Modal(document.getElementById('EditPostModal')).show();
        });
      @endif
    </script>
  </body>

</html>
