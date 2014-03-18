<html lang="en">
  <head>
      <meta http-equiv="Content-Type" content="text/html charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width">

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Administrador</title>

      <!-- Bootstrap core CSS -->
      <link href="{{asset('css/admin/bootstrap.css')}}"    rel="stylesheet" type="text/css">
      <link href="{{asset('css/admin/login.css')}}"    rel="stylesheet" type="text/css">

      <!-- Page Specific CSS -->
      <script type="text/javascript" src="{{asset('js/admin/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/admin/jquery-ui.js')}}"></script>

      <noscript>
          <h2>se requiere JavaScript.<br>¡Se aborto!.</h2>
      </noscript>
  </head>

  <body>
    <div class="container">
      @if(Session::has('message'))
          <p class="alert">{{ Session::get('message') }}</p>
      @endif

      {{ Form::open(array('url'=>'login', 'class'=>'form-signin')) }}
          <h2 class="form-signin-heading">Please Login</h2>
          </br>
          <p>
          {{ Form::text('email', null, array('class'=>'form-control input-block-level', 'placeholder'=>'Correo electronico', 'required'=>'', 'autofocus'=>'')) }}
          </p>
          <p>
            {{ Form::password('password', array('class'=>'form-control input-block-level', 'placeholder'=>'Contraseña', 'required'=>'')) }}
            <strong>Oops - <a href="">Olvidé mi contraseña</a></strong>
          </p>
          <label class="checkbox">
            <input type="checkbox" value="remember-me"> Recordarme por 30 días
          </label> 
          {{ Form::submit('Entrar', array('class'=>'btn btn-lg btn-primary btn-block'))}}
      {{ Form::close() }}

    </div>
  </body>
</html>