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

This is my first plugin for OctoberCMS and I chose a somewhat unconventional approach to handle the data. This allows to bunch assign menu items to a menu and position them in the same window. Also, compared to menu manager using a more conventional approach, the the plugin manages with less queries and computing power frontend and thus, should be faster creating menus. But the speed comes with a price, the plugin is not very flexible and data maintenance is difficult. I will maintain it for the time being, but I have little intentions of further developing it.  
Also, the 'nestedSortable' script is an alpha version and may not work on all browsers, especially older ones.
So, use the plugin on your own responsibility.

**Installation**

Use the OctoberCMS backend 'Settings -> System -> Updates -> Install plugins' option to install the plugin.  
Or use Artisan with the following command:

    php artisan plugin:install MarcelParis.Menu

###Usage

####Backend

After the installation, a new menu item 'Menu' is available in the OctoberCMS backend top menu.
Clicking that menu item will open the /backend/menu/menubackend page.  
The sidebar has two menu items:

1. 'Menus', a list of the already created menus and
2. 'Translate Menu items', a list of already translated pages

If you have not created a menu yet, click the 'Menus' button. Then click the 'New Menu Backend' button and fill the form.  
Currently, you can add two types of menu items: *OctoberCMS pages* and *content blocks*, respectively. The latter can have an URL bound to it, if wanted. Please note though that the bound URL must be a valid URL according to [RFC 2396](http://www.faqs.org/rfcs/rfc2396). I therefore suggest to use absolute paths.  
At any time you can reorder the position of the menu items in the menu tree below. Remove any unwanted menu item by just clicking the respective close-thick (X).  
Please note that changes will only be saved when the 'Save' or the 'Save and Close' button is clicked - unlike the nested set behavior that OctoberCMS offers and is used by other menu managers. In other words, if you leave the page before saving, all changes will be lost.

If you want to translate the menu items, click 'Translate Menu items' and translate the pages you are using in your menu. If the 'Translate' plugin is installed, but no translation is available, the plugin will use by default the page name (e.g. blog.htm) without the suffix and capitalized (Blog).  
If you don't have the 'Translate' plugin installed or don't want to translate the menu items, you can ignore this section of the plugin. The 'Translate' plugin is not required for this plugin to work.

####Frontend

There are two components you can use frontend:

_**Base**_

Drag the component onto your page or layout, respectively. The default markup can be called by using 

    {% component 'Base' %}

The base menu data is available as

    {{ Base.items }}

If you want to dump the data, the 'dump' method is not very suitable, so, you can also output the same data as a PHP 'print_r' dump by using

    {{ Base.dumpItems }}

The default markup dumps the menu data both ways, so you get and idea of what I mean. ;)

_**ReadyMenu**_

Drag the component onto your page or layout, respectively. The default markup can be called by using

    {% component 'ReadyMenu' %}

The ready menu HTML output is available as 

    {{ ReadyMenu.items | raw }}

The 'ReadyMenu' component injects additionally the following variables to the page/layout:

* 'navbar' - can be accessed as `{{ ReadyMenu.navbar }}` or just `{{ navbar }}`. This var is used for Bootstrap 3 menus only and defines the alignement of the navbar.
* 'bootstrapMenu' - can be accessed as `{{ ReadyMenu.bootstrapMenu }}` or just `{{ bootstrapMenu }}`. This var is used to determine whether a Bootstrap or a normal menu should be shown.
* 'theme' - can be accessed as `{{ ReadyMenu.theme }}` or just `{{ theme }}`. This var is used to define the theme for normal menus.
* 'home' - can be accessed as `{{ ReadyMenu.home }}` or just `{{ home }}`. This var is used to define the home page name in the menu. The URL is always '/' for the home page in the default markup.

If you use the default markup of the 'ReadyMenu' component, it will automatically load the proper view file and output a nice Bootstrap 3 or a normal, theme-based menu.  
If you want to customize things (even little changes), do not hack the default markup, instead use custom view files as described below.

**Use of custom view file(s)**

Instead of using

    {% component 'ReadyMenu' %}

on your page or layout, respectively, call

    {% partial 'MyCustomReadyMenu' %}

and create a partial 'MyCustomReadyMenu.htm' in the /partials folder of your active theme.  
Please read also the specifications for [smartmenu](https://github.com/vadikom/smartmenus) menus, if you intend to customize the menu view files.
