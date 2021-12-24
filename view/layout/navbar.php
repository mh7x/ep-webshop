<?php
$slug = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link <?php echo ($slug == "") ? "active" : ""; ?>" aria-current="page" href="<?= BASE_URL . "" ?>">Domov</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($slug == "signin") ? "active" : ""; ?>" href="<?= BASE_URL . "signin" ?>">Prijava</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo ($slug == "control-panel" || $slug == "product/add" || $slug == "product/edit") ? "active" : ""; ?>" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nadzorna plošča</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item <?php echo ($slug == "control-panel") ? "active" : ""; ?>" href="<?= BASE_URL . "control-panel" ?>">Informacije</a></li>
                    <li><a class="dropdown-item <?php echo ($slug == "product/add") ? "active" : ""; ?>" href="<?= BASE_URL . "product/add" ?>">Dodaj artikel</a></li>
                </ul>
            </li>
        </ul>
        <form class="d-flex">
            <a class="btn btn-outline-dark" href="<?= BASE_URL . "cart" ?>" data-toggle="modal" data-target="#exampleModal">
                <span class="bi-cart-fill"></span>
                Košarica
                <span class="badge">0</span>
            </a>
        </form>
    </div>
</nav>