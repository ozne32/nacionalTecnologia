<?php
namespace app;
use MF\Init\Bootstrap;
class Route extends Bootstrap{
    public function initRoutes(){
        $routes['home']=array(
            'route'=> '/',
            'controller'=> 'indexController',
            'action'=> 'index'
        );
        $routes['planos']=array(
            'route'=> '/pricing',
            'controller'=> 'indexController',
            'action'=> 'planos'
        );
        $routes['contato']=array(
            'route'=> '/contactus',
            'controller'=> 'indexController',
            'action'=> 'contato'
        );
        $routes['sobre_nos']=array(
            'route'=> '/about-us',
            'controller'=> 'indexController',
            'action'=> 'sobre'
        );
        $routes['processa_dados']=array(
            'route'=> '/processa_dados',
            'controller'=> 'indexController',
            'action'=> 'mandaEmail'
        );
        $this->setRoutes($routes);
    }
}