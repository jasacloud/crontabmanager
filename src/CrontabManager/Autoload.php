<?php

/**
 * Autoloads Api classes
 *
 * @author    Jasacloud <account at jasacloud dot com>
 * @license   MIT License
 */
class CrontabManager_Autoload
{
    /**
     * @var string
     */
    private $dir;

    /**
     * @param string $dir
     */
    public function __construct($dir = null)
    {
        if (is_null($dir)) {
            $dir = dirname(__FILE__);
        }
        $this->dir = $dir;
    }

    /**
     * Registers Api as an SPL autoloader.
     */
    public static function register($dir = null)
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self($dir), 'autoload'));
    }

    /**
     * Handles autoloading of classes.
     *
     * @param string $class - A class name.
     * @return boolean      - Returns true if the class has been loaded
     */
    public function autoload($class)
    {
        
        if (file_exists($file = $this->dir.'/'.str_replace('\\', '/', $class).'.php')) {
            require $file;
        }
    }
}

if (!class_exists('CrontabManager_Autoload')) {
    require dirname(__FILE__) . '/Autoload.php';
}
CrontabManager_Autoload::register();
