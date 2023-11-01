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
 * Style Guide settings
 *
 * @package     theme_standartrema
 * @copyright   2019 standartrema - {@link https://standartrema.tech/}
 * @author      Rodrigo Mady
 * @author      Trevor Furtado
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/theme/standartrema/standartrema_admin_settings_styleguide.php');

// Style Guide.
$page = new admin_settingpage('theme_standartrema_styleguide', get_string('styleguide', 'theme_standartrema'));

// Raw Bootstrap HTML to show the options of theme.
$setting = new standartrema_admin_settings_styleguide('theme_standartrema_styleguide',
    get_string('styleguide', 'theme_standartrema'));
$page->add($setting);

$settings->add($page);
