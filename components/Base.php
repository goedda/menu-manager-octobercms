<?php namespace MarcelParis\Menu\Components;

use Cms\Classes\ComponentBase;
use MarcelParis\Menu\Models\MenuBackend as Menu;

class Base extends ComponentBase
{
    /**
    * Component details
    *
    * The componentDetails() method is required.
    *
    * @return array An array with two keys: name and description. The name and description are display in the CMS back-end user interface.
    */ 

    public function componentDetails()
    {
        return [
            'name'        => trans('marcelparis.menu::lang.base.component.name'),
            'description' => trans('marcelparis.menu::lang.base.component.desc')
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
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => trans('marcelparis.menu::lang.readymenu.menu_id.validation_message')
            ]
        ];
    }

    /**
    * Multilevel menu base data
    *
    * The menu data becomes available on the page as {{ Base.items }}
    *
    * @return array $menu
    */ 
    public function items()
    {
        $menu_id = $this->property('menuID');
        $menu = Menu::find($menu_id)->items;
        return $menu;
    }

    /**
    * Dump the menu base data - the twig '{{ dump() }}' does not dump arrays well...
    *
    * The dumped menu data becomes available on the page as {{ Base.dumpItems }}
    *
    * @return string
    */ 
    public function dumpItems()
    {
        return print_r($this->items());
    }
}
