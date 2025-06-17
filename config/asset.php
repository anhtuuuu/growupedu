<?php

use Illuminate\Support\Str;
return [
    'css_path' => 'frontend/dist/css/',
    'js_path' => 'frontend/dist/js/',
    'dist_admin_path' => 'backend/AdminLTE/',
    'view_site' => function($str){ return 'site.'.$str;} ,
    'view_page' =>  function($str){ return 'site.pages.'.$str;},
    'view_partial' =>  function($str){ return 'site.partial.'.$str;},
    'view_admin' =>  function($str){ return 'admin.'.$str;},
    'view_admin_page' =>  function($str){ return 'admin.pages.'.$str;},
    'view_admin_partial' =>  function($str){ return 'admin.partial.'.$str;},
    'images_path' => 'storage/images/',
];
