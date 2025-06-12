<div class="row">
    <!-- Raw Links -->
    <div class="col-md-12 col-sm-12 clearfix" style="display:flex; justify-content:flex-end; align-items:center; height:10vh;">
    <div class="col-md-12 col-sm-12 clearfix" style="text-align:left;">
        <h2 id="system-name"><?php echo $system_name; ?></h2>
    </div>
        <!-- Language Switcher in Header -->
        <form method="post" action="<?php echo base_url('index.php/admin/set_language'); ?>" id="languageForm" style="display:inline;">
            <label for="languageSelect" class="language-label">
                <select name="language" class="language-dropdown" id="languageSelect" onchange="this.form.submit()">
                    <?php
                    $CI =& get_instance();
                    $CI->load->database();
                    $fields = $CI->db->list_fields('language');
                    $current_default_language = $CI->db->get_where('settings', array('type' => 'language'))->row()->description;

                    foreach ($fields as $field) {
                        if ($field == 'phrase_id' || $field == 'phrase') continue;
                        ?>
                        <option value="<?php echo $field; ?>" <?php if ($current_default_language == $field) echo 'selected'; ?>>
                            <?php echo ucfirst($field); ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
        </form>


                <script>
                function handleLanguageChange() {
                    const lang = document.getElementById('languageSelect').value.toLowerCase(); // lowercase
                    console.log("Selected language:", lang);

                    const textAlignInput = document.getElementById('textAlignInput');

                    // lowercase match
                    if (lang === 'persian' || lang === 'pashto') {
                        textAlignInput.value = 'right-to-left';
                    } else {
                        textAlignInput.value = 'left-to-right';
                    }
                    // First submit languageForm and wait for server to update language setting
                    document.getElementById('languageForm').submit();

                    // Delay the align form submission enough so that language setting is saved before
                    setTimeout(() => {
                        document.getElementById('alignForm').submit();
                    }, 1000); // increase delay if needed
                }
                </script>




        <ul class="list-inline links-list pull-right">
            <li class="sep"></li>
            <li style="font-size:16px">
                <a href="<?php echo site_url('login/logout'); ?>">
                    <?php echo get_phrase('logout');?> &nbsp;<i class="fa fa-sign-out"></i>
                </a>
            </li>
        </ul>
    </div>

</div>

<hr style="margin-top:0px; width:100%; border:1px solid #80808033;" />