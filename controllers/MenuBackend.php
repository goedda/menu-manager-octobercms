<?php namespace MarcelParis\Menu\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Menu Backend Back-end Controller
 */
class MenuBackend extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('MarcelParis.Menu', 'Menu', 'menus');
     }

    public function update($recordId, $context = null)
    {
        $this->addCss('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
        $this->addJs('https://code.jquery.com/ui/1.11.4/jquery-ui.js');
        $this->addJs('/plugins/marcelparis/menu/assets/js/jquery.mjs.nestedSortable.js');
        $this->addJs('/plugins/marcelparis/menu/assets/js/custom_backend.js');
        $this->addCss('/plugins/marcelparis/menu/assets/css/nested.css');
        
        // Call the FormController behavior update() method
        return $this->asExtension('FormController')->update($recordId, $context);
    }

    public function create()
    {
        $this->addCss('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
        $this->addJs('https://code.jquery.com/ui/1.11.4/jquery-ui.js');
        $this->addJs('/plugins/marcelparis/menu/assets/js/jquery.mjs.nestedSortable.js');
        $this->addJs('/plugins/marcelparis/menu/assets/js/custom_backend.js');
        
        // Call the FormController behavior create() method
        return $this->asExtension('FormController')->create();
    }

    // TO DO: flush all session data when leaving 'update' page?
}
