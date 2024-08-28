<div class="wrap">
<h1>Simpelbokning</h1>

<form method="post" action="options.php">
    <?php do_settings_sections('simpelbokning');?>
    <?php settings_fields('simpelbokning');?>
    <?php submit_button(); ?>
</form>
</div>