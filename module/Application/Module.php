<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Db\ResultSet\FabResultSet;
use Application\Model\QuestionTable;
use Application\Service\QuestionFab;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Module implements ServiceProviderInterface {
    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
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
            'factories' => array(
                'Application\Model\QuestionTable' => function (ServiceLocatorInterface $sm) {
                    /** @var $adapter AdapterInterface */
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $questionMaker = new QuestionFab();
                    $resultSet = new FabResultSet($questionMaker, 'type');
                    $tableGateway = new TableGateway('questions', $adapter, null, $resultSet);
                    $questionTable = new QuestionTable($tableGateway);

                    return $questionTable;
                }
            ),
        );
    }
}
