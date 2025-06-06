<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$this->e($title)?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    </head>
    <body>
    <header style="z-index: 100;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark-grey">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="/venturepilot/assets/logo.png" alt="Logo" style="width: 80px; height: 80px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->url('home') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->url('explore') ?>">Explore</a>
                        </li>
                        <!-- Only show create link if user is signed in -->
                        <?php if(isset($_SESSION['username'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $this->url('create') ?>">Create</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->url('mytrips') ?>">My Trips</a>
                        </li>
                    </ul>

                    <!-- Search Form -->
                    <form class="form-inline my-2 my-lg-0 d-flex">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    
                    <!-- Login/Logout feature -->
                    <?php if(isset($_SESSION['username'])): ?>
                    <div class="navbar-text">
                        Welcome, <?= $_SESSION['username'] ?>
                        <a class="btn btn-outline-light mx-2" href="/venturepilot/logout">Logout</a>
                    </div>
                    <?php else: ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-outline-light mx-2" href="<?= $this->url('login') ?>">Login</a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <?= $this->section('content') ?>
    </main>

    <footer class="mt-auto bg-charcoal" style="z-index: 100;">
        <div class="container">
            <p class="text-center text-white">Copyright Notice ©2024</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>

<style>
.bg-dark-grey {
    background-color: #222;
}
.bg-charcoal {
    background-color: #181818;
}
.text-white {
    color: #fff;
}

html, body {
    height: 100%;
    background-color: #0c0c0c;
    color: white;
}
body {
    display: flex;
    flex-direction: column;
}
main {
    flex: 1;
}
footer {
    padding: 10px;
}

.container {
    padding-right: 0;
    padding-left: 0;
}

/* Custom scrollbar styles */
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    background-color: #222;
}

::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 6px;
    border: 3px solid #222;
}
</style>
