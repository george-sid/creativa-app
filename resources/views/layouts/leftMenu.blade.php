<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{route('dashboard')}}" class="brand-link">
            <img src="/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Creativa</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>{{__('Employees')}}</p>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>{{__('Company')}}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>