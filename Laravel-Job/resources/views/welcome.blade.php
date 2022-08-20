<!DOCTYPE html>
<html>

<head>
    <title>Laravel 9 Read Excel and Insert Data to Database.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        #file-error {
            display: block;
            color: red;
            margin-top: .5rem;
        }
    </style>

</head>

<body>

    <div class="container mt-5">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">

            <div class="card col-md-6 offset-md-3">

                <div class="card-header font-weight-bold">
                    <h4 class="float-left text-uppercase">Read Excel and Insert Data.</h4>
                </div>

                <div class="card-body text-center">

                    <form id="excel-import-form" method="POST" action="{{ url('import-excel-file') }}"
                        accept-charset="utf-8" enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <input type="file" name="file" accept=".xlsx,.xls" placeholder="Choose file">
                                </div>

                                @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#excel-import-form').validate({
                ignore: [],
                rules: {
                    file: {
                        required: true,
                        accept: 'xlsx|xls',
                        size: 52428800
                    }
                },
                messages: {
                    file: {
                        required: "Please Upload a File",
                        size: 'Please Upload File Less than 50 MB.',
                        accept: 'Please Upload Excel Sheet File'
                    },
                }
            });


            $.validator.addMethod('filesize', function(value, element, arg) {
                if (element.files[0].size <= arg) {
                    return true;
                } else {
                    return false;
                }
            });

        });
    </script>

</body>

</html>
