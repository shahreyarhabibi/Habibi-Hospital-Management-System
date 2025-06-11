<?php
// Debugging: Check the total income value
echo "<script>console.log('Total Income: " . $total_income . "');</script>";
?>


<div class="row" id ="res-dash">
<div class="col-sm-3">
        <div class="card-custom">
            <!-- Header with icon and title -->
            <div class="card-header">
                <i class="fa fa-user-circle card-icon"></i>
                <span><?php echo get_phrase('total_patients'); ?></span>
            </div>

            <!-- Main content row -->
            <div class="card-main" style="display: flex; align-items: center; gap: 6px;">
                <!-- Patient count -->
                <div class="card-count">
                    <?php echo $total_patients; ?>  <!-- Use $total_patients from controller -->
                </div>

                <!-- Percentage badge with up/down small chart icon -->
                <span class="card-badge" style="display: flex; align-items: center; gap: 4px;">
                    <?php
                    // Display "+" if the percentage change is positive
                    $percentage_sign = ($percentage_change >= 0) ? '+' : '';
                    echo $percentage_sign . $percentage_change . '%'; // Use $percentage_change from controller
                    ?>
                    <?php if ($percentage_change > 0): ?>
                        <!-- Up arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" 
                             xmlns="http://www.w3.org/2000/svg" aria-label="Increasing trend">
                            <path d="M4 12L12 4L20 12" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 20V4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php elseif ($percentage_change < 0): ?>
                        <!-- Down arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" 
                             xmlns="http://www.w3.org/2000/svg" aria-label="Decreasing trend">
                            <path d="M20 12L12 20L4 12" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 4V20" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php else: ?>
                        <!-- Neutral horizontal line icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" 
                             xmlns="http://www.w3.org/2000/svg" aria-label="No change">
                            <path d="M4 12H20" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php endif; ?>
                </span>
            </div>

            <!-- "More than yesterday" text -->
            <div class="card-footer">
                <?php
                // Display "more" or "less" based on the patient difference, localized
                $more_or_less = ($patient_difference >= 0) ? get_phrase('more') : get_phrase('less');
                $abs_difference = abs($patient_difference); // Get the absolute value
                echo $abs_difference . ' ' . $more_or_less . ' ' . get_phrase('than_yesterday'); // Use $patient_difference from controller
                ?>
            </div>
        </div>
</div>

<div class="col-sm-3">
        <div class="card-custom">
            <!-- Header with icon and title -->
            <div class="card-header">
                <i class="fa fa-calendar card-icon"></i>
                <span><?php echo get_phrase('total_appointments'); ?></span>
            </div>

            <!-- Main content row -->
            <div class="card-main" style="display: flex; align-items: center; gap: 6px;">
                <!-- Appointment count -->
                <div class="card-count">
                    <?php echo $total_appointments; ?>  <!-- Use $total_appointments from controller -->
                </div>

                <!-- Percentage badge with up/down small chart icon -->
                <span class="card-badge" style="display: flex; align-items: center; gap: 4px;">
                    <?php
                    // Display "+" if the percentage change is positive
                    $appointment_percentage_change = ($previous_day_appointments > 0)
                        ? round((($current_day_appointments - $previous_day_appointments) / $previous_day_appointments) * 100, 1)
                        : ($current_day_appointments > 0 ? 100 : 0);
                    $percentage_sign = ($appointment_percentage_change >= 0) ? '+' : '';
                    echo $percentage_sign . $appointment_percentage_change . '%'; // Use $appointment_percentage_change from controller
                    ?>
                    <?php if ($appointment_percentage_change > 0): ?>
                        <!-- Up arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="Increasing trend">
                            <path d="M4 12L12 4L20 12" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 20V4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php elseif ($appointment_percentage_change < 0): ?>
                        <!-- Down arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="Decreasing trend">
                            <path d="M20 12L12 20L4 12" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 4V20" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php else: ?>
                        <!-- Neutral horizontal line icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="No change">
                            <path d="M4 12H20" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php endif; ?>
                </span>
            </div>

            <!-- "More than yesterday" text -->
            <div class="card-footer">
                <?php
                // Display "more" or "less" based on the appointment difference, localized
                $more_or_less = ($appointment_difference >= 0) ? get_phrase('more') : get_phrase('less');
                $abs_difference = abs($appointment_difference); // Get the absolute value
                echo $abs_difference . ' ' . $more_or_less . ' ' . get_phrase('than_yesterday'); // Use $appointment_difference from controller
                ?>
            </div>
        </div>
