<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Zend\Log',
    'Zend\Navigation',
    'Zend\Mvc\Plugin\FlashMessenger',
    'Zend\Router',
    'Zend\Validator',
    'Zend\Mail',
    'Application',
    'Market',
    'Model',
    'Events',
    'Registration',
    'SecurePost',
    'Login',
    'RestApi',
    'Cache',
    'AccessControl',
    'PhpSession',
    'Logging',
    'Notification',
    //*** DOCTRINE LAB
    //'MyDoctrine',
    //*** BLOCK CIPHER LAB
    //'PrivateMessages',
    //*** ENCRYPTION LAB
    // 'Encryption',
    //*** OAUTH LAB
    // 'AuthOauth',
    //*** TRANSLATION LAB
    // 'Translation',
    //*** PSR7BRIDGE LAB
    // 'DefaultLocale',
    //*** MIDDLEWARE LAB
    // 'Manage',
];
