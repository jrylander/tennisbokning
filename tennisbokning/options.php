<div class="wrap">
<h1>Tennisbokning</h1>

<form method="post" action="options.php">
    <?php do_settings_sections('tennisbokning');?>
    <?php settings_fields('tennisbokning');?>
    <?php submit_button(); ?>
</form>
</div>