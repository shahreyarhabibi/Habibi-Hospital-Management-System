<!-- Add this where you display messages -->
<?php if ($this->session->flashdata('success_message')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success_message'); ?>
    </div>
<?php endif; ?>