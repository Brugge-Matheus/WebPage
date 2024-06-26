<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf6c1a03271926032932501d28e4213e
{
    public static $files = array (
        'ebe03ffed7a7c20866176adc2c2091d6' => __DIR__ . '/../..' . '/app/router/router.php',
        '4adcf60d44ad4362f89080f361bbdc50' => __DIR__ . '/../..' . '/app/helpers/constantes.php',
    );

    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf6c1a03271926032932501d28e4213e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf6c1a03271926032932501d28e4213e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbf6c1a03271926032932501d28e4213e::$classMap;

        }, null, ClassLoader::class);
    }
}
