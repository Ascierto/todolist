<nav class="navbar navbar-expand-lg navbar-light bg-light" id="todo">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Mostra per...</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php#todo">Tutti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?done=1#todo">Da fare</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?done=2#todo">Fatti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?imp=Alta#todo">Priorità Alta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?imp=Media#todo">Priorità Media</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?imp=Bassa#todo">Priorità Bassa</a>
                </li>
            </ul>
        </div>
        <div class="d-flex me-auto">
            <a href="cancella-memo.php" class="btn btn-danger">Elimina tutto</a>
        </div>
    </div>
</nav>
