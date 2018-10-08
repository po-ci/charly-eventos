<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'gestion' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/gestion[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Gestion',
                        'action' => 'abm',
                    ),
                ),
            ),

        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Gestion' => 'Application\Controller\GestionController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
              'ZfcUser/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'Application/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'Application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'widget/widget' => __DIR__ . '/../view/widget/widget.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Dashboard',
                'uri' => '#',
                'icon' => 'fa fa-dashboard fa-fw',
                'resource' => 'rec_usuario',
                'privilege' => 'report',
            ),
            array(
                'label' => 'Lugar',
                'uri' => '/gestion/lugar',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            ),
            array(
                'label' => 'Flyer',
                'uri' => '/gestion/flyer',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            ),
            array(
                'label' => 'Fotos',
                'uri' => '/gestion/fotos',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            ),
            array(
                'label' => 'Info Formato',
                'uri' => '/gestion/formato',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            ),
            array(
                'label' => 'RRPP',
                'uri' => '/gestion/rrpp',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            ),
            array(
                'label' => 'Eventos',
                'uri' => '/gestion/evento',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            )
            ,
            array(
                'label' => 'Invitados',
                'uri' => '/gestion/invitados-grid',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            )
             ,
            array(
                'label' => 'Confirmados',
                'uri' => '/gestion/confirmados',
                'icon' => 'fa fa-database',
                'resource' => 'rec_admin',
                'privilege' => 'abm',
            )
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);
