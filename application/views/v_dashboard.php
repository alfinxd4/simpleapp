<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> JWP CORALIS</title>
  <!-- Custom styles for this page CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      color: #1a202c;
      text-align: left;
      background-image: linear-gradient(135deg, #6b73ff 10%, #000dff 100%);
    }
  </style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo base_url() ?>dashboard">Home</a>
          </li>

        </ul>

        <span class=" navbar-text">
          <img src="<?php echo base_url('upload/' . $this->session->userdata('foto')) ?>" class="rounded-circle" width="50" height="  50">
          <a href="<?php echo base_url() ?>auth/logout">Logout</a>
        </span>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div>
      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <!-- get data foto from session -->
                <img src="<?php echo base_url('upload/' . $this->session->userdata('foto')) ?>" class="rounded-circle" width="150" height="150">
                <div class="mt-3">
                  <!-- get data nama from session -->
                  <h4><?php echo $this->session->userdata('nama'); ?></h4>
                  <h6><?php echo $this->session->userdata('jenis_kelamin'); ?></h4>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Nama Lengkap </h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <!-- get data nama from session -->
                  <?php echo $this->session->userdata('nama'); ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <!-- get data email from session -->
                  <?php echo $this->session->userdata('email'); ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">No.Telepon</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $this->session->userdata('no_tlp'); ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Alamat</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $this->session->userdata('alamat'); ?>
                </div>
              </div>
              <hr>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>