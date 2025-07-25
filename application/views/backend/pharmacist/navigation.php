<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo site_url('login'); ?>">
                <img src="<?php echo base_url('uploads/logo.png');?>"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    <div class="sidebar-user-info">

        <div class="sui-normal">
            <a href="#" class="user-link">
                <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="" class="img-circle" style="height:60px;">

                <span><?php echo get_phrase('welcome'); ?>,</span>
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

        <div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->				
            <a href="<?php echo site_url($account_type . '/manage_profile'); ?>">
                <i class="entypo-pencil"></i>
                <?php echo get_phrase('edit_profile'); ?>
            </a>

            <a href="<?php echo site_url($account_type . '/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <?php echo get_phrase('change_password'); ?>
            </a>

            <span class="close-sui-popup">×</span><!-- this is mandatory -->			
        </div>
    </div>

    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('pharmacist'); ?>">
                <i class="fa fa-desktop"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_medicine_category') echo 'active'; ?> ">
            <a href="<?php echo site_url('pharmacist/medicine_category'); ?>">
                <i class="fa fa-edit"></i>
                <span><?php echo get_phrase('medicine_category'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_medicine' || $page_name == 'medicine_sale' || $page_name == 'medicine_sale_add') echo 'opened active'; ?> ">
            <a href="#">
                <i class="fa fa-medkit"></i>
                <span><?php echo get_phrase('medicine'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'manage_medicine') echo 'active'; ?> ">
                    <a href="<?php echo site_url('pharmacist/medicine'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('manage_medicines'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'medicine_sale' || $page_name == 'medicine_sale_add') echo 'active'; ?> ">
                    <a href="<?php echo site_url('pharmacist/medicine_sale'); ?>">
                        <i class="entypo-dot"></i>
                        <span><?php echo get_phrase('medicine_sales'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- PAYROLL -->
        <li class="<?php if ($page_name == 'payroll_list') echo 'active'; ?> ">
            <a href="<?php echo site_url('pharmacist/payroll_list'); ?>">
                <span><i class="entypo-tag"></i> <?php echo get_phrase('payroll'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'edit_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url('pharmacist/manage_profile'); ?>">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('profile'); ?></span>
            </a>
        </li>

    </ul>

</div>