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
                    'route'    => '/ecom1[/][:action][/][:action][/:id]',
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
            
            'fetch' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/ecom1/fetch[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Ecom1\Controller\Ecom1',
                        'action'     => 'fetch', // update default action to 'fetch'
                    ),
                ),
            ),
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'Order\Model\OrderTableGateway' => function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new \Ecom1\Model\Order());
                return new \Zend\Db\TableGateway\TableGateway('orders', $dbAdapter, null, $resultSetPrototype);
            },
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'ecom1' => __DIR__ . '/../view',
        ),
    ),
);
?>
