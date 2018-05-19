<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= base_url()?>public/asset/front/js/vendor/bootstrap.min.js"></script>
<script src="<?= base_url()?>public/asset/front/js/datepicker.js"></script>
<script src="<?= base_url()?>public/asset/front/js/plugins.js"></script>
<script src="<?= base_url()?>public/asset/front/js/main.js"></script>
<script src="<?= base_url()?>public/asset/front/js/common.js"></script>
<?php
if (!empty($js)){ 
 foreach ($js as $value){ ?>
<script src="<?= base_url()?>public/asset/front/js/<?php echo $value; ?>" type="text/javascript"></script>

<?php } } ?>
<script>
    jQuery(document).ready(function() {
        <?php
        if (!empty($init)) {
            foreach ($init as $value) {
                echo $value . ';';
            }
        }
        ?>
    });
</script>