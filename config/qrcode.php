<?php
return [

    /*
    |--------------------------------------------------------------------------
    | QR Code Image Renderer
    |--------------------------------------------------------------------------
    |
    | Use 'gd' or 'imagick'. GD works on almost all servers.
    |
    */
    'renderer' => [
        'image' => 'gd',
    ],

    'format' => 'png', // default
    'size' => 300,     // default
];

