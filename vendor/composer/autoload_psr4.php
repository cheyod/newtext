<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'think\\worker\\' => array($vendorDir . '/topthink/think-worker/src'),
    'think\\mongo\\' => array($vendorDir . '/topthink/think-mongo/src'),
    'think\\migration\\' => array($vendorDir . '/topthink/think-migration/src'),
    'think\\helper\\' => array($vendorDir . '/topthink/think-helper/src'),
    'think\\composer\\' => array($vendorDir . '/topthink/think-installer/src'),
    'think\\' => array($vendorDir . '/topthink/think-image/src', $baseDir . '/thinkphp/library/think'),
    'Workerman\\' => array($vendorDir . '/workerman/workerman-for-win', $vendorDir . '/workerman/workerman'),
    'PhpAmqpLib\\' => array($vendorDir . '/php-amqplib/php-amqplib/PhpAmqpLib'),
    'Phinx\\' => array($vendorDir . '/topthink/think-migration/phinx/src/Phinx'),
);
