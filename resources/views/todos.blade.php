<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recaptcha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {!! htmlScriptTagJsApi() !!}
</head>


<body>



    <div class="container mt-4">

        {{-- Success alert --}}
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
               @if (session()->has('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
               @endif
            </div>
        </div>


        {{-- form-card --}}
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Add todo</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('save.todo') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="todo" class="form-label">Todo Name</label>
                                <input type="text" class="form-control" id="todo" name="name"
                                    placeholder="enter todo name">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description </label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                {!! htmlFormSnippet() !!}
                                @error('g-recaptcha-response')
                                <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn fs-6 btn-primary px-3 py-2">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        {{-- List of all todos --}}

        <div class="row d-flex mt-3 justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Todo List</h4>
                    </div>

                    <div class="card-body">
                        <ol class="list-group list-group-numbered">
                            @forelse ($todos as $todo)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $todo->name }}</div>
                                        <div>{{ $todo->description }}</div>
                                    </div>
                                    <span>
                                        <form action="{{ route('delete.todo', $todo->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-light">Delete</button>
                                        </form>
                                    </span>
                                </li>
                            @empty
                                <span class="d-flex justify-content-center my-2">No todos...</span>
                            @endforelse

                        </ol>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
