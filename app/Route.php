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
        $routes['adminLogin']=array(
            'route'=> '/adminLogin',
            'controller'=> 'indexController',
            'action'=> 'adminLogin'
        );
        $routes['verificaDados']=array(
            'route'=> '/admin',
            'controller'=> 'adminController',
            'action'=> 'verifica'
        );
        $routes['adiciona_pergunta']=array(
            'route'=> '/adiciona_perguntas',
            'controller'=> 'indexController',
            'action'=> 'adiciona_perguntas'
        );
        $this->setRoutes($routes);
    }
}