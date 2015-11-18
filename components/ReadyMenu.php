<?php namespace MarcelParis\Menu\Components;

use Cms\Classes\ComponentBase;
use MarcelParis\Menu\Models\MenuBackend as Menu;
use MarcelParis\Menu\Models\MenuTranslate as MenuTranslate;

class ReadyMenu extends ComponentBase
{
    /**
    * Class properties will be available in the page as twig variables
    */

    /** @var string See below 'defineProperties' */
    public $navbar;
    /** @var string See below 'defineProperties' */
    public $home;
    /** @var string See below 'defineProperties' */
    public $bootstrapMenu;
    /** @var string See below 'defineProperties' */
    public $theme;

    public $translation = false;
    
    public function componentDetails()
    {
        return [
            'name'        => trans('marcelparis.menu::lang.readymenu.component.name'),
            'description' => trans('marcelparis.menu::lang.readymenu.component.desc')
        ];
    }

    /**
    * Define properties
    *
    * When you add a component to a page or layout you can configure it using properties.
    *
    * @return array Returns an array with the property keys as indexes and property parameters as values.
    */
    public function defineProperties()
    {
        return [
            'menuID' => [
                'title'             => trans('marcelparis.menu::lang.readymenu.menu_id.title'),
                'description'       => trans('marcelparis.menu::lang.readymenu.menu_id.description'),
                'default'           => 1,
                'type'              => 'dropdown'
            ],
            'home' => [
                'title'             => trans('marcelparis.menu::lang.readymenu.home.title'),
                'description'       => trans('marcelparis.menu::lang.readymenu.home.description'),
                'default'           => '',
                'required'          => false,
                'type'              => 'string',
            ],
            'theme' => [
                'title'             => trans('marcelparis.menu::lang.readymenu.theme.title'),
                'description'       => trans('marcelparis.menu::lang.readymenu.theme.description'),
                'default'           => 'blue',
                'required'          => false,
                'type'              => 'string',
                'validationPattern' => '^(blue|mint|clean|simple)$|^$',
                'validationMessage' => trans('marcelparis.menu::lang.readymenu.theme.validation_message')
            ],
            'bootstrapMenu' => [
                'title'             => trans('marcelparis.menu::lang.readymenu.bootstrap_menu.title'),
                'description'       => trans('marcelparis.menu::lang.readymenu.bootstrap_menu.description'),
                'default'           => 'bootstrap',
                'type'              => 'string',
                'required'          => false,
                'validationPattern' => '^(bootstrap|normal)$',
                'validationMessage' => trans('marcelparis.menu::lang.readymenu.bootstrap_menu.validation_message')
            ],
            'navbar' => [
                'title'             => trans('marcelparis.menu::lang.readymenu.navbar.title'),
                'description'       => trans('marcelparis.menu::lang.readymenu.navbar.description'),
                'default'           => '',
                'type'              => 'string',
                'required'          => false,
                'validationPattern' => '^(navbar-fixed-top|navbar-fixed-bottom|navbar-static-top)$|^$',
                'validationMessage' => trans('marcelparis.menu::lang.readymenu.navbar.validation_message')
            ],
        ];
    }

    /**
    * Get the options for the 'menuID' component property.
    *
    * @return array Returns an array of options in the format key => label.
    */
    public function GetMenuIDOptions()
    {
        $menus = Menu::where('is_enabled', 1)->orderBy('id', 'asc')->get();
        foreach($menus as $menu) {
            $options[$menu->id] = $menu->id;
        }
        return $options;
    }

