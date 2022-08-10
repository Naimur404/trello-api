<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <body>
    @include('nav')

      <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6 mt-4">
         @yield('content')
    </div>
    <div class="col-md-3">

    </div>
    </div>
    <footer class="bg-light text-center text-lg-start mt-5">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2022 Copyright

        </div>
        <!-- Copyright -->
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="{{asset('js/notify.min.js')  }}" crossorigin="anonymous"></script>
  </body>

  <script>
$('#key').submit(function (e) {

    e.preventDefault();


    $.ajax({
        type: "get",
        url: "/auth",
        data: $('#key').serialize(),

        success: function (result) {
            // if (result.status == "error") {
            //     $('#login_msg').html(result.msg);
            // }
            if (result.status == "sucess") {
                $.notify(result.msg, "success");
                window.open(result.url, '_blank');

                setInterval(function(){
            window.location.href='/tokenview';
        },3000);



            }else{
                $.notify(result.msg, "error");

            }


        }
    });

});

</script>

<script>
    $('#token').submit(function (e) {

e.preventDefault();


$.ajax({
    type: "get",
    url: "/token",
    data: $('#token').serialize(),

    success: function (result) {
        if (result.status == "error") {
            $.notify(result.msg, "error");
        }
        if (result.status == "sucess") {
            $.notify(result.msg, "success");

            window.location.href='/board'



        }


    }
});

});
</script>



</html>
