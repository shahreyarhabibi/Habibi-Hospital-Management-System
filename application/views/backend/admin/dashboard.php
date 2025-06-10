<div class="row">
    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/doctor'); ?>">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('appointment'); ?>"
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('appointment'); ?></div>
                <h3><?php echo get_phrase('doctor') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
    <a href="<?php echo site_url('admin/patient'); ?>" class="text-decoration-none">
        <div class="card-custom">
            <!-- Header with icon and title -->
            <div class="card-header">
                <i class="fa fa-user-circle card-icon"></i>
                <span><?php echo get_phrase('total_patients'); ?></span>
            </div>

            <!-- Main content row -->
            <div class="card-main">
                <!-- Patient count -->
                <div class="card-count">
                    <?php echo $total_patients; ?>  <!-- Use $total_patients from controller -->
                </div>

                <!-- Percentage badge -->
                <span class="card-badge">
                    <?php
                    // Display "+" if the percentage change is positive
                    $percentage_sign = ($percentage_change >= 0) ? '+' : '';
                    echo $percentage_sign . $percentage_change . '%'; // Use $percentage_change from controller
                    ?>
                </span>
            </div>

            <!-- "More than yesterday" text -->
            <div class="card-footer">
                <?php
                // Display "more" or "less" based on the patient difference
                $more_or_less = ($patient_difference >= 0) ? 'more' : 'less';
                $abs_difference = abs($patient_difference); // Get the absolute value
                echo $abs_difference . ' ' . $more_or_less . ' than yesterday'; // Use $patient_difference from controller
                ?>
            </div>
        </div>
    </a>
</div>





    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/nurse'); ?>">
            <div class="tile-stats tile-white-aqua">
                <div class="icon"><i class="fa fa-plus-square"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('nurse'); ?>" 
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('nurse'); ?></div>
                <h3><?php echo get_phrase('nurse') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/pharmacist'); ?>">
            <div class="tile-stats tile-white-blue">
                <div class="icon"><i class="fa fa-medkit"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('pharmacist'); ?>" 
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('pharmacist'); ?></div>
                <h3><?php echo get_phrase('pharmacist') ?></h3>
            </div>
        </a>
    </div>
</div>

<br />

<div class="row">
    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/laboratorist'); ?>">
            <div class="tile-stats tile-white-cyan">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('laboratorist'); ?>" 
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('laboratorist'); ?></div>
                <h3><?php echo get_phrase('laboratorist') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/accountant'); ?>">
            <div class="tile-stats tile-white-purple">
                <div class="icon"><i class="fa fa-money"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('accountant'); ?>" 
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('accountant'); ?></div>
                <h3><?php echo get_phrase('accountant') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/payment_history'); ?>">
            <div class="tile-stats tile-white-pink">
                <div class="icon"><i class="fa fa-list-alt"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('invoice'); ?>" 
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('invoice'); ?></div>
                <h3><?php echo get_phrase('payment') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/medicine'); ?>">
            <div class="tile-stats tile-white-orange">
                <div class="icon"><i class="fa fa-medkit"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('medicine'); ?>" 
                     data-duration="1500" data-delay="0"><?php echo $this->db->count_all('medicine'); ?></div>
                <h3><?php echo get_phrase('medicine') ?></h3>
            </div>
        </a>
    </div>
</div>

<br />

<div class="row">
    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/operation_report'); ?>">
            <div class="tile-stats tile-white-green">
                <div class="icon"><i class="fa fa-wheelchair"></i></div>
                <div class="num" data-start="0" data-end="<?php echo count($this->db->get_where('report', array('type' => 'operation'))->result_array());?>" 
                     data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('operation_report') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/birth_report'); ?>">
            <div class="tile-stats tile-white-brown">
                <div class="icon"><i class="fa fa-github-alt"></i></div>
                <div class="num" data-start="0" data-end="<?php echo count($this->db->get_where('report', array('type' => 'birth'))->result_array());?>" 
                     data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('birth_report') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/death_report'); ?>">
            <div class="tile-stats tile-white-plum">
                <div class="icon"><i class="fa fa-ban"></i></div>
                <div class="num" data-start="0" data-end="<?php echo count($this->db->get_where('report', array('type' => 'death'))->result_array());?>" 
                     data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('death_report') ?></h3>
            </div>
        </a>
    </div>

</div>