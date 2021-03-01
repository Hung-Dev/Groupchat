<?php

namespace App\Reponsitories;

abstract class AbstracRiponsitory{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }
    abstract public function getModel();
    public function getLists(){
        return $this->model->get();
    }


}