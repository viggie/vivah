<?php
/*
 * ViRouter.php
 * Copyright 2017 Viggie <viggie@viggie.com>
 */

class ViggieRouter {
    
    private $routes = array();
    
    public function route($pattern, $callback) {
        $this->routes[$pattern] = $callback;
    }
    
    public function execute($uri) {
        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $uri, $params) === 1) {
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }
        }
    }
    
}
