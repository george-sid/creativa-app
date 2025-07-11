<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{route('dashboard')}}" class="brand-link">
            <span class="brand-text fw-light">Creativa</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="{{route('employee.list')}}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>{{__('Employees')}}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('company.list')}}" class="nav-link">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>{{__('Company')}}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>