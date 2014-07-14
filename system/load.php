<?php
class load 
{
    public function __construct()
    {
        
        $module = isset($_REQUEST['module'])  && $_REQUEST['module'] != null ? $_REQUEST['module'] : "default";
        // $controller = isset($_REQUEST['module'])  && $_REQUEST['controller'] != null ? $_REQUEST['controller'] : "";
        $action = isset($_REQUEST['action'])  && $_REQUEST['action'] != null ? $_REQUEST['action'] : "index";
        // $url = "application/modules/$module/controllers/$controller";
        $url = "application/modules/$module/controllers/sinhvien";
        require("$url.php");
        // echo $url;
        // $obj = new $controller;
        $obj = new sinhvien;
        $obj->$action();
    }
}