<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit99dbaf9ad218a31470b7f5675a491cc0
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit99dbaf9ad218a31470b7f5675a491cc0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit99dbaf9ad218a31470b7f5675a491cc0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit99dbaf9ad218a31470b7f5675a491cc0::$classMap;

        }, null, ClassLoader::class);
    }
}
