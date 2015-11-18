<?php

return [
    'fields' => [
        'id' => [
            'label' => 'ID'
        ],
        'title' => [
            'label' => 'Title'
        ],
        'desc' => [
            'label' => 'Description (optional)'
        ],
        'is_enabled' => [
            'label' => 'Enabled'
        ],
        'append_nodes_section' => [
            'label' => 'Add menu items',
            'comment' => 'Select a page and click the "Append page node element" to add a page to the menu. Or select a content block and click the "Append content node element" to add a content block to the menu. You can then rearrange the position of the appended menu item by dragging and dropping it in the menu tree below.'
        ],
        'pages' => [
            'label' => 'Pages',
            'placeholder' => '-- Select a page --'
        ],
        'contents' => [
            'label' => 'Content blocks',
            'placeholder' => '-- Select a content block --'
        ],
        'has_url' => [
            'label' => 'Content URL',
            'comment' => 'Place a tick in this box if you want to bind an URL to the content block.',
        ],
        'content_url' => [
            'label' => 'Bind an URL to the selected content block',
        ],
        'itemselector' => [
            'label' => 'Page Selector'
        ],
        'contentselector' => [
            'label' => 'Content Selector'
        ],
        'pages_translate' => [
            'label' => 'Select a page (name) to translate',
            'placeholder' => '-- Select a page --'
        ],
        'name' => [
            'label' => 'Name'
        ],
        'translation' => [
            'label' => 'Translation'
        ]
    ],
    'readymenu' => [
        'component' => [
            'desc' => 'The component provides a ready to use Bootstrap 3 or normal menu.',
            'name' => 'ReadyMenu Component'
        ],
        'menu_id' => [
            'title' => 'Menu ID',
            'description' => 'The ID of the respective Menu.',
            'validation_message' => 'The Menu ID property can contain only numeric symbols.'
        ],
        'theme' => [
            'title' => 'Theme',
            'description' => 'Theme of the normal (non-bootstrap) menu. Possible values are "blue", "mint", "clean", "simple" or no value, which then defaults to "blue".',
            'validation_message' => 'Possible values are "blue", "mint", "clean", "simple" or no value.'
        ],
        'home' => [
            'title' => 'Home',
            'description' => 'Define the active home.'
        ],
        'bootstrap_menu' => [
            'title' => 'Bootstrap Menu',
            'description' => 'Set "bootstrap" for a Bootstrap 3 menu and "normal" for normal, non-Bootstrap menu. Default is bootstrap.',
            'validation_message' => 'Possible values are bootstrap and normal.'
        ],
        'navbar' => [
            'title' => 'Component alignment',
            'description' => 'Define the alignment of the navbar. This is for Bootstrap 3 menus only. Possible values are "navbar-fixed-top", "navbar-fixed-bottom", "navbar-static-top" or no value. Default is no value, which represents a normal Bootstrap navbar.',
            'validation_message' => 'Possible values are "navbar-fixed-top", "navbar-fixed-bottom", "navbar-static-top" or no value.'
        ]
    ],
    'base' => [
       'component' => [
            'name' => 'Base Component',
            'desc' => 'The component provides only the hierarchical menu data.',
            'validation_message' => 'The Menu ID property can contain only numeric symbols.'
       ] 
    ],
    'content_selector' => [
        'name' => 'Content Selector',
        'desc' => 'Button to append a content block to the menu list.',
        'error' => [
            'already_an_url' => 'There is already an URL bound to a content block with that name.',
            'url_not_valid' => 'The URL is not valid.'
        ],
        'url_assigned' => 'Valid URL has been assigned to the content block.',
        'append' => 'Append content node element'            
    ],
    'item_selector' => [
        'name' => 'Item Selector',
        'desc' => 'Button to append a page to the menu list.',
        'append' => 'Append page node element'
    ],
    'nested_sortable_selector' => [
        'name' => 'Nested sortable list',
        'desc' => 'Widget that prepares the nested sortable list and transforms it into HTML.',
        'title_con_block' => 'October content block',
        'title_page' => 'October page',
        'show_hide_children' => 'Click to show/hide children',
        'click_to_delete' => 'Click to delete item.'
    ],
    'plugin' => [
        'name' => 'Menu',
        'desc' => 'A multilevel, mobile device-friendly Bootstrap 3 or normal menu manager.'
    ]
];
