<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace settings\constants;

 define( "DEFAULT_INPUT_CLASS",  'class1');
 define( "SITE_BASE_URL",  'http://saas.duvalproptech.com/');
 define( "FILE_BASE_URL",  SITE_BASE_URL.'ControlPanel/uploads/datalist/');
 define('PAYPAL_ID', 'sb-pkiqt1568050@business.example.com');
 define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE
 define('PAYPAL_RETURN_URL', SITE_BASE_URL.'Property/PaypalSuccess.html'); 
 define('PAYPAL_CANCEL_URL', SITE_BASE_URL.'cancel.php');
 define('PAYPAL_NOTIFY_URL', SITE_BASE_URL.'ipn.php');
 define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");

 define('PAYPAL_EXPRESS_ENV', 'sandbox'); //'sandbox'; // Or 'production'
 define('PAYPAL_EXPRESS_URL','https://api.sandbox.paypal.com/v1/'); 
 define('PAYPAL_EXPRESS_CLIENTID','AaMh2nKH5M4JCVKGLkYfny0UOsb3QxFQuVq2_KgCYolp64SXM1PAdu0x1iGtfycnD4xTdLGYvcbqmI9i');
 define('PAYPAL_EXPRESS_SECRATE_KEY','EIuhQR1pih3sUtrRsscEEVMR7bavUIsSB4GalXQcqf5eoYKYunyVxizW22dzq81A6493KQadK8DTche8');
 define('PAYPAL_CURRENCY', 'USD');

 define('PAYPAL_USERNAME', 'sb-pkiqt1568050_api1.business.example.com');
 define('PAYPAL_PASSWORD', '9MNSYT2FE4E3743X');
 define('PAYPAL_SIGNATURE', 'Axltgp6tna7k9ed3TVQ3k6K6TB7jAL-vD4c.8Sier0dGzQ.TlXdoy5oH');
 
 define('GOOGLE_CLIENT_ID', '666360874265-78llhedddolcdjv5g9h3m3artaqklaao.apps.googleusercontent.com');
 define('GOOGLE_CLIENT_SECRET', 'nweL3L616kWAsdhd6b8Bp7So');
 
 
/*
define('ANIMALS', array(
    'dog',
    'cat',
    'bird'
));
echo ANIMALS[1]; // outputs "cat"
*/
