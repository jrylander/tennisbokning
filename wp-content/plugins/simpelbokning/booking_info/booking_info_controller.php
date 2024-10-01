<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/../utils.php';

function booking_info(): string {
	    ob_start();
	    require_once dirname(__FILE__) . '/booking_info_view.php';
	    return ob_get_clean();
}
