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

            <!-- Form Login -->
            <form method="post" action="<?php echo base_url(); ?>auth/forgotPassword">
                <span class="login-form-title pb-5">
                    <!-- Title From -->
                    Lupa Password
                </span>
                <!-- show msg if usn / pass not found / wrong  -->
                <span class="text-danger"> <?php echo $this->session->flashdata('msg'); ?> </span>
                <!-- Field Input Email -->
                <div class="wrap-input   mb-3">
                    <span class="label-input">Email</span>
                    <input class="input" type="email" id="email" name="email" placeholder="Masukkan Email" autocomplete="off" required>
                    <span class="focus-input">

                    </span>
                </div>
                <div>
                    <div class="wrap-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button class="login-form-btn">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>