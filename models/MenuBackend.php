<?php namespace MarcelParis\Menu\Models;

use Model;
use Session;
use Cms\Classes\Theme;
use Cms\Classes\Page;
use MarcelParis\Menu\Classes\ExtendingContent as MyContent;

/**
 * MenuBackend Model
 *
 * The model is used to communicate (backend and frontend) with the 'marcelparis_menus' database table.
 * It is also used to create backend some dropdown form fields.
 */
class MenuBackend extends Model
{

    use \October\Rain\Database\Traits\Purgeable;

    /**
    * Defines the unique settings key which is used for saving the settings to the database.
    */
    public $settingsCode = 'marcelparis_menu_backend';
     
    /**
    * Reference to field configuration
    */
    public $settingsFields = 'fields.yaml';

    /**
    * Overwrite the default table name
    */
    public $table = 'marcelparis_menus';

    /**
    * Form fields that are not be saved in the database table
    */
    protected $purgeable = ['pages', 'itemselector', 'contentselector', 'contents', 'has_url', 'content_url', 'nestedsortable'];

    /**
    * Soft implementation of the 'Translate' plugin, provides model translation for the fields in $translatable.
    */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['title', 'description'];

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

    /**
    * Get the 'contents' options
    */
    public function getContentsOptions($keyValue = null)
    {
        $allContents = array();     
        $allContents = MyContent::getNameList();
        return $allContents;
    }

    /**
    * Build a tree structure out of the flat array
    *
    * @param string $parent
    * @param array $list
    * @return array Returns a structured, tree-like multi-dimensional array
    */
    protected function createTree(&$list, $parent)
    {
        $tree = array();
        foreach ($parent as $k => $l) {
            if(isset($list[$l['id']])) {
                $l['children'] = $this->createTree($list, $list[$l['id']]);
            }
            $tree[] = $l;
        } 
        return $tree;
    }

    /**
    * Mutator for the 'items' column
    *
    * @param string $value In the form of: "name[ID]=parentID", e.g. item[2]=null&item[3]=2&item[1]=2&item[4con]=2&item[5]=null
    */
    public function setItemsAttribute($value = null)
    {
        $array = [];
        $tree = [];
        // TO DO: If failed attempt in 'create' page, the value will be something like '[Object object]'...
        if($value && is_string($value)) {
            $itemUrl = '';
            $type = '';
            $value = trim($value, '"');
            $items = explode('&', $value);
            foreach ($items as $item) {
                list($key, $value) = explode("=", $item);
                $pattern = '@\[.*?\]@';
                preg_match($pattern, $key, $matches);
                $key = trim($matches['0'], '[]');
                // Get item name and if available, item URL
                $name = explode("[", $item)['0'];
                // If item is a content block, look for mapped URL in the session
                if(ends_with($key, 'con')) {
                    $type = 'content_block';
                    if (Session::has('marcelparis_menu_' . $name)) {
                        $itemUrl = Session::get('marcelparis_menu_' . $name);
                    }
                // October will look for the page URL ;)
                } else {
                    $type = 'page';
                    $itemUrl = Page::url($name);
                }
                // Create array to be stored in db
                $array[] = array('name' => $name, 'url' => $itemUrl, 'id' => $key, 'parent_id' => $value, 'type' => $type);
            }
            // Sort array before storing it in db
            $new = [];
            foreach ($array as $a) {
                $new[$a['parent_id']][] = $a;
            }
            // Doing this backend will reduce CPU frontend when creating the menu.
            $tree = $this->createTree($new, $new['0']);
        }
        // hmmm.. json_encode or it throws an 'Unexpected type of array, should attribute "%s" be jsonable?' error
        $this->attributes['items'] = json_encode($tree);
    }

    /**
    * Accessor for the 'items' column
    */
    public function getItemsAttribute($value)
    {
        return json_decode($value, true);
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
