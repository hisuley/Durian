<?php

class PortalMeta extends CActiveRecord{
	public $meta_id, $meta_value, $meta_memo, $create_time;
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	public function tables(){
		return 'portal_meta';
	}
	public function rules(){
		return array(
			array('meta_id, meta_value, meta_memo, create_time', 'safe')
			);
	}
	public function relations(){
		return array(
			'meta'=>array(self::BELONGS_TO, 'PortalMetaList', 'meta_id')
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
	 * @param array $data = array('meta_id'=>'','meta_value'=>'', 'meta_memo'=>'');
	 * @return bool
	 **/
	public function insertNew($data){
		$this->attributes = $data;
		if($this->save())
			return true;
		return false;
	}

}
?>