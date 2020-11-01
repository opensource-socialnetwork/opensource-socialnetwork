<?php
/**
 * PHPMailer SPL autoloader.
 * PHP Version 6
 * 
 & Modified  Arsalan Shah
 * PHPMailer SPL autoloader.
 * @param string $classname The name of the class to load
 */
function PHPMailerAutoload($classname){
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'class.'.strtolower($classname).'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register('PHPMailerAutoload', true, true);
