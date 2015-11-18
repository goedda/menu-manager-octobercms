<?php namespace MarcelParis\Menu\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Flash;
use Session;

/**
 * ContentSelector Form Widget
 */
class ContentSelector extends FormWidgetBase
{
    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'marcelparis_menu_content_selector';
    
    public function widgetDetails()
    {
        return [
            'name'        => trans('marcelparis.menu::lang.content_selector.name'),
            'description' => trans('marcelparis.menu::lang.content_selector.desc')
        ];
    }

    /**
    * Ajax handler
    *
    * Removes the session key and value for the respective content block
    */
    public function onRemoveContent()
    {
        $content_block_name = 'marcelparis_menu_' . post('content_block_name');
        if (Session::has($content_block_name)) {
            Session::forget($content_block_name);
        }
    }

    /**
    * Ajax handler
    *
    * Before a content block to the menu list is added
    * the content block has to be mapped (if URL)
    */
    public function onAppendContent()
    {
        $url = post('MenuBackend[content_url]');
        // Request the content name and prefix it to avoid conflicts with other plugin's sessions
        $content_block_name = 'marcelparis_menu_' . post('MenuBackend[contents]');
        $has_url = post('MenuBackend[has_url]');
        // If URL to map, continue
        if($has_url){
            // If the session already has an URL bound to a content block with that name 
            if (Session::has($content_block_name)) {
                Flash::error(trans('marcelparis.menu::lang.content_selector.error.already_an_url'));
                return array('test' => '0');
            }
            else {
                // Is the URL not valid?
                if (filter_var($url, FILTER_VALIDATE_URL) === false) {
                    Flash::error(trans('marcelparis.menu::lang.content_selector.error.url_not_valid'));
                    return array('test' => '0');
                }
                else {
                    // map the content block name and the respective URL in the session
                    Session::put($content_block_name, $url);
                    Flash::success(trans('marcelparis.menu::lang.content_selector.url_assigned'));
                    return array('test' => '1', 'cid' => 'con');
                }
            }
        }
        // No URL to map, no troubles...
        else {
            return array('test' => '1', 'cid' => 'con');
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('contentselector');
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
    public function getSaveValue($value)
    {
        return $value;
    }
}
