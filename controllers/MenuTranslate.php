<?php namespace MarcelParis\Menu\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Cms\Classes\Theme;
use Cms\Classes\Page;

/**
 * Menu Translate Back-end Controller
 */
class MenuTranslate extends Controller
{
    
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('MarcelParis.Menu', 'Menu', 'menutranslate');
    }
    
    /**
    * Get the 'pages' options
    *
    * The framework expects a method with the name get*Field*Options() to be defined in the model
    * for dropdown fields where the 'option' has been omitted
    *
    * @param string $keyValue The current key value
    * @return array Returns an array of options in the format key => label.
    */
    public function getPagesOptions($keyValue = null)
    {
        $allPages = array();        
        $allPages = Page::getNameList();
        return $allPages;
    }

    public function index()
    {
        $this->vars['MyPages'] =  $this->getPagesOptions();

        // Call the ListController behavior index() method
        $this->asExtension('ListController')->index();
    }
}
