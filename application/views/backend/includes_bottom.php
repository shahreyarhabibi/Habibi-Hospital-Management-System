<link rel="stylesheet" href="<?php echo base_url('assets/js/daterangepicker/daterangepicker-bs3.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/selectboxit/jquery.selectBoxIt.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/wysihtml5/bootstrap-wysihtml5.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/selectboxit/jquery.selectBoxIt.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/datatables/responsive/css/datatables.responsive.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/select2/select2-bootstrap.css');?>">
<link rel="stylesheet" href="<?php echo base_url('assets/js/select2/select2.css');?>">

<!-- Bottom Scripts -->
<script src="<?php echo base_url('assets/js/gsap/main-gsap.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
<script src="<?php echo base_url('assets/js/joinable.js');?>"></script>
<script src="<?php echo base_url('assets/js/resizeable.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-api.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-switch.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/toastr.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/fileinput.js');?>"></script>
<script src="<?php echo base_url('assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/wysihtml5/bootstrap-wysihtml5.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.multi-select.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.knob.js');?>"></script>
<script src="<?php echo base_url('assets/js/selectboxit/jquery.selectBoxIt.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.inputmask.bundle.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/daterangepicker/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/daterangepicker/daterangepicker.js');?>"></script>

<link rel="stylesheet" href="<?php echo base_url('assets/js/dropzone/dropzone.css');?>">
<script src="<?php echo base_url('assets/js/dropzone/dropzone.js');?>"></script>

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/datatables/TableTools.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.bootstrap.js');?>"></script>
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.columnFilter.js');?>"></script>
<script src="<?php echo base_url('assets/js/datatables/lodash.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/datatables/responsive/js/datatables.responsive.js');?>"></script>
<script src="<?php echo base_url('assets/js/select2/select2.min.js');?>"></script>

<script src="<?php echo base_url('assets/js/neon-calendar.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-chat.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-custom.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-demo.js');?>"></script>
<script src="<?php echo base_url('assets/js/neon-notes.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.form.js');?>"></script>

<script src="<?php echo base_url('assets/js/ajax-form-submission.js');?>"></script>

<script>
    $(".html5editor").wysihtml5();
</script>

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
