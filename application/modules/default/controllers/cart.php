<?php
class cart extends MY_Controller
{
    public function listCart()
    {
        $this->loadLibrary("cart_class");
        $data['listCart'] = $this->library->lists();
        $this->loadView("cart/list",$data);
    }   
    public function insertCart()
    {   
        $idProduct = $_GET['id'];
        $this->loadModel("product_model");
        $data = $this->model->detailProduct($idProduct);
        $this->loadLibrary("cart_class");
        $this->library->insert($data);   
        header("location:/smartosc/FRESHER05/day4/default/product/index");     
    }
    public function updateCart()
    {
        if(isset($_POST['btnok'])) {
            $arrNumber = $_POST['number'];
            $this->loadLibrary("cart_class");
            $this->library->update($arrNumber);
        }
        header("location:/smartosc/FRESHER05/day4/default/cart/listCart");
    }
    public function deleteCart()
    {
        $id = $_GET['id'];
        $this->loadLibrary("cart_class");
        $this->library->delete($id);
        header("location:/smartosc/FRESHER05/day4/default/cart/listCart");
    }
}