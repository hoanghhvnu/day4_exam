<?php
class sinhvien extends MY_Controller{
    public function __construct()
    {
       $this->loadModel("sinhvien_model");
    }
    public function index()
    {
        $data['listSinhvien'] = $this->sinh_model->listSinhvien();
        $this->loadView("sinhvien/listsinhvien",$data);
    }
    public function insert()
    {
        $params = $_REQUEST;
        if(isset($_POST['btnok'])){
            if($this->checkData($params)){
                $userInsert = array(
                                "username"=>$params['txtname'],
                                "email"=>$params['txtemail'],
                                "address"=>$params['txtaddress'],
                                "phone"=>$params['txtphone'],
                                "gender"=>$params['gender']
                              );
                $this->model->insertUser($userInsert);
            }
        }      
        $data = $this->_error;  
        $data['title'] = "Them user";
        $this->loadView("user/insertuser",$data);
    }
    
    public function delete()
    {
        $id = $_GET['id'];
        $this->model->deleteUser($id);
        header("location:/smartosc/FRESHER05/day4/admin/user/index");
    }
    private function checkData($params)
    {
        $flag = true;
        if(!isset($params['txtname']) || $params['txtname'] == ""){
            $this->_error['errorName'] = "Vui long nhap ten user"; 
            $flag = false;
        }
        return $flag;
    }
}