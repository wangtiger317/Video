<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2ce520ab0543de08230f8780da286b2
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '3f8bdd3b35094c73a26f0106e3c0f8b2' => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/SendGrid.php',
        'b50cc3b860dd4b6f4f09e58a8f6b6ce7' => __DIR__ . '/..' . '/telesign/telesign/src/util.php',
        'a1b8cf771c4bf16e62bd369446b431fa' => __DIR__ . '/..' . '/telesign/telesign/src/version/version.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'telesign\\sdk\\' => 13,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'SendGrid\\Stats\\' => 15,
            'SendGrid\\Mail\\' => 14,
            'SendGrid\\Contacts\\' => 18,
            'SendGrid\\' => 9,
        ),
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'telesign\\sdk\\' => 
        array (
            0 => __DIR__ . '/..' . '/telesign/telesign/src',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'SendGrid\\Stats\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/stats',
        ),
        'SendGrid\\Mail\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/mail',
        ),
        'SendGrid\\Contacts\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/contacts',
        ),
        'SendGrid\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/php-http-client/lib',
            1 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib',
        ),
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf2ce520ab0543de08230f8780da286b2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf2ce520ab0543de08230f8780da286b2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}