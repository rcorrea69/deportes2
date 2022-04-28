  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="http://www.derecho.uba.ar/extension/deportes.php" target="_blank">Dir. de Deportes Facultad de Derecho</a>
    <button class="navbar-toggler navbar-toggler-right " type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <br>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Socios">
          <a class="nav-link" href="panel_socios.php">
            <i class="fa fa-fw  fa-users"></i>
            <span class="nav-link-text">Socios</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="pagos.php">
            <i class="fa fa-usd" aria-hidden="true"></i>
            <span class="nav-link-text">Registrar Pagos</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="reimprimir_op.php">
            <i class="fa fa-print" aria-hidden="true"></i>
            <span class="nav-link-text">Reimprimir OP</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw  fa-gears"></i>
            <span class="nav-link-text">Tablas</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="actividades.php">Actividades</a>
            </li>
            <li>
              <a href="codigos.php">Códigos de Cobranzas</a>
            </li>
            <li>
              <a href="socio_categoria.php">Socio Categorías</a>
            </li>
            <li>
              <a href="socio_condicion.php">Socio Condición</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="usuarios.php">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="nav-link-text">Usuarios</span>
          </a>
        </li>

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
             <i class="text-white"> Usuario :<?php echo " " .$_SESSION ['nombre']; ?></i>   
            <i class="fa fa-fw fa-sign-out"></i>Cerrar Sesión</a>
        </li>
      </ul>

    </div>
  </nav>