    /**
    * Page execution cycle event
    *
    * The CMS controller executes this method every time when the page or layout loads.
    * Inside the method you can inject variables to the Twig environment through the page property.
    */
    public function onRun()
    {
        // strict way, variable will be available as {{ ReadyMenu.navbar }}
        // relaxed way, variable will be globally available as {{ navbar }}
        // TO DO: prepare vars...
        $this->navbar = $this->page['navbar'] = $this->property('navbar', '');
        $this->bootstrapMenu = $this->page['bootstrapMenu'] = $this->property('bootstrapMenu', '');
        $this->theme = $this->page['theme'] = $this->property('theme', 'sm sm-blue');
        $this->home = $this->page['home'] = $this->property('home');
 
        if($this->property('bootstrapMenu') == 'bootstrap') {
            $this->addCss('/plugins/marcelparis/menu/assets/css/jquery.smartmenus.bootstrap.css');
            $this->addJs('/plugins/marcelparis/menu/assets/js/jquery.smartmenus.bootstrap.js');
        } else {
            $this->addCss('/plugins/marcelparis/menu/assets/css/sm-core-css.css');
            $this->addCss('/plugins/marcelparis/menu/assets/css/sm-' . $this->theme . '/sm-' . $this->theme . '.css');
            $this->addJs('/plugins/marcelparis/menu/assets/js/smartmenu.js');
        }
        $this->addJs('/plugins/marcelparis/menu/assets/js/jquery.smartmenus.js');
    }

    /**
    * Build normal multilevel HTML code
    *
    * @param array $items
    * @return string $list
    */
    protected function createNormalUnorderedList($items, $menuPages)
    {
        $list = '';
        $name = '';
        foreach($items as $item) {
            if($item['url']) {
                $url = $item['url'];
            }
            else {
                $url = '#';
            }
            if($item['type'] == 'content_block') {
                $name = $this->renderContent($item['name'] . '.htm');
            }
            else {
                if($this->translation) {
                    $name = $menuPages[$item['name']];
                }
                else {
                    $name = ucfirst($item['name']);
                }
            }
            $list .= '<li><a href="' . $item['url'] . '">' . $name . '</a>';
            if(array_key_exists('children', $item)) {
                $list .= '<ul>';
                $list .= $this->createUnorderedList($item['children'], $menuPages);
                $list .= '</ul>';
            }
            $list .= '</li>';
        }
        return $list;
    }

    /**
    * Build bootstrap 3 multilevel HTML code
    *
    * @param array $items
    * @return string $list
    */
    protected function createUnorderedList($items, $menuPages)
    {
         $list = '';
         $name = '';
         foreach($items as $item) {
             if($item['url']) {
                $url = $item['url'];
             }
             else {
                 $url = '#';
             }
            if($item['type'] == 'content_block') {
                $name = $this->renderContent($item['name'] . '.htm');
            }
            else {
                if($this->translation) {
                    $name = $menuPages[$item['name']];
                }
                else {
                    $name = ucfirst($item['name']);
                }
            }
            // If the item has children, the function becomes recursive 
            if(array_key_exists('children', $item)) {
                if($item['parent_id'] == '0') {
                    $class = 'dropdown';
                    $caret = '<span class="caret"></span>';
                } else {
                    $class = 'dropdown-submenu';
                    $caret = '';
                }
                $list .= '<li class="' . $class . '"><a href="' . $url . '">' . $name . $caret . '</a>';
                $list .= '<ul class="dropdown-menu">';
                $list .= $this->createUnorderedList($item['children'], $menuPages);
                $list .= '</ul>';
                $list .= '</li>';
             // Else it is a simple menu item
             } else {
                $list .= '<li><a href="' . $url . '">' . $name . '</a>';
                $list .= '</li>';
             }
         }
         return $list;
     }

    /**
    * Builds the multilevel menu
    *
    * The menu becomes available on the twig page or layout as {{ ReadyMenu.items }}
    *
    * @return string $menu
    */ 
    public function items()
    {
        $menu = '';
        $menuPages = [];
        $translation = false;
        $menu_id = $this->property('menuID');
        $record = Menu::find($menu_id);
        $arr = $record->items;
        // If the Translate plugin is installed
        if (class_exists('RainLab\Translate\Behaviors\TranslatableModel')) {
            $this->translation = true;
            // Query all translated pages at once, this will reduce the queries significantly...
            $as = MenuTranslate::all();
            foreach($as as $a) {
                $menuPages[$a->name] = $a->translation;
            }
        }
        if($this->property('bootstrapMenu') == 'bootstrap') {
            $menu = $this->createUnorderedList($arr, $menuPages);
        } else {
            $menu = $this->createNormalUnorderedList($arr, $menuPages);
        }
        return $menu;
    }
}
