<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'profile-images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/profile-images'),
            'url' => env('APP_URL') . '/disks/profile-images',
            'visibility' => 'public',
            'throw' => false,
        ],

        'post-thumbnails' => [
            'driver' => 'local',
            'root' => storage_path('app/public/post-thumbnails'),
            'url' => env('APP_URL') . '/disks/post-thumbnails',
            'visibility' => 'public',
            'throw' => false,
        ],
        'product-thumbnails' => [
            'driver' => 'local',
            'root' => storage_path('app/public/product-thumbnails'),
            'url' => env('APP_URL') . '/disks/product-thumbnails',
            'visibility' => 'public',
            'throw' => false,
        ],
        'product-images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/product-images'),
            'url' => env('APP_URL') . '/disks/product-images',
            'visibility' => 'public',
            'throw' => false,
        ],
        'uploads' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads'),
            'url' => env('APP_URL') . '/disks/uploads',
            'visibility' => 'public',
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [

        public_path('disks/uploads') => storage_path('app/public/uploads'),
        public_path('disks/post-thumbnails') => storage_path('app/public/post-thumbnails'),
        public_path('disks/product-thumbnails') => storage_path('app/public/product-thumbnails'),
        public_path('disks/product-images') => storage_path('app/public/product-images'),
        public_path('disks/profile-images') => storage_path('app/public/profile-images'),
    ],

];