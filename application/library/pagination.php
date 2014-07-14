<?php
    protected _limit = "";
    protected _curPage = "";
    protected _total = "";

    function setLimit($value){
        return $this->_limit = $value;
    }

    function getLimit(){
        return $this->_limit;
    }

    function setCurPage($value){
        return $this->_curPage = $value;
    }

    function getCurPage(){
        return $this->_curPage;
    }

    function setTotal($value){
        return $this->_total = $value;
    }

    function getTotal(){
        return $this->_total;
    }

    public function startPoint(){
        return ($this->_curPage - 1) * $this->_limit;
    }