<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(1)); ?></li>
              <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(2)); ?></li>
            </ol>
          </nav>
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          <?= $this->session->userdata('msg'); ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
