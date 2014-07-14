<?php
class product extends MY_Controller
{
    
    public function index()
    {
        $this->loadModel("product_model");
        $data['listProduct'] = $this->model->listProduct();
        $this->loadView("product/listproduct",$data);
    }
}