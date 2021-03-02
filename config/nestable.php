<?php

return [
    'parent'=> 'parent_id',
    'primary_key' => 'id',
    'generate_url'   => true,
    'childNode' => 'children',
    'body' => [
        'id',
        'name',
        'slug',
    ],
    'html' => [
        'label' => 'name',
        'href'  => 'id'
    ],
    'dropdown' => [
        'prefix' => '',
        'label' => 'name',
        'value' => 'id'
    ]
];
