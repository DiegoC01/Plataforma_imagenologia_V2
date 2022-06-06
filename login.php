<?php
header("Content-Type: text/html;charset=utf-8");
$alert ='';
session_start();
if (!empty($_SESSION['active'])) {
  header('location:index.php');
}else {

if (!empty($_POST)) {
  if (empty($_POST['usuario']) || empty($_POST['password'])) {
  $alert = "Ingrese sus datos";
  }else {
    require_once "conexion.php";
    $user = mysqli_real_escape_string($conectar,$_POST['usuario']);
    $pass = md5(mysqli_real_escape_string($conectar,$_POST['password']));
    $query_login = "SELECT * FROM vista_usuario WHERE correo=\"$user\" AND clave=\"$pass\" ";
    $ejecutar_login = mysqli_query( $conectar, $query_login ) or die (header('location:index.php'));
    $result = mysqli_num_rows($ejecutar_login);

    if ($result > 0) {
      $data = mysqli_fetch_array($ejecutar_login);
      $_SESSION['active'] = true;
      $_SESSION['rut_usuario'] = $data['rut'];
      $_SESSION['email'] = $data['correo'];
      $_SESSION['nombre_role'] = $data['nombre_role'];
      $_SESSION['nombre'] = $data['nombre'];
      $_SESSION['apellido'] = $data['apellido'];
      $_SESSION['clave'] = $data['clave'];
      $_SESSION['foto_perfil'] = $data['foto_perfil'];

      header('location: index.php');}
    else {
      $alert = "usuario o clave incorrecta";
      session_destroy();
    }
  }
}
}?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | Sistema</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="img/logo_hcvb.png" alt="" height="160" width="230" align="center">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="usuario" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="">
        <h4><?php echo isset($alert) ? $alert : ''; ?></h4>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.print.css" media="print">
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
