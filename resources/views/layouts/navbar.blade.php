<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <form method="POST" action="{{ route('language') }}">
            @csrf
            <select name="locale" onchange="this.form.submit()">
                @foreach(config('creativa.supported') as $key => $label)
                    <option value="{{ $key }}" {{ session('locale') == $key ? 'selected' : '' }}>
                        {{ __($label) }}
                    </option>
                @endforeach
            </select>
        </form>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <p> {{ Auth::user()->name }}</p>
                    </li>
                    <li class="user-footer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat float-end">
                                {{ __('Sign out') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>