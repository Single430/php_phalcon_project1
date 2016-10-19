<?php

use Phalcon\Loader;
use Phalcon\Tag;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;


try {

    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(
        array(
            '../app/controllers/',
            '../app/models/'
        )
    )->register();

    // Create a DI
    $di = new FactoryDefault();

    // 设置数据库服务
    $di->set('db', function () {
        return new DbAdapter(array(
            "host"     => "127.0.0.1",
            "username" => "root",
            "password" => "xxx",
            "dbname"   => "test_store_db"
        ));
    });

    // Setting up the view component
    $di['view'] = function() {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    };

    // Setup a base URI so that all generated URIs include the "store" folder
    $di['url'] = function() {
        $url = new Url();
        $url->setBaseUri('/store/');
        return $url;
    };

    // Setup the tag helpers
    $di['tag'] = function() {
        return new Tag();
    };

    // Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
