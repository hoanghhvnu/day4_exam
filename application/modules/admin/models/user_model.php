<?php
class user_model extends MY_Model
{
    protected $_table = 'tbl_user';
    
    public function listUser()
    {
        return $this->getAll($this->_table);
    }
    public function insertUser($data)
    {
        $this->insert($this->_table,$data);
    }
    public function deleteUser($id)
    {
        $this->setWhere("id = $id");
        $this->delete($this->_table);
    }
}