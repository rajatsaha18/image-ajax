<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src="{{ asset('js/jquery-3.6.4.js') }}"></script>
</head>
<body>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <h4 id="msg" class="text-center text-success">{{ Session::get('result') }}</h4>
                <div class="col-md-4 mx-auto">
                    <div class="card">
                        <div class="card-header text-center">Add Student</div>
                        <div class="card-body">
                            <form id="update_form">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" id="name" value="{{ $editStudent[0]->name }}" class="form-control" name="name"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" id="email" value="{{ $editStudent[0]->email }}" class="form-control" name="email"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" id="image" class="form-control" name="image"/>
                                    <input type="hidden" value="{{ $editStudent[0]->id }}" class="form-control" name="id"/>
                                    <img src="{{ asset('storage/') }}/{{ $editStudent[0]->image }}" alt="" height="70" width="70"/>
                                </div>
                                <div class="form-group mt-3">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-success" value="Update Student"/>
                                </div>
                            </form>
                            <span id="output"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <span id="output"></span>

    <script>
        $(document).ready(function(){
            $("#update_form").submit(function(event){
                event.preventDefault();

                var form = $("#update_form")[0];
                var data = new FormData(form);

                $.ajax({
                    type:"POST",
                    url:"{{ route('update.student') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $("#msg").text(data.result);
                        window.open("/get-students", "_self");

                    }
                    error:function(err){
                        $("#output").text(err.responseText);

                     }

                });
            });

        });
    </script>



    {{-- <script src="{{ asset('js/bootstrap.bundle.js') }}"></script> --}}

</body>
</html>
