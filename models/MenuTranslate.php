<?php namespace MarcelParis\Menu\Models;

use Model;
use Cms\Classes\Theme;
use Cms\Classes\Page;
use Db;

/**
 * MenuTranslate Model
 */
class MenuTranslate extends Model
{

    use \October\Rain\Database\Traits\Purgeable;

    protected $purgeable = ['pages'];

    /**
    * Soft implementation of the 'Translate' plugin, provides model translation for the fields in $translatable.
    */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['translation'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'marcelparis_menu_items_translations';

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
        $allPages = [];
        $existing = [];        
        $allPages = Page::getNameList();
        $translated = Db::select('select name from marcelparis_menu_items_translations');
        foreach ($translated as $t) {
            $existing[$t->name] = $t->name;
        }
        // Make sure the dropdown list does not contain pages that are already translated
        $Pages = array_diff_key($allPages, $existing);
        return $Pages;
    }

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];
}
