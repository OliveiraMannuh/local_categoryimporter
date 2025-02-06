<?php
// classes/form/import_form.php
namespace local_categoryimporter\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class import_form extends \moodleform {
    public function definition() {
        global $CFG;
        
        $mform = $this->_form;
        
        $mform->addElement('header', 'general', get_string('importcategories', 'local_categoryimporter'));
        
        $mform->addElement('filepicker', 'categoryfile', get_string('uploadfile', 'local_categoryimporter'), null,
            array('accepted_types' => '.csv'));
        $mform->addRule('categoryfile', null, 'required');
        
        $this->add_action_buttons();
    }
}


