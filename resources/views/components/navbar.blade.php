<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="/">Web Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/device/in">Perangkat Lama</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Perangkat on Stock
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/device/on-hand-good">Good</a></li>
                        <li><a class="dropdown-item" href="/device/on-hand-bad">Bad</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/device/out">Perangkat Baru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">User</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
