<div class="wrap">
<h1>Tennisbokning</h1>

<form method="post" action="options.php">
    <?php settings_fields('tennisbokning_general');?>
    <?php do_settings_sections('tennisbokning_general');?>

    <table class="form-table">
        <tr valign="top">
            <th scope="row">Namn</th>
            <td><input type="text" name="tennisbokning_name" value="<?php echo esc_attr(get_option('tennisbokning_name')); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row">Första tid</th>
            <td><input type="time" name="tennisbokning_first_slot_time" value="<?php echo esc_attr(get_option('tennisbokning_first_slot_time')); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row">Sista tid</th>
            <td><input type="time" name="tennisbokning_last_slot_time" value="<?php echo esc_attr(get_option('tennisbokning_last_slot_time')); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row">Bokningslängd i minuter</th>
            <td><input type="text" name="tennisbokning_slot_length_minutes" value="<?php echo esc_attr(get_option('tennisbokning_slot_length_minutes')); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row">Max antal aktiva bokningar per användare</th>
            <td><input type="text" name="tennisbokning_max_outstanding_bookings" value="<?php echo esc_attr(get_option('tennisbokning_max_outstanding_bookings')); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row">Max antal dagar framåt som kan bokas</th>
            <td><input type="text" name="tennisbokning_max_days_bookable" value="<?php echo esc_attr(get_option('tennisbokning_max_days_bookable')); ?>" /></td>
        </tr>
    </table>

    <?php submit_button(); ?>
</form>
</div>