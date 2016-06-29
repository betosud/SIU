<?php

return [

    'default'   => [
        'length'    => 5,
        'width'     => 200,
        'height'    => 50,
        'quality'   => 90,
    ],

    'flat'   => [
        'length'    => 5,
        'width'     => 200,
        'height'    => 50,
        'quality'   => 90,
        'lines'     => 6,
        'bgImage'   => false,
        'bgColor'   => '#190707',
        'fontColors'=> ['#FFFFFF'],
        'contrast'  => -5,
    ],

    'mini'   => [
        'length'    => 3,
        'width'     => 60,
        'height'    => 32,
    ],

    'inverse'   => [
        'length'    => 5,
        'width'     => 120,
        'height'    => 36,
        'quality'   => 90,
        'sensitive' => true,
        'angle'     => 12,
        'sharpen'   => 10,
        'blur'      => 2,
        'invert'    => true,
        'contrast'  => -5,
    ]

];
