<?php
class load 
{
    public function __construct()
    {
        
        $module = isset($_REQUEST['module'])  && $_REQUEST['module'] != null ? $_REQUEST['module'] : "admin";
        $controller = isset($_REQUEST['module'])  && $_REQUEST['controller'] != null ? $_REQUEST['controller'] : "index";
        $action = isset($_REQUEST['action'])  && $_REQUEST['action'] != null ? $_REQUEST['action'] : "index";
        $url = "application/modules/$module/controllers/$controller";
        require("$url.php");
        $obj = new $controller;
        $obj->$action();
    }
}