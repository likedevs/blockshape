<?php

/**
 * The menu structure of the site. For models, you should either supply the name of a model config file or an array of
 * names of model config files. The same applies to settings config files, except you must prepend 'settings.' to the
 * settings config file name. You can also add custom pages by prepending a view path with 'page.'. By providing an
 * array of names, you can group certain models or settings pages together. Each name needs to either have a config
 * file in your model config path, settings config path with the same name, or a path to a fully-qualified Laravel
 * view. So 'users' would require a 'users.php' file in your model config path, 'settings.site' would require a
 * 'site.php' file in your settings config path, and 'page.foo.test' would require a 'test.php' or 'test.blade.php'
 * file in a 'foo' directory inside your view directory.
 *
 * @type array
 *
 *    array(
 *        'E-Commerce' => array('collections', 'products', 'product_images', 'orders'),
 *        'homepage_sliders',
 *        'users',
 *        'roles',
 *        'colors',
 *        'Settings' => array('settings.site', 'settings.ecommerce', 'settings.social'),
 *        'Analytics' => array('E-Commerce' => 'page.ecommerce.analytics'),
 *    )
 */
return [
    'sites',
    'Roles' => [
        'icon' => 'fa-folder',
        'pages' => [
            'admins',
            'managers',
            'instructors',
            'members',
        ],
    ],
    'Front part' => [
        'pages' => [
            'account',
            'main_pages',
            'blocks_pages',
            'blocks_images',
            'subscriptions',
            'seminars',
            'events',
            'photo-stories',
            'video-stories',
            'videos',
            'projects',
            'messages'
        ],
    ],
    'Videos' => [
        'pages' => [
            'account_videos',
            'video-instructors'
        ],
    ],
    'History' => [
        'icon' => 'fa-folder',
        'pages' => [
            'history_records',
        ],
    ],
    'Payments' => [
        'pages' => [
            'offers',
            'banktransactions',
            'qiwitransactions',
        ],
    ],
    'Content' => [
        'pages' => [
            'targets',
            'offices',
            'exercises',
            'pressure_types',
            'pressure_map',
            'figure_types',
            'constitution_types',
            'general_recommendations',
            'taxonomy',
            'imcs',
            'translations',
            'pages',
        ],
    ],
    'Meniu' => [
        'pages' => [
            'nutrients',
            'recipes',
        ],
    ],
    'Exceptii Meniu' => [
        'pages' => [
            'diseases',
            'allergies',
            'food_excludes',
        ],
    ],
    'Tabele calorice' => [
        'pages' => [
            'reference_groups',
            'reference_products',
        ],
    ],
    'Corectari alimentatie' => [
        'pages' => [
            'quiz_questions',
            'quiz_hints',
            'quiz_answers_groups',
            //'quiz_answers'
        ],
    ],

];
