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
 * Frontpage settings and HTML
 *
 * @package     theme_standartrema
 * @copyright   2019 standartrema - {@link https://standartrema.tech/}
 * @author      Rodrigo Mady
 * @author      Trevor Furtado
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Advanced settings.
$page = new admin_settingpage('theme_standartrema_frontpagecontent', get_string('content', 'theme_standartrema'));

// Frontpage image.
$page->add(new admin_setting_heading('theme_standartrema_frontpageimages',
    get_string('frontpageimages', 'theme_standartrema'), '', FORMAT_MARKDOWN));
$name = 'theme_standartrema/numberofimages';
$title = get_string('numberofimages', 'theme_standartrema');
$description = get_string('numberofimages_desc', 'theme_standartrema');
$default = 1; // Carousel disable.
$choices = [
    0 => '0',
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5'
];
$page->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

// Frontpage button class.
$btnchoices = array(
    "btn-primary" => "btn-primary",
    "btn-secondary" => "btn-secondary",
    "btn-success" => "btn-success",
    "btn-danger" => "btn-danger",
    "btn-warning" => "btn-warning",
    "btn-info" => "btn-info",
    "btn-light" => "btn-light",
    "btn-dark" => "btn-dark"
);

$numberofcarousel = get_config('theme_standartrema', 'numberofimages');

$frontpagetitledefault      = get_string('frontpagetitle_default', 'theme_standartrema');
$frontpagesubtitledefault   = get_string('frontpagesubtitle_default', 'theme_standartrema');
$frontpagebuttontextdefault = get_string('frontpagebuttontext_default', 'theme_standartrema');
$cardtitledefault           = get_string('cardtitle', 'theme_standartrema');
$cardsubtitledefault        = get_string('cardsubtitle', 'theme_standartrema');

// Set some settings so that they can initially have a default value but later be set blank.
if ($numberofcarousel === false) { // Not set yet.
    // Initialize some default values.
    $numberofcarousel = 1;
    set_config('frontpagetitledefault', $frontpagetitledefault, 'theme_standartrema');
    set_config('frontpagesubtitledefault', $frontpagesubtitledefault, 'theme_standartrema');
    set_config('frontpagebuttontextdefault', $frontpagebuttontextdefault, 'theme_standartrema');
    set_config('cardtitledefault', $cardtitledefault, 'theme_standartrema');
}

if ($numberofcarousel == 1) {
    // Frontpage single banner.
    $name = 'theme_standartrema/frontpagebanner';
    $title = get_string('frontpagebanner', 'theme_standartrema');
    $description = get_string('frontpagebanner_desc', 'theme_standartrema');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'frontpagebanner');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Frontpage title.
    $page->add(
        new admin_setting_configtext('theme_standartrema/frontpagetitle', get_string('frontpagetitle', 'theme_standartrema'), '',
        $frontpagetitledefault));

    // Frontpage subtitle.
    $page->add(
        new admin_setting_configtext('theme_standartrema/frontpagesubtitle', get_string('frontpagesubtitle', 'theme_standartrema'), '',
        $frontpagesubtitledefault));

    // Frontpage button text.
    $page->add(
        new admin_setting_configtext('theme_standartrema/frontpagebuttontext', get_string('frontpagebuttontext', 'theme_standartrema'), '',
        $frontpagebuttontextdefault));

    // Frontpage button link.
    $page->add(
        new admin_setting_configtext('theme_standartrema/frontpagebuttonhref', get_string('frontpagebuttonhref', 'theme_standartrema'),
            get_string('frontpagebuttonhref_desc', 'theme_standartrema'), '#frontpage-cards'));

    // Frontpage button class.
    $setting = new admin_setting_configselect('theme_standartrema/frontpagebuttonclass',
        get_string('frontpagebuttonclass', 'theme_standartrema'), get_string('frontpagebuttonclass_desc', 'theme_standartrema'),
        'btn-primary', $btnchoices);
    $page->add($setting);

} else if ($numberofcarousel >= 1) {

    for ($i = 1; $i <= $numberofcarousel; $i ++) {
        $page->add(new admin_setting_heading("theme_standartrema_frontpageimage{$i}" ,
            get_string('frontpageimage', 'theme_standartrema', $i), '', FORMAT_MARKDOWN));
        // Carousel image.
        $name = "theme_standartrema/frontpageimage{$i}";
        $title = get_string('image', 'theme_standartrema', $i);
        $description = get_string('frontpageimage_desc', 'theme_standartrema', $i);
        $setting = new admin_setting_configstoredfile($name, $title, $description, "frontpageimage{$i}");
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        // Carousel title.
        $name = 'theme_standartrema/carrouseltitle' . $i;
        $title = get_string('title', 'theme_standartrema') . " $i";
        $description = get_string('title_desc', 'theme_standartrema', $i);
        $default = get_string('frontpagetitle_default', 'theme_standartrema');
        $page->add(new admin_setting_configtext($name, $title, $description, $default));

        // Carousel description.
        $name = 'theme_standartrema/carrouselsubtitle' . $i;
        $title = get_string('subtitle', 'theme_standartrema') . " $i";
        $description = get_string('subtitle_desc', 'theme_standartrema', $i);
        $default = get_string('frontpagesubtitle_default', 'theme_standartrema');
        $page->add(new admin_setting_configtext($name, $title, $description, $default));

        // Carousel button text.
        $name = 'theme_standartrema/carrouselbtntext' . $i;
        $title = get_string('carrouselbtntext', 'theme_standartrema', $i);
        $description = get_string('carrouselbtntext_desc', 'theme_standartrema', $i);
        $default = get_string('frontpagebuttontext_default', 'theme_standartrema');
        $page->add(new admin_setting_configtext($name, $title, $description, $default));

        // Carousel button link.
        $name = 'theme_standartrema/carrouselbtnhref' . $i;
        $title = get_string('carrouselbtnhref', 'theme_standartrema', $i);
        $description = get_string('carrouselbtnhref_desc', 'theme_standartrema', $i);
        $page->add(new admin_setting_configtext($name, $title, $description, ''));

        // Carousel button class.
        $name = 'theme_standartrema/carrouselbtnclass' . $i;
        $title = get_string('carrouselbtnclass', 'theme_standartrema', $i);
        $description = get_string('carrouselbtnclass_desc', 'theme_standartrema', $i);
        $page->add(new admin_setting_configselect($name, $title, $description, 'btn-primary', $btnchoices));
    }
}

