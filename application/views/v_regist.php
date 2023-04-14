<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> JWP CORALIS</title>
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- link fontawesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--Iconscout CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Custom styles for this page CSS -->
    <link href="<?php echo base_url(); ?>./assets/css/register.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <div class="wrap-login ps-5 pe-5 pt-5 pb-5">

            <!-- Form Register -->
            <?php echo form_open_multipart('auth/registration') ?>
            <span class="login-form-title pb-5">
                <!-- Title From -->
                Register Account
            </span>
            <span class="text-danger"> <?php echo $this->session->flashdata(''); ?></span>
            <!-- Field Input Nama -->
            <div class="wrap-input   mb-3">
                <span class="label-input">Nama Lengkap</span>
                <input class="input" type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= set_value('nama'); ?>" required>
                <span class="focus-input">

                </span>
            </div>
            <!-- Option Jenis Kelamin -->
            <div class="wrap-input mb-3">
                <span class="label-input">Jenis Kelamin</span>
                <select class="input mt-3" name="jenis_kelamin" id="jenis_kelamin" value="<?= set_value('jenis_kelamin'); ?>" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                <span class="focus-input">

                </span>
            </div>
            <!-- Field Input No.Telepon -->
            <div class="wrap-input mb-3">
                <span class="label-input">No. Telepon <?php echo form_error('no_tlp', '<small class="text-danger pl-3 ps-5">', '</small>'); ?></span>
                <input class="input" type="number" id="no_tlp" name="no_tlp" placeholder="Masukkan No. Telepon" autocomplete="off" value="<?= set_value('no_tlp'); ?>" required>
                <span class="focus-input">

                </span>
            </div>
            <!-- Field Input Email -->
            <div class="wrap-input   mb-3">
                <span class="label-input">Email <?php echo form_error('email', '<small class="text-danger pl-3 ps-5">', '</small>'); ?></span>
                <input class="input" type="email" id="email" name="email" placeholder="Masukkan Email" autocomplete="off" value="<?= set_value('email'); ?>" required>
            </div>

            <!-- Field Input Alamat Rumah -->
            <div class="wrap-input   mb-3">
                <span class="label-input">Alamat Rumah</span>
                <input class="input" type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat Rumah" autocomplete="off" value="<?= set_value('alamat'); ?>" required>
                <span class="focus-input">

                </span>
            </div>
            <!-- Field Input Foto Profil -->
            <div class="wrap-input   mb-3">
                <span class="label-input">Foto Profil</span>
                <input class="input mt-3" type="file" id="foto" name="foto" required>
                <span class="focus-input">

                </span>
            </div>
            <!-- Field Input Password -->
            <div class="wrap-input   mb-3">
                <span class="label-input">Password</span> <i class="uil uil-eye-slash showHidePw"></i>
                <input class="input" type="password" id="password" name="password" placeholder="Masukkan Password" autocomplete="off" minlength="8" value="<?= set_value('password'); ?>" required>
                <span class="focus-input">

                </span>

            </div>
            <div class="">
                <div class="wrap-form-btn">
                    <div class="login-form-bgbtn"></div>
                    <button class="login-form-btn">
                        Register
                    </button>
                </div>
            </div>
            <div class=" text-center pt-4">
                <span class="txt1 p-b-17">
                    Sudah punya akun? <a href="<?php echo base_url(); ?>auth">Login</a>
                </span>
            </div>
            </form>
        </div>
    </div>
</body>

</html>