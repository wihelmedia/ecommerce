
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          RadjaNasiGoreng
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">All Menu</a>
            <a class="nav-item nav-link" href="#">Pizza</a>
            <a class="nav-item nav-link" href="#">Pasta</a>
            <a class="nav-item nav-link" href="#">Nasi</a>
            <a class="nav-item nav-link" href="#">Minuman</a>
          </div>
          <!-- Topbar Search -->
          <form class="form-inline mx-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          </form>

          <form class="form-inline">
            <a class="btn btn-sm btn-outline-light mr-2" href="<?= base_url('auth'); ?>">Sign In</a>
            <a class="btn btn-sm btn-light" href="<?= base_url('auth/registration'); ?>">Sign Up</a>
          </form>
        </div>

      </div>
    </nav>
