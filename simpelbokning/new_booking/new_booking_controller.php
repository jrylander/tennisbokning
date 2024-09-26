<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/../utils.php';

function new_booking()
{
    if (!is_bookable($_GET['slot_start'])) {
        require_once dirname(__FILE__) . '/new_booking_non_bookble_view.php';
    } else {
        require_once dirname(__FILE__) . '/new_booking_view.php';
    }
}
