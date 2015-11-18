<?php namespace MarcelParis\Menu\Classes;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Extending Content Back-end Controller
 */
class ExtendingContent extends \Cms\Classes\Content
{
    /**
    * Get the content block name list of the current active theme
    *
    * @return array $result
    */
    public static function getNameList()
    {
        $result = [];
        $contents = self::sortBy('baseFileName')->all();
        foreach ($contents as $content) {
            $result[$content->baseFileName] = ucfirst($content->baseFileName).' ('.$content->baseFileName.')';
        }
        return $result;
    }
}
