<?php
$system_name    = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title   = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$text_align     = $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;
$account_type   = $this->session->userdata('login_type');
?>
<!DOCTYPE html>
<?php
$CI =& get_instance();
$CI->load->database();
$text_align = $CI->db->get_where('settings', ['type' => 'text_align'])->row()->description;
?>

<html dir="<?php echo ($text_align == 'right-to-left') ? 'rtl' : 'ltr'; ?>">

    <head>

        <title><?php echo $page_title; ?> - <?php echo $system_title; ?></title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Habibi Hospital Management System" />
        <meta name="author" content="Ali Reza Habibi" />



        <?php include 'includes_top.php'; ?>

    </head>
    <body class="page-body">
        <div class="page-container <?php if ($text_align == 'right-to-left') echo 'right-sidebar'; ?>
            <?php if ($page_name == 'frontend') echo 'sidebar-collapsed';?>" >
            <?php include $account_type . '/navigation.php'; ?>
            <div class="main-content">

                <?php include 'header.php'; ?>

        

                <?php include $account_type . '/' . $page_name . '.php'; ?>

            </div>

        </div>
        <?php include 'modal.php'; ?>
        <?php include 'includes_bottom.php'; ?>

    </body>
</html>
