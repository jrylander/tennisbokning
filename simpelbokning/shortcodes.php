<?php

namespace cc\rylander\simpelbokning;

add_action('init', __NAMESPACE__ . '\register_simpelbokning_shortcode');

function register_simpelbokning_shortcode()
{
    add_shortcode('simpelbokning', __NAMESPACE__ . '\simpelbokning_shortcode');
}
function simpelbokning_shortcode()
{
    return '<div id="simpelbokning">Simpelbokning visas här</div>';
}
