<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Ecom1\Controller\Ecom1' => 'Ecom1\Controller\Ecom1Controller',
        ),
    ),

    'router' => array(
        'routes' => array(
            'ecom1' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/ecom1[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Ecom1\Controller\Ecom1',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'router' => array(
        'routes' => array(
            'ecom1' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/ecom1[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Ecom1\Controller\Ecom1',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'ecom1' => __DIR__ . '/../view',
        ),
    ),
);
?>