</div>


<div class="col-sm-3">
        <div class="card-custom">
            <!-- Header with icon and title -->
            <div class="card-header">
                <i class="fa  fa-file-text-o card-icon"></i>
                <span><?php echo get_phrase('total_invoices'); ?></span>
            </div>

            <!-- Main content row -->
            <div class="card-main" style="display: flex; align-items: center; gap: 6px;">
                <!-- Invoice count -->
                <div class="card-count">
                    <?php echo $total_invoices; ?>  <!-- Use $total_invoices from controller -->
                </div>

                <!-- Percentage badge with up/down small chart icon -->
                <span class="card-badge" style="display: flex; align-items: center; gap: 4px;">
                    <?php
                    // Display "+" if the percentage change is positive
                    $invoice_percentage_change = ($previous_day_invoices > 0)
                        ? round((($current_day_invoices - $previous_day_invoices) / $previous_day_invoices) * 100, 1)
                        : ($current_day_invoices > 0 ? 100 : 0);
                    $percentage_sign = ($invoice_percentage_change >= 0) ? '+' : '';
                    echo $percentage_sign . $invoice_percentage_change . '%'; // Use $invoice_percentage_change from controller
                    ?>
                    <?php if ($invoice_percentage_change > 0): ?>
                        <!-- Up arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="Increasing trend">
                            <path d="M4 12L12 4L20 12" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 20V4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php elseif ($invoice_percentage_change < 0): ?>
                        <!-- Down arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="Decreasing trend">
                            <path d="M20 12L12 20L4 12" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 4V20" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php else: ?>
                        <!-- Neutral horizontal line icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="No change">
                            <path d="M4 12H20" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php endif; ?>
                </span>
            </div>

            <!-- "More than yesterday" text -->
            <div class="card-footer">
                <?php
                // Display "more" or "less" based on the invoice difference, localized
                $more_or_less = ($invoice_difference >= 0) ? get_phrase('more') : get_phrase('less');
                $abs_difference = abs($invoice_difference); // Get the absolute value
                echo $abs_difference . ' ' . $more_or_less . ' ' . get_phrase('than_yesterday'); // Use $invoice_difference from controller
                ?>
            </div>
        </div>
</div>

<div class="col-sm-3">
        <div class="card-custom">
            <!-- Header with icon and title -->
            <div class="card-header">
                <i class="fa  fa-flask card-icon"></i>
                <span><?php echo get_phrase('total_tests'); ?></span>
            </div>

            <!-- Main content row -->
            <div class="card-main" style="display: flex; align-items: center; gap: 6px;">
                <!-- Invoice count -->
                <div class="card-count">
                    <?php echo $total_tests; ?>  <!-- Use $total_invoices from controller -->
                </div>

                <!-- Percentage badge with up/down small chart icon -->
                <span class="card-badge" style="display: flex; align-items: center; gap: 4px;">
                    <?php
                    // Display "+" if the percentage change is positive
                    $test_percentage_change = ($previous_day_tests > 0)
                    ? round((($current_day_tests - $previous_day_tests) / $previous_day_tests) * 100, 1)
                        : ($current_day_tests > 0 ? 100 : 0);
                    $percentage_sign = ($test_percentage_change >= 0) ? '+' : '';
                    echo $percentage_sign . $test_percentage_change . '%'; // Use $test_percentage_change from controller
                    ?>
                    <?php if ($test_percentage_change > 0): ?>
                        <!-- Up arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="Increasing trend">
                            <path d="M4 12L12 4L20 12" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 20V4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php elseif ($test_percentage_change < 0): ?>
                        <!-- Down arrow SVG icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="Decreasing trend">
                            <path d="M20 12L12 20L4 12" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 4V20" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php else: ?>
                        <!-- Neutral horizontal line icon -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" aria-label="No change">
                            <path d="M4 12H20" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php endif; ?>
                </span>
            </div>

            <!-- "More than yesterday" text -->
            <div class="card-footer">
                <?php
                // Display "more" or "less" based on the test difference, localized
                $more_or_less = ($test_difference >= 0) ? get_phrase('more') : get_phrase('less');
                $abs_difference = abs($test_difference); // Get the absolute value
                echo $abs_difference . ' ' . $more_or_less . ' ' . get_phrase('than_yesterday'); // Use $invoice_difference from controller
                ?>
            </div>
        </div>
