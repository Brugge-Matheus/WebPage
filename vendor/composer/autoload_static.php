<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf6c1a03271926032932501d28e4213e
{
    public static $files = array (
        'ebe03ffed7a7c20866176adc2c2091d6' => __DIR__ . '/../..' . '/app/router/router.php',
        '4adcf60d44ad4362f89080f361bbdc50' => __DIR__ . '/../..' . '/app/helpers/constantes.php',
        'd03c5a6a9cde235e07357f3c5c37b083' => __DIR__ . '/../..' . '/app/helpers/custom.php',
        '8b4946bb97dd2c471d149c136c7f4f8b' => __DIR__ . '/../..' . '/app/core/controller.php',
        'd788c0270e029776e05ccc0f8bcda9fb' => __DIR__ . '/../..' . '/app/database/connect.php',
        '487fb772afd1e5036f2a040073bcda89' => __DIR__ . '/../..' . '/app/database/fetch.php',
        'c5c831abe3deb05584815241e65e01f1' => __DIR__ . '/../..' . '/app/helpers/flash.php',
        '600236e161ed4c106ba9e3cc4caf1580' => __DIR__ . '/../..' . '/app/helpers/sessions.php',
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
