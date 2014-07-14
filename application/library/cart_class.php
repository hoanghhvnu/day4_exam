<?php
class cart_class
{
    public function __construct()
    {
        session_start();
    }
    public function lists()
    {
        return isset($_SESSION['cart']) && $_SESSION['cart'] != null ? $_SESSION['cart'] : array();
    }
    public function insert($data = array())
    {
        if(!isset($_SESSION['cart']) || $_SESSION['cart'] == null ) {
            $keys = $data['pro_id'];
            $data['soluong'] = 1;
            $_SESSION['cart'][$keys] = $data;
        }else{
            if(array_key_exists($data['pro_id'],$_SESSION['cart'])) {
                $_SESSION['cart'][$data['pro_id']]['soluong'] +=1;     
            }else{
                $data['soluong'] = 1;
                $_SESSION['cart'][$data['pro_id']] = $data;
            }  
        }
    }
    public function update($data = array())
    {
        if($data == null ){
            return false;
        }
        foreach($data as $key=>$val)
        {
            if($val <= 0){
                unset($_SESSION['cart'][$key]);
            }else{
                $_SESSION['cart'][$key]['soluong'] = $val;   
            }
        }
    }
    public function delete($id)
    {
        if(isset($_SESSION['cart']) && $_SESSION['cart'] != null ){
            unset($_SESSION['cart'][$id]);
        }
    }
    public function total()
    {
        
    }
}