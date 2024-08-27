<?php

namespace cc\rylander\tennisbokning;

function register_tennisbokning_shortcode()
{
    add_shortcode('tennisbokning', __NAMESPACE__ . '\tennisbokning_shortcode');
}
function tennisbokning_shortcode()
{
    return '<div id="tennisbokning">Tennisbokning visas här</div>';
}

add_action('init', __NAMESPACE__ . '\register_tennisbokning_shortcode');
