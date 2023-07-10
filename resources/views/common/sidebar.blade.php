<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-cubes"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Geolapp</div>
    </a>
    <!-- Nav Item - Pages Collapse Menu -->


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDownMuestras"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-building"></i>
            <span>Sondeos</span>
        </a>
        <div id="taTpDropDownMuestras" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sondeos</h6>
                <a class="collapse-item" href="{{ route('sondeo.index') }}">Sondeos</a>
                <a class="collapse-item" href="{{ route('sondeo.create') }}">Agregar Sondeo</a>
                <a class="collapse-item" href="{{ route('albumfotografico') }}">Imagenes de campo</a>
            </div>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Muestras</h6>
                <a class="collapse-item" href="{{ route('muestras') }}">Muestras</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDownLaboratorio"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-industry"></i>
            <span>Ensayes de Laboratorio</span>
        </a>
        <div id="taTpDropDownLaboratorio" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Muestras</h6>
                <a class="collapse-item" href="{{ route('test_Humedades') }}">Humedades</a>
                <a class="collapse-item" href="{{ route('test_Granulometrico') }}">Granulometria</a>
                <a class="collapse-item" href="{{ route('test_tamizado') }}">Tamizado Malla 40</a>
            </div>
        </div>
    </li>
    <!-- Divider -->


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDownProyectos"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-briefcase"></i>
            <span>Proyectos</span>
        </a>
        <div id="taTpDropDownProyectos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administracion</h6>
                <a class="collapse-item" href="{{ route('proyectos') }}">Proyectos</a>
                <a class="collapse-item" href="{{ route('clientes') }}">Clientes</a>

            </div>
        </div>
    </li>

    <!-- Divider -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Sistema
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDown"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-user-alt"></i>
            <span>Administracion de Usuario</span>
        </a>
        <div id="taTpDropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administracion de Usuarios:</h6>
                <a class="collapse-item" href="{{ route('users.index') }}">Lista</a>
                <a class="collapse-item" href="{{ route('users.create') }}">Agregar nuevo</a>
                <a class="collapse-item" href="{{ route('users.import') }}">Importar</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @hasrole('Admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Section
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Masters</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Roles & Permisos</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Permisos</a>
                </div>
            </div>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Opciones de sistema</h6>
                    <a class="collapse-item" href="{{ route('catalogos.index') }}">Catalogo</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endhasrole
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#aboutModal">
            <i class="fas fa-info"></i>
            <span>Acerca de</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#helpModal">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            <span>Ayuda</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Salir</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
