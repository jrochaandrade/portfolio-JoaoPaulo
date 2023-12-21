<?php

/* $modules = (array) json_decode(file_get_contents(base_path() . '/modules_statuses.json'));

$path_modules = [];
foreach ($modules as $key => $value) {
    if (is_dir(base_path("Modules/$key/app/Http/Controllers"))) {
        $path_modules["Modules\\$key\\app\\Http\\Controllers"] = base_path("Modules/$key/app/Http/Controllers");
    }
} */

return [
    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
        app_path('Http/Controllers/Home'),
        //...$path_modules,

        'Modules/InteractiveMap/app/Http/Controllers\\' => base_path('Modules/InteractiveMap/app/Http/Controllers'),

               
        
       /*  app_path('Http/Controllers/Api') => [
           'prefix' => 'api',
           'middleware' => 'api',
            // only register routes in files that match the patterns
           'patterns' => ['*Controller.php'],
           // do not register routes in files that match the patterns
           'not_patterns' => [],
        ], */
       
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        'web'
        //\Illuminate\Routing\Middleware\SubstituteBindings::class
    ]
];
