<header>
    <nav class="navbar navbar-expand navbar-light navbar-fixed-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-lg-none d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <div class="ms-auto dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->role }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="./assets/compiled/jpg/1.jpg">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        @php
                            $fullName = Auth::user()->name;
                            $nameParts = explode(' ', $fullName);
                            $firstName = $nameParts[0];

                        @endphp
                        <li>
                            <h6 class="dropdown-header">Hello, {{ $firstName }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('account.index') }}"><i
                                    class="icon-mid bi bi-person me-2"></i> My
                                Profile</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i>
                                Logout
                            </a>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