</div>

<!-- Place this canvas below your cards in your dashboard view -->
<div class="col-sm-6 graph-canvas" style="margin-top: 20px; padding: 0; margin-left:15px;transition: all 0.3s ease; border: 1px solid #b3b6b8; border-radius: 2rem;" >
    <div style="background-color: white; border-radius: 2rem; padding: 20px;">
        <canvas id="incomeChart" width="450" height="300"></canvas>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('incomeChart').getContext('2d');

    // PHP passes $daily_income associative array mapping dates to income
    const dailyIncome = <?php echo json_encode($daily_income, JSON_NUMERIC_CHECK); ?>;

    // Extract labels (dates) and data points (income)
    const labels = Object.keys(dailyIncome).map(dateStr => {
        // Format date as e.g., 'Fri 6/2' for nicer display
        const options = { weekday: 'short', month: 'numeric', day: 'numeric' };
        const date = new Date(dateStr);
        return date.toLocaleDateString(undefined, options);
    });

    const dataPoints = Object.values(dailyIncome);

    var incomeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Daily Income',
                data: dataPoints,
                fill: true,
                backgroundColor: '#d1f3ed',
                borderColor: '#13c3b4',
                borderWidth: 2,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#13c3b4'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                    font: { family: 'Poppins, sans-serif', size: 13, weight: '600' },
                    color: '#6c757d',
                    boxWidth: 0
                    }

                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '؋ ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#e0e0e0' },
                    ticks: {
                        callback: function(value) { return '؋ ' + value.toLocaleString(); },
                        font: { size: 12 },
                        color: '#555'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12 }, color: '#555' }
                }
            }
        }
    });
});
</script>

<div class="col-sm-6 graph-canvas" style="margin-top: 20px; padding:0; padding-top: 10px; margin-left: 15px; max-width: 570px; transition: all 0.3s ease; border: 1px solid #b3b6b8; border-radius: 2rem; background-color: white">
    <h4 style="text-align: center; color: #6c757d; font-weight: 600; font-size:13px;">Patient Age Distribution</h4>
    <div style="background-color: white; border-radius: 2rem; padding:0px 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); height: 298px; display: flex; justify-content: center; align-items: center;">
        <canvas id="ageDistributionChart" width="300" height="300" style="max-height: 90%; max-width: 100%;"></canvas> <!-- Adjusted width and height -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('ageDistributionChart').getContext('2d');

    const ageDistribution = <?php echo json_encode($age_distribution, JSON_NUMERIC_CHECK); ?>;
    const labels = Object.keys(ageDistribution);
    const dataPoints = Object.values(ageDistribution);

    const colors = [
        '#0f766e',
        '#3f918b',
        '#579f9a',
        '#87bbb7',
        '#b7d6d4'
    ];

    var ageChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: dataPoints,
                backgroundColor: colors,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 12,
                            weight: 'bold',
                            color: '#0f766e'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.parsed || 0;
                            return label + ': ' + value.toLocaleString();
                        }
                    }
                }
            },
            layout: {
                padding: {
                    top: 0,
                    bottom: 0
                }
            }
        }
    });
});
</script>






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