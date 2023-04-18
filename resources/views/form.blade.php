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
                <h4 class="text-center text-success">{{ Session::get('res') }}</h4>
                <div class="col-md-4 mx-auto">
                    <div class="card">
                        <div class="card-header text-center">Add Student</div>
                        <div class="card-body">
                            <form action="" method="post" id="my_form">
                                @csrf

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" id="name" class="form-control" name="name"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" id="email" class="form-control" name="email"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" id="image" class="form-control" name="image"/>
                                </div>
                                <div class="form-group mt-3">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-success" value="Add Student"/>
                                </div>
                            </form>
                            <span id="output"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered" id="table_students">
                        <thead>
                            <tr>
                                <th>Sl no.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- <tr>
                                <td>1</td>
                                <td>Rakesh</td>
                                <td>rakesh@gmail.com</td>
                                <td>image101</td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $("#my_form").submit(function(event){
                event.preventDefault();

                var form = $("#my_form")[0];
                var data = new FormData(form);

                $.ajax({
                    type:"POST",
                    url: "{{ route('add.student') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $("h4").text(data.res);
                        $("#name").val('');
                        $("#email").val('');
                        $("#image").val('');
                    },
                    error: function(e){
                        $("#output").text(e.responseText);

                    }
                });

            });

            $.ajax({
                type:"GET",
                url: "{{ route('get.student') }}",
                success: function(data){
                    console.log(data);
                    if(data.students.length > 0){

                        for(let i = 0; i < data.students.length; i++){
                            let img = data.students[i]['image'];
                            $("#table_students").append(`<tr>
                                <td>`+(i+1)+`</td>
                                <td>`+(data.students[i]['name'])+`</td>
                                <td>`+(data.students[i]['email'])+`</td>
                                <td><img src="{{ asset('storage/`+img+`') }}" alt="`+img+`" height="70" width="70"/></td>
                                <td>
                                    <a href="ediUser/`+(data.students[i]['id'])+`" class="btn btn-success btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                                </tr>`);
                        }

                    }
                    else{
                        $("#table_students").append("<tr><td>Data Not Found</td></tr>")
                    }
                },
                error: function(err){
                    console.log(err.responseText);
                }
            });
        });
    </script>

    {{-- <script src="{{ asset('js/bootstrap.bundle.js') }}"></script> --}}

</body>
</html>