// Enable/disable dark overlay on banner.
$name = 'theme_standartrema/frontpageenabledarkoverlay';
$title = get_string('frontpageenabledarkoverlay', 'theme_standartrema');
$description = get_string('frontpageenabledarkoverlay_desc', 'theme_standartrema');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// HTML to include in the main content of frontpage.
$setting = new admin_setting_confightmleditor('theme_standartrema/defaultfrontpagebody', get_string('defaultfrontpagebody', 'theme_standartrema'),
    get_string('defaultfrontpagebody_desc', 'theme_standartrema'), '', PARAM_RAW);
$page->add($setting);

// Frontpage cards.
$page->add(new admin_setting_heading('theme_standartrema_cards', get_string('frontpagecards', 'theme_standartrema'), '', FORMAT_MARKDOWN));

// Enable/disable frontpage cards.
$name = 'theme_standartrema/frontpageenablecards';
$title = get_string('frontpageenablecards', 'theme_standartrema');
$description = get_string('frontpageenablecards_desc', 'theme_standartrema', "$CFG->wwwroot/theme/standartrema/pix/examples/cards.png");
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$page->add($setting);

if (get_config('theme_standartrema', 'frontpageenablecards')) {
    // Title.
    $name = 'theme_standartrema/frontpagecardstitle';
    $title = get_string('title', 'theme_standartrema');
    $description = '';
    $page->add(new admin_setting_configtext($name, $title, $description, get_string('cardtitle', 'theme_standartrema')));

    // Subtitle.
    $name = 'theme_standartrema/frontpagecardssubtitle';
    $title = get_string('subtitle', 'theme_standartrema');
    $description = '';
    $page->add(
        new admin_setting_configtext($name, $title, $description, get_string('cardsubtitle', 'theme_standartrema')));

    // Number of cards.
    $name = 'theme_standartrema/numberofcards';
    $title = get_string('numberofcards', 'theme_standartrema');
    $description = '';
    $default = 4;
    $choices = array(
        2 => '2',
        4 => '4',
        6 => '6'
    );
    $page->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    $numberofcards = get_config('theme_standartrema', 'numberofcards');
    for ($i = 1; $i <= $numberofcards; $i ++) {
        // Card header.
        $page->add(new admin_setting_heading('theme_standartrema_card' . $i, get_string('card', 'theme_standartrema') . ' ' . $i, ''));

        // Card icon.
        $name = 'theme_standartrema/cardicon' . $i;
        $title = get_string('cardicon', 'theme_standartrema') . ' ' . $i;
        $description = get_string('cardicon_desc', 'theme_standartrema');
        $page->add(new admin_setting_configtext($name, $title, $description, 'fa-paper-plane'));

        // Card icon color.
        $name = 'theme_standartrema/cardiconcolor' . $i;
        $title = get_string('cardiconcolor', 'theme_standartrema') . ' ' . $i;
        $description = '';
        $setting = new admin_setting_configcolourpicker($name, $title, $description, '#000000');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        // Card title.
        $name = 'theme_standartrema/cardtitle' . $i;
        $title = $cardtitledefault . ' ' . $i;
        $description = '';
        $page->add(new admin_setting_configtext($name, $title, $description,
            get_string('cardtitle_default', 'theme_standartrema') .  ' ' . $i));

        // Card description.
        $name = 'theme_standartrema/cardsubtitle' . $i;
        $title = $cardsubtitledefault . ' ' . $i;
        $description = '';
        $page->add(new admin_setting_configtext($name, $title, $description, get_string('cardsubtitle_default', 'theme_standartrema')));

        // Card link.
        $name = 'theme_standartrema/cardlink' . $i;
        $title = get_string('cardlink', 'theme_standartrema') . ' ' . $i;
        $description = '';
        $page->add(new admin_setting_configtext($name, $title, $description, ''));
    }
}

