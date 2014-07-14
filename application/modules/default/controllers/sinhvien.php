<?php
class sinhvien extends MY_Controller{
    protected $_error = array();
    public function __construct()
    {
       $this->loadModel("sinhvien_model");
    }
    public function index()
    {
        // echo "run action()";
        // $this->loadLibrary("pagination");
        $limit = 5;
        $page = isset($_GET['pg']) && $_GET['pg'] != "" ? $_GET['pg'] : 1;
        $data = $this->model->listSinhvien();
        $totalElement = count($data);
        $totalPage = ceil($totalElement/$limit);
        $clean_data = array_values($data);
        $start = ($page-1)*$limit;
        $chunk = array();
        for ($i= $start; ($i < $start + 5) && ($i < $totalElement); $i++) { 
            # code...
            $chunk[] = $clean_data[$i];
        }
        
        $this->loadView("sinhvien/listsinhvien",$chunk);
        echo "<br/>Trang: ";
        for($j = 1; $j <= $totalPage; $j ++){
            echo "<a href = index.php?module=default&controller=sinhvien&action=index&pg=" . $j . "> ". $j."  </a>";
        }
        
    }
    public function insert()
    {
        $params = $_REQUEST;
        /*echo "<pre>";
        print_r($params);*/
        $sinhvienInsert = array();
        $duplicateEmail = false;
        if(isset($_POST['btnok'])){
            if($this->checkData($params)){
                $sinhvienInsert = array(
                                "name"=>$params['txtname'],
                                "email"=>$params['txtemail'],
                                "address"=>$params['txtaddress'],
                                "phone"=>$params['txtphone'],
                                "gender"=>$params['gender'],
                                "country"=>$params['txtcountry']
                              );
                foreach ($this->model->listSinhvien() as $key => $value) {
                    # code...
                    if ($sinhvienInsert['email'] == $value['email']){
                        $this->_error['errorEmail'] = "Email da ton tai, vui longf nhap email khac";
                        // return false;
                        $duplicateEmail = true;
                    }
                } // end foreach

                // echo "<pre>";
                // print_r($sinhvienInsert);
                if (!$duplicateEmail){
                    $this->model->insertSinhvien($sinhvienInsert);
                    header("location:index.php?module=default&controller=sinhvien&action=index");
                }
                
            }
        }      
        $data = $this->_error;  
        $data['title'] = "Them sinhvien";
        $data['user_input'] = $sinhvienInsert;
        // echo "<pre>";
        // print_r($data['user_input']);
        $this->loadView("sinhvien/insertsinhvien",$data);
    }
    
    public function delete()
    {
        $id = $_GET['id'];
        $this->model->deleteSinhvien($id);
        header("location:index.php?module=default&controller=sinhvien&action=index");
    }

    public function update(){
        $params = $_REQUEST;
        $id = $params['id'];
        $duplicateEmail = false;
        if(isset($_POST['btnok'])){
            if($this->checkData($params)){
                $sinhvienUpdate = array(
                                "name"=>$params['txtname'],
                                "email"=>$params['txtemail'],
                                "address"=>$params['txtaddress'],
                                "phone"=>$params['txtphone'],
                                "gender"=>$params['gender'],
                                "country"=>$params['txtcountry']
                              );

                foreach ($this->model->listSinhvien() as $key => $value) {
                    # code...
                    if ($sinhvienUpdate['email'] == $value['email'] && $id !=$value['id'] ){
                        
                        $this->_error['errorEmail'] = "Email da ton tai, vui long nhap email khac";
                        // return false;
                        $duplicateEmail = true;
                    }
                } // end foreach
                // echo "mang userUpdate <pre>";
                // print_r($userUpdate);
                 if (!$duplicateEmail){
                    $this->model->updateSinhvien($sinhvienUpdate,$id);
                    header("location:index.php?module=default&controller=sinhvien&action=index");
                 }
                
            }
        }      
        
        $data = $this->_error;  
        $data['title'] = "update sinh vien";

        $data['cur_data'] = $this->model->detailSinhvien($id);
        /*echo "<pre>";
        print_r($data);*/

        $this->loadView("sinhvien/updatesinhvien",$data);
    }

    private function checkData($params){
        $flag = true;
        if(!isset($params['txtname']) || $params['txtname'] == ""){
            $this->_error['errorName'] = "Vui long nhap ten user"; 
            $flag = false;
        }

        if(!isset($params['txtemail']) || $params['txtemail'] == ""){
            $this->_error['errorEmail'] = "Vui long nhap email"; 
            $flag = false;
        }

        if(!isset($params['txtaddress']) || $params['txtaddress'] == ""){
            $this->_error['errorAddress'] = "Vui long nhap dia chi"; 
            $flag = false;
        }

        if(!isset($params['txtphone']) || $params['txtphone'] == ""){
            $this->_error['errorPhone'] = "Vui long nhap SDT"; 
            $flag = false;
        }

        if(!isset($params['gender']) || $params['gender'] == ""){
            $this->_error['errorGender'] = "Vui long chon gioi tinh"; 
            $flag = false;
        }

        if(!isset($params['txtcountry']) || $params['txtcountry'] == ""){
            $this->_error['errorCountry'] = "Vui long nhap quoc gia"; 
            $flag = false;
        }
        return $flag;
    } // end method check Data
} // end class MY_controller