<?php
class product_model extends MY_Model
{
    protected $table = "tbl_product";
    public function listProduct()
    {
        return $this->getAll($this->table);
    }
    public function detailProduct($id)
    {
        $this->setWhere("pro_id = $id");
        return $this->getOnce($this->table);
    }
}