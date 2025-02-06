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
 * Import for the local_categoryimporter plugin.
 *
 * @package   local_categoryimporter
 * @copyright 2025, Manuela Oliveira <oliveira.mannuh@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

require_login();
require_capability('local/categoryimporter:import', context_system::instance());

$PAGE->set_url(new moodle_url('/local/categoryimporter/import.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('importcategories', 'local_categoryimporter'));
$PAGE->set_heading(get_string('importcategories', 'local_categoryimporter'));

// Função auxiliar para encontrar ou criar categoria pelo caminho
function find_or_create_category_by_path($path) {
    global $DB;

    if (empty($path)) {
        return 0;
    }

    $categories = explode('/', trim($path, '/'));
    $parent_id = 0;

    foreach ($categories as $category_name) {
        $category_name = trim($category_name);
        if (empty($category_name)) {
            continue;
        }

        $category = $DB->get_record('course_categories',
            array('name' => $category_name, 'parent' => $parent_id));

        if (!$category) {
            $new_category = new \stdClass();
            $new_category->name = $category_name;
            $new_category->description = '';
            $new_category->descriptionformat = FORMAT_HTML;
            $new_category->parent = $parent_id;
            $category = \core_course_category::create($new_category);
            $parent_id = $category->id;
        } else {
            $parent_id = $category->id;
        }
    }

    return $parent_id;
}

$mform = new \local_categoryimporter\form\import_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/admin/index.php'));
} else if ($data = $mform->get_data()) {
    $content = $mform->get_file_content('categoryfile');

    if ($content === false) {
        \core\notification::error(get_string('invalidformat', 'local_categoryimporter'));
        redirect($PAGE->url);
    }

    $lines = explode("\n", $content);
    $headers = str_getcsv(array_shift($lines));

    // Encontrar índices das colunas
    $name_index = array_search('name', $headers);
    $description_index = array_search('description', $headers);
    $idnumber_index = array_search('idnumber', $headers);
    $category_path_index = array_search('category_path', $headers);

    $success = 0;
    $errors = 0;

    foreach ($lines as $line) {
        if (empty(trim($line))) {
            continue;
        }

        $data = str_getcsv($line);

        // Verifica apenas se o nome está presente
        if (empty($data[$name_index])) {
            $errors++;
            \core\notification::error("Error: Name field is required");
            continue;
        }

        try {
            $category = new \stdClass();
            $category->name = trim($data[$name_index]);

            // Description é opcional
            $category->description = ($description_index !== false && !empty($data[$description_index]))
                ? trim($data[$description_index])
                : '';
            $category->descriptionformat = FORMAT_HTML;

            // Determinar o parent_id usando apenas category_path
            $category->parent = ($category_path_index !== false && !empty($data[$category_path_index]))
                ? find_or_create_category_by_path($data[$category_path_index])
                : 0;

            // ID Number é opcional
            if ($idnumber_index !== false && !empty($data[$idnumber_index])) {
                $category->idnumber = trim($data[$idnumber_index]);
            }

            \core_course_category::create($category);
            $success++;

        } catch (Exception $e) {
            $errors++;
            \core\notification::error($e->getMessage());
        }
    }

    if ($success > 0) {
        \core\notification::success(get_string('uploadsuccess', 'local_categoryimporter'));
    }

    if ($errors > 0) {
        \core\notification::warning("$errors categories failed to import.");
    }

    redirect($PAGE->url);
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();

