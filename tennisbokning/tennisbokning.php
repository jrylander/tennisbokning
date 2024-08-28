<?php

/*
Plugin Name: Tennisbokning
Description: Enklast möjliga bokningssystem för tennisbokning
*/

namespace cc\rylander\tennisbokning;

require_once dirname(__FILE__) . "/shortcodes.php";
require_once dirname(__FILE__) . "/options_menu.php";
require_once dirname(__FILE__) . "/db_tables.php";

register_activation_hook( __FILE__, __NAMESPACE__ . '\db_install' );
