<?php

namespace cc\rylander\simpelbokning;

add_action('init', __NAMESPACE__ . '\load_translations');

function load_translations(): void {
    load_plugin_textdomain('simpelbokning', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
