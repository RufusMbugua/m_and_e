<?php
use Doctrine\Common\ClassLoader,
Doctrine\ORM\Configuration,
Doctrine\ORM\EntityManager,
Doctrine\Common\Cache\ArrayCache;
/**
*
* How to create advanced configurations
* http://docs.doctrine-project.org/en/2.0.x/reference/configuration.html
*
**/
class Doctrine {

  public $em = null;

  public function __construct()
  {

    if (!defined('APPPATH')){
      define('APPPATH', 'application/');
    }
    // load database configuration from CodeIgniter
    require APPPATH.'config/database.php';

    $doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'libraries');
    $doctrineClassLoader->register();
    $entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/" ));
    $entitiesClassLoader->register();
    $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
    $proxiesClassLoader->register();

    //Set up caches
    $config = new Configuration;
    $cache = new ArrayCache;
    $config->setMetadataCacheImpl($cache);
    $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
    $config->setMetadataDriverImpl($driverImpl);
    $config->setQueryCacheImpl($cache);

    // Proxy configuration
    // Sets the directory where Doctrine generates any necessary proxy class files.
    $config->setProxyDir(APPPATH.'/models/proxies');
    $config->setProxyNamespace('Proxies');



    $config->setAutoGenerateProxyClasses( TRUE );

    // Database connection information

    $connectionOptions = array(
      'driver' =>  'pdo_mysql',
      'user' =>     $db['default']['username'],
      'password' => $db['default']['password'],
      'host' =>     $db['default']['hostname'],
      'dbname' =>   $db['default']['database']
    );

    // Create EntityManager
    $this->em = EntityManager::create($connectionOptions, $config);
  }
}
