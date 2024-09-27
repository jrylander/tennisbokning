<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/../utils.php';

function booking_confirmation_form()
{
    if (!empty($_GET['booking_id']) && !empty($_GET['booking_confirmation_code'])) {
        $slot_start_as_epoch = $_GET['slot_start'];

        // Model for the views
        $slot_start = new \DateTime("@$slot_start_as_epoch");
        $slot_end_as_epoch = $slot_start_as_epoch + \get_option('simpelbokning_slot_length_minutes') * 60;
        $slot_end = new \DateTime("@$slot_end_as_epoch");

        if (!is_bookable($slot_start_as_epoch)) {
            // redirect to error page from options
        } else {
            require_once dirname(__FILE__) . '/booking_form_view.php';
        }

    }
}
