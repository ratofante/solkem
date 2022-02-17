<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            @can('admin.cliente')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/clientes') }}"><i class="nav-icon icon-people"></i> {{ trans('admin.cliente.title') }}</a></li>
            @endcan
            @can('admin.orden')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/ordens') }}"><i class="nav-icon icon-organization"></i> {{ trans('admin.orden.title') }}</a></li>
            @endcan

            @can('admin.turno')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/turnos') }}"><i class="nav-icon icon-note"></i> {{ trans('admin.turno.title') }}</a></li>
            @endcan

            @can('admin.sucursal')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/sucursals') }}"><i class="nav-icon icon-globe"></i> Sucursales</a></li>
            @endcan

            {{--
            @can('admin.estado-orden')
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/estado-ordens') }}"><i class="nav-icon icon-star"></i> Estado de mis pedidos</a></li>
            @endcan--}}

           {{-- Do not delete me :) I'm used for auto-generation menu items --}}
            @can('admin.admin-user.index')
                <li class="nav-title">Usuarios</li>
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> Gestión usuarios</a></li>
                  {{--  <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>--}}
            @endcan

            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
