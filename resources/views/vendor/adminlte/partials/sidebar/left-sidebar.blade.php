<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if (config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                <li class="nav-header ">
                    MENÚ PRINCIPAL
                </li>

                {{-- @if ($userAuth->hasAllDirectPermissions(['all'])) --}}
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-user-lock "></i>
                        <p>Administrador<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listUsers') }}">
                                <i class="fas fa-user-friends "></i>
                                <p>Usuarios</p>
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listPermissions') }}">
                                <i class="fas fa-user-check "></i>
                                <p>
                                    Permisos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listRoles') }}">
                                <i class="fas fa-user-tag "></i>
                                <p>
                                    Roles
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-tag"></i>
                        <p>Entidades principales<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listEmpl') }}">
                                <!--p>|----</p-->
                                <i class="fas fa-user-tag"></i>
                                <p>Empleados</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPosition') }}">
                                <!--p>|----</p-->
                                <i class="fas fa-user-tie"></i>
                                <p>Cargos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listClients') }}">
                                <!--p>|----</p-->
                                <i class="fas fa-user-tag"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listSuppliers') }}">
                                <i class="fas fa-user-cog"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listVehicles') }}">
                                <i class="fas fa-car"></i>
                                <p>Vehículos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listVehicleTypes') }}">
                                <i class="fas fa-car-crash"></i>
                                <p>Tipo de Vehículos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listServiceTypes') }}">
                                <i class="fab fa-whmcs"></i>
                                <p>Tipo de Servicios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listSuppliers') }}">
                                <i class="fas fa-dolly"></i>
                                <p>Gestión de Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listSuppliers') }}">
                                <i class="fas fa-boxes"></i>
                                <p>Gestión de Combos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listSuppliers') }}">
                                <i class="fas fa-search-dollar"></i>
                                <p>Caja</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-cash-register"></i>
                        <p>Ventas<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPriceList') }}">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <p>Servicios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPriceList') }}">
                                <i class="fas fa-store"></i>
                                <p>Tienda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPriceList') }}">
                                <i class="far fa-file-alt"></i>
                                <p>Cierre de Caja</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="fas fa-shapes"></i>
                        <p>Compras<i class="fas fa-angle-left right"></i></p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-chart-bar"></i>
                        <p>Informes<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPriceList') }}">
                                <i class="fas fa-pallet"></i>
                                <p>Vehículos en Proceso</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPriceList') }}">
                                <i class="fas fa-car-side"></i>
                                <p>Vehículos para Entrega</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPriceList') }}">
                                <i class="fas fa-dollar-sign"></i>
                                <p>Ventas por Periodo</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="fas fa-boxes "></i>
                        <p>Inventario<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inventory') }}">
                                <i class="fab fa-buffer"></i>
                                <p>Inventario de Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fas fa-luggage-cart"></i>
                                <p>Salidas de Productos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}
            </ul>
        </nav>
    </div>


</aside>
