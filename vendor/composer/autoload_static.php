<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite775e64eec8a436af27a9705aaddcb7e
{
    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'ConvertApi\\' => 
            array (
                0 => __DIR__ . '/..' . '/convertapi/convertapi-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInite775e64eec8a436af27a9705aaddcb7e::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
