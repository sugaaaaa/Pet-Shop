<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card mt-5" onclick="history.back()" style="cursor: pointer;">
            <div class="card-header">
                Back
            </div>
        </div>

        <div class="card mb-4 mt-5">
            <div class="card-header">
                <h2>Please update the Pets information</h2>
            </div>

            <div class="card-body mt-2">
                <div class="row">
                    <div class="col">
                        <form class="form-group mt-" method="post"
                            action="{{ url('/dashboard/category/update/' . $category->id) }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Name*</label>
                                <input class="form-control mt-2" value="{{ $category->name }}" type="text" name="name" id="name" required placeholder="Name">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mt-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


