<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit97b6cd195d88392c3314bcdf76b2963b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit97b6cd195d88392c3314bcdf76b2963b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit97b6cd195d88392c3314bcdf76b2963b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
