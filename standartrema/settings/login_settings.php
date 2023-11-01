<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Login settings
 *
 * @package     theme_standartrema
 * @copyright   2019 standartrema - {@link https://standartrema.tech/}
 * @author      Rodrigo Mady
 * @author      Trevor Furtado
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_standartrema_login', get_string('login', 'theme_standartrema'));

// Login page style.
$choices = array(
    "particle-circles" => get_string('particlecircles', 'theme_standartrema'),
    "image" => get_string('image', 'theme_standartrema', ''),
    "none" => get_string('none')
);
$setting = new admin_setting_configselect('theme_standartrema/loginpagestyle', get_string('loginpagestyle', 'theme_standartrema'), '',
    'particle-circles', $choices);
$page->add($setting);

if (get_config('theme_standartrema', 'loginpagestyle') == "particle-circles") {
    // Background color.
    $name = 'theme_standartrema/particles_backgroundcolor';
    $title = get_string('backgroundcolor', 'theme_standartrema');
    $description = '';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#020221');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Circles color.
    $name = 'theme_standartrema/particles_circlescolor';
    $title = get_string('circlescolor', 'theme_standartrema');
    $description = '';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#FFFFFF');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
} else if (get_config('theme_standartrema', 'loginpagestyle') == "image") {
    // Login background image.
    $name = 'theme_standartrema/loginbackgroundimage';
    $title = get_string('loginbackgroundimage', 'theme_standartrema');
    $description = '';
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
}

$setting = new admin_setting_configcheckbox(
    'theme_standartrema/loginpagecreatefirst',
    get_string('loginpagecreatefirst', 'theme_standartrema'),
    get_string('loginpagecreatefirst_desc', 'theme_standartrema'),
    0);
$page->add($setting);

$settings->add($page);
