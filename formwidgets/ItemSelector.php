<?php namespace MarcelParis\Menu\FormWidgets;

use Cms\Classes\Page;
use Backend\Classes\FormWidgetBase;
use MarcelParis\Menu\Models\MenuTranslate;
use MarcelParis\Menu\Models\MenuBackend;

/**
 * ItemSelector Form Widget
 *
 * Actually the Page selector widget, but it was initially named 'ItemSelector'...
 */
class ItemSelector extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'ItemSelector';

    public function widgetDetails()
    {
        return [
            'name'        => trans('marcelparis.menu::lang.item_selector.name'),
            'description' => trans('marcelparis.menu::lang.item_selector.desc')
        ];
    }

    public function onAppendPage()
    {
        //$menu_id = post('MenuBackend[id]', 'default');
        $menu_id = $this->model->id;
        $page = post('MenuBackend[pages]', 'default');
        // MenuTranslate::
        return ['#myresult' => $page];
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('itemselector');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        //$this->addCss('css/itemselector.css', 'MarcelParis.Menu');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }
    
}
