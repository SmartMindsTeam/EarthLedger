<?php return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=localhost;dbname=earthledger_live',
      'username' => 'root',
      'password' => 'root',
      'charset' => 'utf8',
    ),
    'user' => 
    array (
    ),
    'mailer' => 
    array (
      'transport' => 
      array (
        'class' => 'Swift_SmtpTransport',
        'host' => 'earthledger.one',
        'username' => 'welcome@earthledger.one',
        'password' => 'YmPh+{u+[HSw',
        'encryption' => 'ssl',
        'port' => '465',
      ),
      'view' => 
      array (
        'theme' => 
        array (
          'name' => 'EarthLedger',
          'basePath' => '/private/var/www/html/earthledger/themes/EarthLedger',
          'publishResources' => false,
        ),
      ),
    ),
    'cache' => 
    array (
      'class' => 'yii\\caching\\FileCache',
      'keyPrefix' => 'humhub',
    ),
    'view' => 
    array (
      'theme' => 
      array (
        'name' => 'EarthLedger',
          'basePath' => '/private/var/www/html/earthledger/themes/EarthLedger',
        'publishResources' => false,
      ),
    ),
    'formatter' => 
    array (
      'defaultTimeZone' => 'Pacific/Pago_Pago',
    ),
    'formatterApp' => 
    array (
      'defaultTimeZone' => 'Pacific/Pago_Pago',
      'timeZone' => 'Pacific/Pago_Pago',
    ),
  ),
  'params' => 
  array (
    'installer' => 
    array (
      'db' => 
      array (
        'installer_hostname' => 'localhost',
        'installer_database' => 'earthled_community',
      ),
    ),
    'config_created_at' => 1530853489,
    'horImageScrollOnMobile' => '1',
    'databaseInstalled' => true,
    'installed' => true,
  ),
  'name' => 'Earth Ledger Network',
  'language' => 'en',
  'timeZone' => 'Pacific/Pago_Pago',
); ?>