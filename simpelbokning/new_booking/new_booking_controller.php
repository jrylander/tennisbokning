<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/../utils.php';

function new_booking()
{
    $slot_start_as_epoch = $_POST['slot_start'];
    \error_log("slot_start_as_epoch: $slot_start_as_epoch");
    $slot_start = new \DateTime("@$slot_start_as_epoch");
    
    if (!is_bookable($slot_start_as_epoch)) {
        require_once dirname(__FILE__) . '/new_booking_non_bookble_view.php';
    } else {
        require_once dirname(__FILE__) . '/new_booking_view.php';
    }
}
