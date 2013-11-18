<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OrderHelper extends CWidget{
    public static function findAttr($attrName = '', $attributes, $return = 'value'){
        if(!empty($attrName)){
            foreach($attributes as $attribute){
                if($attribute->attr_name == $attrName){
                    return $attribute->$return;
                }
            }
        }
        return '';
    }
    public static function findMaterial($attributes){
        $result = self::findAttr('material', $attributes);
        return $result;
    }
    public function review($progress = 0, $params){
        if(isset($progress)){
            $this->render('review', array('progress'=>$progress, 'params'=>$params));
        }
    }
}