<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('server_homepage', new Route('/', array(
    '_controller' => 'ServerBundle:Default:index',
)));

$collection->add('server_cadastro', new Route('/cadastro', array(
    '_controller' => 'ServerBundle:Default:cadastro',
)));

$collection->add('server_delete', new Route('/delete', array(
    '_controller' => 'ServerBundle:Default:delete',
)));

$collection->add('server_login', new Route('/login', array(
    '_controller' => 'ServerBundle:Default:login',
)));

$collection->add('server_usuarios', new Route('/usuarios', array(
    '_controller' => 'ServerBundle:Default:usuarios',
)));


$collection->add('server_contato', new Route('/contato', array(
    '_controller' => 'ServerBundle:Default:contato',
)));

return $collection;
