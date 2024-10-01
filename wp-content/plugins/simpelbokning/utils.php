<?php

namespace cc\rylander\simpelbokning;

function is_bookable($timestamp) {
    $now = new \DateTimeImmutable();
    if ($timestamp < $now->getTimestamp()) {
        return false;
    }
    if ($timestamp > $now->getTimestamp() + \get_option('simpelbokning_max_days_bookable') * 24 * 60 * 60) {
        return false;
    }
    return true;
}

?>