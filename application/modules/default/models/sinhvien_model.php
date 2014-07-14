<?php
class sinhvien_model extends MY_Model{
    protected $table = "tbl_sinhvien";
    public function listSinhvien()
    {
        return $this->getAll($this->table);
    }
    public function detailSinhvien($id)
    {
        $this->setWhere("id = $id");
        return $this->getOnce($this->table);
    }


    public function insertSinhvien($data)
    {
        $this->insert($this->_table,$data);
    }


    public function deleteSinhvien($id)
    {
        $this->setWhere("id = $id");
        $this->delete($this->_table);
    }

    public function updateSinhvien($data, $id)
    {
        $this->setWhere("id = $id");
        $this->update($this->_table, $data);
    }
}