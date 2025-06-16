<?php

use Illuminate\Support\Str;
return [
    'view_site' => function($str){ return 'site.'.$str;} ,
    'view_page' =>  function($str){ return 'site.pages.'.$str;},
    'view_partial' =>  function($str){ return 'site.partial.'.$str;},
    'images_path' => 'storage/images/',
];
