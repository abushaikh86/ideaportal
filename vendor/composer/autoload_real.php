<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5094dfbfc8fb6a7fa38eb9a9f2b79418
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit5094dfbfc8fb6a7fa38eb9a9f2b79418', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5094dfbfc8fb6a7fa38eb9a9f2b79418', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5094dfbfc8fb6a7fa38eb9a9f2b79418::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit5094dfbfc8fb6a7fa38eb9a9f2b79418::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire5094dfbfc8fb6a7fa38eb9a9f2b79418($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire5094dfbfc8fb6a7fa38eb9a9f2b79418($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}