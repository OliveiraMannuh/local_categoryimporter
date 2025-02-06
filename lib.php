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
 * Plugin functions for the local_categoryimporter plugin.
 *
 * @package   local_categoryimporter
 * @copyright 2025, Manuela Oliveira <oliveira.mannuh@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function local_categoryimporter_extend_navigation(global_navigation $navigation) {
    if (has_capability('local/categoryimporter:import', context_system::instance())) {
        $node = navigation_node::create(
            get_string('importcategories', 'local_categoryimporter'),
            new moodle_url('/local/categoryimporter/import.php'),
            navigation_node::TYPE_CUSTOM,
            null,
            'categoryimporter'
        );
        $navigation->add_node($node);
    }
}


