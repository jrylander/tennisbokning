<?php

namespace cc\rylander\simpelbokning;

use DateTime;
use function get_option;

require_once dirname(__FILE__) . '/../utils.php';

function booking_form()
{
    if (!empty($_GET['slot_start'])) {
        $slot_start_as_epoch = $_GET['slot_start'];
        $slot_start = new DateTime("@$slot_start_as_epoch");

        $slot_end_as_epoch = $slot_start_as_epoch + get_option('simpelbokning_slot_length_minutes') * 60;
        $slot_end = new DateTime("@$slot_end_as_epoch");

        if (!is_bookable($slot_start_as_epoch)) {
            // redirect to error page from options
        } else {
            ob_start();
            require_once dirname(__FILE__) . '/booking_form_view.php';
            return ob_get_clean();
        }
    }
}
