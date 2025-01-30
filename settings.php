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
 * Plugin settings for the local_categoryimporter plugin.
 *
 * @package   local_categoryimporter
 * @copyright 2025, Manuela Oliveira <oliveira.mannuh@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add('localplugins', new admin_category('local_categoryimporter_settings', get_string('pluginname', 'local_categoryimporter')));
    
    $settings = new admin_settingpage('local_categoryimporter', get_string('pluginname', 'local_categoryimporter'));
    $ADMIN->add('local_categoryimporter_settings', new admin_externalpage(
        'local_categoryimporter_import',
        get_string('importcategories', 'local_categoryimporter'),
        new moodle_url('/local/categoryimporter/import.php')
    ));
    
    $ADMIN->add('local_categoryimporter_settings', $settings);
}


