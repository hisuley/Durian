<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:08 AM
 */

abstract class PanelOrder extends CActiveRecord{
    protected function beforeSave(){
        return parent::beforeSave();
    }
    abstract public function getPrice();
    abstract public function getStatus();
}