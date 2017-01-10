<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('admin/home*') ? 'active' : '' }}"><a href="{{ url('admin/home') }}"><i class='fa fa-home'></i> <span>Inicio</span></a></li>

            <li class="{{ Request::is('admin/atributo*') ? 'active' : '' }}"><a href="{{ url('admin/atributo') }}"><i class='fa fa-ticket'></i> <span>Atributos Globales</span></a></li>

            <!--<li class="treeview {{ Request::is('admin/atributo*') ? 'active' : '' }}">
                <a href="#"><i class='fa fa-link'></i> <span>Atributos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/atributo*') ? 'active' : '' }}"><a href="{{ url('admin/atributo') }}"><i class="fa fa-circle-o"></i>Goblales</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Valores</a></li>
                </ul>
            </li>-->
            <li class="{{ Request::is('admin/categoria*') ? 'active' : '' }}"><a href="{{ url('admin/categoria') }}"><i class='fa fa-folder-open'></i> <span>Categorias</span></a></li>
            <li class="{{ Request::is('admin/publicacion*') ? 'active' : '' }}"><a href="{{ url('admin/publicaciones') }}"><i class='fa fa-cubes'></i> <span>Publicaciones</span></a></li>
            <li class="{{ Request::is('admin/mensajes*') ? 'active' : '' }}"><a href="{{ url('admin/mensajes') }}"><i class='fa fa-envelope'></i> <span>Mensajes</span></a></li>
            <li class="{{ Request::is('admin/usuarios*') ? 'active' : '' }}"><a href="{{ url('admin/usuarios') }}"><i class='fa fa-users'></i> <span>Usuarios</span></a></li>
            <!--<li class="treeview">
                <a href="{{ url('publicacion') }}"><i class='fa fa-link'></i> <span>Publicaciones</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li>-->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
