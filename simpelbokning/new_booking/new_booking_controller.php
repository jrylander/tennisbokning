<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/../utils.php';

function new_booking()
{
    if (!empty($_GET['slot_start'])) {
        $slot_start_as_epoch = $_GET['slot_start'];

        // Model for the views
        $slot_start = new \DateTime("@$slot_start_as_epoch");
        $slot_end_as_epoch = $slot_start_as_epoch + \get_option('simpelbokning_slot_length_minutes') * 60;
        $slot_end = new \DateTime("@$slot_end_as_epoch");

        if (!is_bookable($slot_start_as_epoch)) {
            require_once dirname(__FILE__) . '/new_booking_non_bookable_view.php';
        } else {
            require_once dirname(__FILE__) . '/new_booking_view.php';
        }

    }
}
