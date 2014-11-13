<?php

/**
 * @source http://jes.st/2011/phpunit-bootstrap-and-autoloading-classes/
 */

class AutoLoader {
 
    static private $classNames = array();
    
    static private $rootPath = '';
    
    public static function setRootPath($rootPath)
    {
        static::$rootPath = $rootPath;
        return new static();
    }
    
    public static function getRootPath()
    {
        return static::$rootPath;
    }
 
    public static function registerRootPath()
    {
        return static::registerDirectory(static::getRootPath());
    }
    
    /**
     * Store the filename (sans extension) & full path of all ".php" files found
     */
    public static function registerDirectory($dirName) {
 
        $di = new DirectoryIterator($dirName);
        foreach ($di as $file) {
 
            if ($file->isDir() && !$file->isLink() && !$file->isDot()) {
                // recurse into directories other than a few special ones
                self::registerDirectory($file->getPathname());
            } elseif (substr($file->getFilename(), -4) === '.php') {
                // save the class name / path of a .php file found
                AutoLoader::registerClass($file->getPathname());
            }
        }
    }
 
    public static function registerClass($fileName) {
        $className = str_replace(array(static::getRootPath(), '/'), array('', '\\'), substr($fileName, 0, -4));
        AutoLoader::$classNames[$className] = $fileName;
    }
 
    public static function loadClass($className) {
        if (isset(AutoLoader::$classNames[$className])) {
            require_once(AutoLoader::$classNames[$className]);
        }
     }
 
}
 
spl_autoload_register(array('AutoLoader', 'loadClass'));