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
            'privacypolicy' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/privacy-policy',
                    'defaults' => array(
                        'controller' => 'Front\Controller\Frontera',
                        'action' => 'privacy-policy',
                    ),
                ),
            ),
            'eventos' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/eventos/:nombre',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'nombre' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Front\Controller\Frontera',
                        'action' => 'eventos',
                    ),
                ),
            ),
            'confirmar-evento' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/confirmar-evento/:nombre',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'nombre' => '[a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Front\Controller\Frontera',
                        'action' => 'confirmarEvento',
                    ),
                ),
            ),
            'inter' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/inter/:action[/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Front\Controller\Frontera',
                        'action' => 'index',
                    ),
                ),
            ),
            'tt' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/tt/:action/:id',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Front\Controller\Frontera',
                        'action' => 'test',
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
            'Front\Controller\Index' => 'Front\Controller\IndexController',
            'Front\Controller\Frontera' => 'Front\Controller\FronteraController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'Front/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'Front/index/index' => __DIR__ . '/../view/application/index/index.phtml',
//            'error/404' => __DIR__ . '/../view/error/404.phtml',
//            'error/index' => __DIR__ . '/../view/error/index.phtml',
//            'widget/widget' => __DIR__ . '/../view/widget/widget.phtml',
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
        'front' => array(
            array(
                'label' => 'Dashboard',
                'uri' => '#',
                'icon' => 'fa fa-dashboard fa-fw',
                'resource' => 'rec_usuario',
                'privilege' => 'report',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);
