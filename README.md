# menu-manager-octobercms
A multilevel, mobile device friendly Bootstrap 3 or normal menu manager for OctoberCMS.

This is a menu manager plugin for the OctoberCMS. It uses the [nestedSortable](https://github.com/ilikenwf/nestedSortable) jQuery ui script to make the assignment and positioning of new menu items easy and user friendly. It uses the the [smartmenus](https://github.com/vadikom/smartmenus) jQuery script to have frontend the real Bootstrap 3 multilevel experience and it also makes the menus mobile device friendly.

**Features**

* multilevel
* possibility to create multiple menus, though only one menu at a time can be used on a page
* two components: 'ReadyMenu' and 'Base'
* mobile device friendly
* supports the 'Translate' plugin for frontend translation
* Bootstrap 3 menu or normal menu
* linkable Bootstrap level-0 menu item 
* different themes for the normal menu
* Megamenu feature, you can add OctoberCMS content blocks with or without URL

**Disclaimer**

This is my first plugin for OctoberCMS and I chose a somewhat unconventional approach to handle the data. This makes the backend UI very easy and compared to a more conventional approach the creation of the menu is very fast. The price to pay is that the plugin is not very flexible and data maintenance is difficult.
Also, the 'nestedSortable' script is an alpha version and may not work on all browsers, especially older ones.
So, use the plugin on your own responsibility.

**Installation**

Use the OctoberCMS backend 'Settings -> System -> Updates -> Install plugins' option to install the plugin.
Or use Artisan with the following command:

`php artisan plugin:install MarcelParis.Menu`

###Usage

**Backend**

After the installation, a new menu item 'Menu' is available in the OctoberCMS backend top menu.
Clicking that menu item will open the /backend/menu/menubackend page. The sidebar has two menu items:

1. 'Menus', a list of the already created menus and
2. 'Translate Menu items', a list of already translated pages

If you have not created a menu yet, click the 'Menus' button. Then click the 'New Menu Backend' button and fill the form.
Currently, you can add two types of menu items: OctoberCMS pages and content blocks, respectively. The latter can have an URL bound to it, if wanted. Please note that the URL must be a valid URL according to [RFC 2396](http://www.faqs.org/rfcs/rfc2396). I suggest to use absolute paths.
At any time you can reorder the position of the menu items in the menu tree below. Remove an unwanted menu item by clicking the respective close-thick (X).
Please note that changes will be only saved when the 'Save' or 'Save and Close' button is clicked - unlike the nested set behavior that OctoberCMS offers and is used by other menu managers. If you leave the page before saving, all changes will be lost.

If you want to translate the menu items, click 'Translate Menu items' and translate the pages you are using in your menu. If no translation is available and the 'Translate' plugin is installed, the plugin will use the page name (e.g. blog.htm) without the suffix and capitalized (Blog).
If you don't have the 'Translate' plugin installed or don't want to translate the menu items, you can ignore this section of the plugin.

**Frontend**

There are two components you can use frontend:

1. Base

Drag the component onto your page or layout, respectively. The default markup can be call by using 
`{% component 'Base' %}`
The base menu data is available as 
`{{ Base.items }}`
If you want to dump the data, the 'dump' method is not very suitable, so, you can also output the same data with a PHP 'print_r' dump by using
`{{ Base.dumpItems }}`
The default markup dumps the menu data both ways, so you get and idea of what I mean. ;)

2. ReadyMenu

Drag the component onto your page or layout, respectively. The default markup can be call by using
`{% component 'ReadyMenu' %}`
The ready menu HTML output is available as 
`{{ ReadyMenu.items | raw }}`

The 'ReadyMenu' component injects additionally the following variables to the page/layout:

* 'navbar' - can be accessed as {{ ReadyMenu.navbar }} or just {{ navbar }}. This var is used for Bootstrap 3 menus only and defines the alignement of the navbar.
* 'bootstrapMenu' - can be accessed as {{ ReadyMenu.bootstrapMenu }} or just {{ bootstrapMenu }}. This var is used to determine whether a Bootstrap or a normal menu should be shown.
* 'theme' - can be accessed as {{ ReadyMenu.theme }} or just {{ theme }}. This var is used to define the theme for normal menus.
* 'home' - can be accessed as {{ ReadyMenu.home }} or just {{ home }}. This var is used to define the home page name in the menu. The URL is always '/' for the home page in the default markup.

If you use the plugin's default markup, the component will automatically load the proper view file and output a nice Bootstrap 3 or a normal, theme-based menu. You may want to use your own custom view file in order to customize some things.

** Use of custom view file(s) **

Instead of using
`{% component 'ReadyMenu' %}`
on your page or layout, respectively, use a partial like
`{% partial 'MyCustomReadyMenu' %}`
and create a partial 'MyCustomReadyMenu.htm' in the /partials folder of your theme.

Please read also the specifications for [smartmenu](https://github.com/vadikom/smartmenus) menus.
