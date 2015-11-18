<?php namespace MarcelParis\Menu;

use Backend;
use System\Classes\PluginBase;

/**
 * Menu Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
    * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => trans('marcelparis.menu::lang.plugin.name'),
            'description' => trans('marcelparis.menu::lang.plugin.desc'),
            'author'      => 'MarcelParis',
            'icon'        => 'icon-navicon'
        ];
    }

    /**
     * Registers any front-end components used by this plugin.
     */
    public function registerComponents()
    {
        return [
            'MarcelParis\Menu\Components\Base'              => 'Base',
            'MarcelParis\Menu\Components\ReadyMenu'         => 'ReadyMenu',
        ];
    }

    /**
     * Registers any any back-end configuration links used by this plugin.
     */
    public function registerSettings()
    {
        return [
            'location' => [
                'label'       => 'Menu',
                'description' => 'Menu settings',
                'category'    => 'Menu',
                'icon'        => 'icon-globe',
                'class'       => 'MarcelParis\Menu\Models\MenuSettings',
                'order'       => 500,
                'keywords'    => ''
            ]
        ];
    }

    /**
     * Registers any back-end form widgets used by this plugin.
     */
    public function registerFormWidgets()
    {
        return [
            'MarcelParis\Menu\FormWidgets\ItemSelector' => [
                'label' => 'Select Page',
                'code'  => 'itemselector'
            ],
            'MarcelParis\Menu\FormWidgets\ContentSelector' => [
                'label' => 'Select Content',
                'code'  => 'contentselector'
            ],
            'MarcelParis\Menu\FormWidgets\NestedSortable' => [
                'label' => 'The nested sortable list',
                'code'  => 'nestedsortable'
            ]
        ];
    }

     /**
     * Registers back-end navigation menu items for this plugin.
     */
    public function registerNavigation()
    {
        return [
            'Menu' => [
              'label'       => 'Menu',
              'url'         => Backend::url('marcelparis/menu/menubackend'),
              'icon'        => 'icon-pencil',
              'permissions' => ['marcelparis.menu.*'],
              'order'       => 500,

              'sideMenu' => [
                  'menus' => [
                     'label'       => 'Menus',
                     'icon'        => 'icon-copy',
                     'url'         => Backend::url('marcelparis/menu/menubackend'),
                     'permissions' => ['marcelparis.menu.*']
                   ],
                   'menutranslate' => [
                     'label'       => 'Translate Menu items',
                     'icon'        => 'icon-copy',
                     'url'         => Backend::url('marcelparis/menu/menutranslate'),
                     'permissions' => ['marcelparis.menu.*']
                   ],
              ]
           ]
       ];
    }
}
