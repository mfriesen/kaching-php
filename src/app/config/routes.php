<?php
include (APP . 'plugins' . DS . 'kaching' . DS . 'config' . DS . 'routes.php');
Router::connect('/', array('plugin'=>'kaching', 'controller' => 'carts', 'action' => 'category', '1'));
?>