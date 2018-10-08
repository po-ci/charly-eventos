<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Front;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        
            $eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
    $controller = $e->getTarget();
    $controllerClass = get_class($controller);
    $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
    $controller->layout($moduleNamespace . '/layout');
    }, 100);
        
        
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        
         // Add ACL information to the Navigation view helper
        $sm = $e->getApplication()->getServiceManager();
        $authorize = $sm->get('BjyAuthorizeServiceAuthorize');
        $acl = $authorize->getAcl();
        $role = $authorize->getIdentity();
        \Zend\View\Helper\Navigation::setDefaultAcl($acl);
        \Zend\View\Helper\Navigation::setDefaultRole($role);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig() {
        return array(
            'invokables' => array(
//                'gapopulator' => 'Application\Service\GaPopulator',
//                 'fapopulator' => 'Application\Service\FaPopulator',
            ),
     
        );
    }
}
