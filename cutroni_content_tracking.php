<?php

/**
 * Plugin Name: Justin Cutroni's Advanced Content Tracking with Google Analytics
 * Plugin URI: https://github.com/markdhansen/cutroni-content-tracking
 * Description: An implementation of Advanced Content Tracking suggestions posted in Justin Cutroni's Blog.
 * Version: 1.0
 * Author: Megalytic
 * Author URI: http://megalytic.com
 * License: GPLv2 or later

  Copyright (C) 2014 Megalytic - info@megalytic.com

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
define("JCACT_VERSION", '1.0');
define("JCACT_URL", trailingslashit(plugin_dir_url(__FILE__)));
define("JCACT_PATH", plugin_dir_path(__FILE__));
define("JCACT_OPTION_NAME", 'jcact_options');
if (is_admin()) {
    require_once JCACT_PATH . 'admin/class-admin.php';
}

add_action('wp_enqueue_scripts', 'jcact_enqueue_scripts');

// add_action('login_enqueue_scripts', 'jcact_enqueue_scripts');

function jcact_enqueue_scripts() {

    // TODO need option to put script in footer
    wp_register_script('jcact_script', plugins_url('js/jcact.js', __FILE__), array('jquery'), JCACT_VERSION, false);
    // localize the JS
    $options = get_option(JCACT_OPTION_NAME);
    $debugModeValue = false;
    if (!empty($options['debugMode'])) {
        $debugModeValue = $options['debugMode'];
    }
    $startedReadingLocationValue = 150;
    if (!empty($options['startedReadingLocation'])) {
        $startedReadingLocationValue = $options['startedReadingLocation'];
    }
    $delayAfterScrollValue = 100;
    if (!empty($options['delayAfterScroll'])) {
        $delayAfterScrollValue = $options['delayAfterScroll'];
    }
    $contentSelectorValue = '.entry-content';
    if (!empty($options['contentSelector'])) {
        $contentSelectorValue = $options['contentSelector'];
    }
    $localizationArr = array('debugMode' => $debugModeValue, 'startedReadingLocation' => $startedReadingLocationValue,
        'delayAfterScroll' => $delayAfterScrollValue, 'contentSelector' => $contentSelectorValue);
    wp_localize_script('jcact_script', 'jcact_script_options', $localizationArr);

    // only enqueue the script if the content is a post
    wp_reset_query();
    if (is_single()) {
        wp_enqueue_script('jcact_script');
    }
}

