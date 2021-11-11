<!doctype html>
<html lang="en">
  <head>
    <base href="<?php echo base_url(); ?>"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <title>BUKU</title>
  </head>
  <body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href=""><?php echo $head['judul']; ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="">Beranda <span class="sr-only">(current)</span></a>
              </li>
              <?php if($this->session->userdata('id')) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?php echo $this->session->userdata('nama'); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="login/logout">Logout</a>
                </div>
              </li>
              <?php }else { ?>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  Akun
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="login">Login</a>
                </div>
              </li>
              <?php } ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="welcome/cari_buku">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input class="form-control mr-sm-2" type="search" name="cari" placeholder="Search" aria-label="Search" required="">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>

        <div class="card mt-5">
          <div class="card-header text-center">
            Input Data Buku
          </div>
          <div class="card-body">
            <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?php echo set_value('judul'); ?>" autofocus>
                            <small class="text-danger"><?php echo form_error('judul'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" value="<?php echo set_value('pengarang'); ?>">
                            <small class="text-danger"><?php echo form_error('pengarang'); ?></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="<?php echo set_value('penerbit'); ?>">
                            <small class="text-danger"><?php echo form_error('penerbit'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

          </div>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>