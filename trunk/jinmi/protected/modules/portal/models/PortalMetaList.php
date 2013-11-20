<?php

class PortalMetaList extends CActiveRecord{
	public $id, $name, $description, $default_value, $type, $create_time;
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	public function tables(){
		return 'portal_meta_list';
	}
	public function rules(){
		return array(
			array('name, description, default_value, type,  create_time', 'safe')
			);
	}
	public function relations(){
		return array(
			'value'=>array(self::HAS_MANY, 'PortalMeta', 'meta_id');
			);
	}
	public function beforeSave(){
		if($this->isNewRecord){
			$this->create_time = strtotime('now');
		}
		return true;
	}
	/**
	 * Insert new record
	 * @param array $data = array('id'=>'', 'name'=>'', 'description'=>'', 'default_value'=>'', 'type'=>'')
	 **/
	public function insertNew($data){
		$this->attributes = $data;
		if($this->save())
			return true;
		return false;
	}
}
?>