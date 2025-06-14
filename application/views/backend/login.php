<?php
    if (isset($signin_result)) {
        echo $signin_result;
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="alirezahabibi" />
    <meta name="author" content="alirezahabibi" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link name="favicon" type="image/x-icon" href="<?php echo base_url().'uploads/favicon.png' ?>" rel="shortcut icon" />
    <title></title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="<?php echo base_url();?>assets/login_page/img/bg.png"> -->

    <!-- font -->
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_page/css/plugins-css.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_page/css/typography.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_page/css/style.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login_page/css/responsive.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>

<body>

    <div class="wrapper">

        <section class="height-100vh d-flex align-items-center page-section-ptb login-page-bg">
            <div class="container">
                <div class="row no-gutters justify-content-center">
                    <div class="col-lg-4 col-md-6 login-side-img">
                        <div class="login-fancy pos-r d-flex">
                            <div class="text-center w-100 align-self-center">
                                <img src="<?php echo base_url('assets/login_page/img/bg.png');?>" height="100" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 white-bg">
                        <div class="login-fancy pb-40 clearfix" id = "login_area">
                            <h3 class="mb-30"><?php echo get_phrase('welcome-to-habibi-hospital'); ?></h3>
                            <form class="" action="<?php echo site_url('login/do_login');?>" method="post">
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name"><?php echo get_phrase('email'); ?>* </label>
                                    <input id="email" class="web form-control" type="email" placeholder="<?php echo get_phrase('email'); ?>" name="email" required>
                                </div>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password"><?php echo get_phrase('password'); ?>* </label>
                                    <input id="Password" class="Password form-control" type="password" placeholder="<?php echo get_phrase('password'); ?>" name="password" required>
                                </div>
                                <button type="submit" class="btn" style="background-color:#0f766e; color:white;"><?php echo get_phrase('login'); ?></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- jquery -->
    <script src="<?php echo base_url('assets/login_page/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php
$msg = $this->session->flashdata('message');
$err = $this->session->flashdata('error_message');

if ($msg): ?>
    <script>
        toastr.info('<?php echo addslashes($msg); ?>');
    </script>
<?php endif; ?>

<?php if ($err): ?>
    <script>
        toastr.error('<?php echo addslashes($err); ?>');
    </script>
<?php endif; ?>

<?php
// Force flashdata cleanup
$this->session->unset_userdata('__ci_vars');
?>

</body>
</html>