// Settings for Courses.
$page->add(new admin_setting_heading('theme_standartrema_courses', get_string('courses'), '', FORMAT_MARKDOWN));

// Course enrolment page format.
$choices = array(
    "card" => get_string('courseenrolmentpagecard', 'theme_standartrema'),
    "fullwidth" => get_string('courseenrolmentpagefull', 'theme_standartrema')
);
$setting = new admin_setting_configselect('theme_standartrema/courseenrolmentpageformat',
    get_string('courseenrolmentpageformat', 'theme_standartrema'), get_string('courseenrolmentpageformat_desc', 'theme_standartrema'),
    'fullwidth', $choices);
$page->add($setting);

// Show activity navigation.
$name = 'theme_standartrema/shownactivitynavigation';
$title = get_string('shownactivitynavigation', 'theme_standartrema');
$description = get_string('shownactivitynavigation_desc', 'theme_standartrema');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$page->add($setting);

// Courses cards.
$page->add(new admin_setting_heading('theme_standartrema_course_cards', get_string('coursescards', 'theme_standartrema'), '', FORMAT_MARKDOWN));

// Summary type.
$choices = array(
    "modal" => "modal",
    "popover" => "popover"
);
$setting = new admin_setting_configselect('theme_standartrema/summarytype',
    get_string('summarytype', 'theme_standartrema'), get_string('summarytype_desc', 'theme_standartrema'),
    'btn-primary', $choices);
$page->add($setting);

// Show categories on Frontpage course cards.
$name = 'theme_standartrema/showcategories';
$title = get_string('showcategories', 'theme_standartrema');
$description = get_string('showcategories_desc', 'theme_standartrema');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$page->add($setting);

// Show categories on Frontpage course cards.
$name = 'theme_standartrema/showehiddencategorycourses';
$title = get_string('showehiddencategorycourses', 'theme_standartrema');
$description = get_string('showehiddencategorycourses_desc', 'theme_standartrema');
$default = true;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$settings->add($page);
