<?php
/**
 * @project: trunk
 * @file: GlobalHelper.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-6
 * @time: 下午6:57
 * @version: 1.0
 */


class GlobalHelper extends CComponent{

    public static function getThumbnail($path, $size = 0, $type = 'auto'){

        if(!empty($path)){
            if($size != 0){
                $fullPath = Yii::getPathOfAlias('webroot')."/upload/".$path;
                if(file_exists($fullPath)){
                    $ext = pathinfo($fullPath, PATHINFO_EXTENSION);
                    $fileName = pathinfo($fullPath, PATHINFO_BASENAME);
                    $thumbnailPath = $fullPath."_thumb_".intval($size).".".$ext;
                    if(!file_exists($thumbnailPath)){
                        if($type == 'auto'){
                            $thumbnail = Yii::app()->simpleImage->load($fullPath);
                            if(!empty($thumbnail->image)){
                                $originWidth = $thumbnail->getWidth();
                                $originHeight = $thumbnail->getHeight();
                                if($originHeight > $originWidth){
                                    $thumbnail->resizeToHeight($size);
                                }else{
                                    $thumbnail->resizeToWidth($size);
                                }
                                $thumbnail->save($thumbnailPath);
                            }

                        }elseif($type == 'width'){
                            $thumbnail = Yii::app()->simpleImage->load($fullPath);
                            if(!empty($thumbnail->image)){
                                $thumbnail->resizeToWidth($size);
                                $thumbnail->save($thumbnailPath);
                            }

                        }elseif($type == 'height'){

                            $thumbnail = Yii::app()->simpleImage->load($fullPath);
                            if(!empty($thumbnail->image)){
                                $thumbnail->resizeToHeight($size);
                                $thumbnail->save($thumbnailPath);
                            }

                        }
                        if(!file_exists($thumbnailPath)){
                            return '';
                        }
                    }else{
                        return Yii::app()->request->hostInfo.Yii::app()->request->baseUrl."/upload/".$path."_thumb_".intval($size).".".$ext;
                    }

                }else{
                   return '';
                }

            }else{
                return false;
            }



        }else{
            return false;
        }
    }
}