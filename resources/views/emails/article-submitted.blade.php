
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=, initial-scale=1.0" />
    <title>IIARPUB</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  </head>
  <body>
    <!-- logo start -->

    <!-- logo end -->
    <p class="user-name">Hello {{ $user }},</p>
    <!-- user invitation wrap start -->

    <!-- user invitation wrap end -->
    <p>
      {{ $msg }}
    </p>

    <div class="footer-text">
        <p>
            <span>Thanks,</span>
            <span>IIARPUB</span>
        </p>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
<!--  -->
