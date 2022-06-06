<?php if (empty($_SESSION['active'])) {
  header('location:login.php');
} ?>
<aside class="main-sidebar" >
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- <li class="header logo-lg"><h4>MENUS</h4></li> -->





      <li class="treeview-menu">PERFIL</li>
      <li>
        <a href="perfil.php">
          <i class="fa fa-user-circle-o"></i>
          <span>Mi Perfil</span>
        </a>
      </li>

      <li class="treeview-menu">Salir del sistema</li>
      <li>
        <a href="salir.php" >
          <i class="fa fa-sign-out"></i>
          <span>Cerrar Sesión</span>
        </a>
      </li>
    </ul>    <!-- /.sidebar -->
  </section>
</aside>
