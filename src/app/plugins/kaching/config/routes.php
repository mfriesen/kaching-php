<?php
Router::connect('/product/*', array('plugin'=>'kaching', 'controller' => 'carts', 'action' => 'product_page'));
Router::connect('/category/*', array('plugin'=>'kaching', 'controller' => 'carts', 'action' => 'category'));  
?>