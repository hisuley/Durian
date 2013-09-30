<?php
/**
 *
 * Item Model
 *
 * @author xstudio
 * @date 13/08/13
 */

class Item
{
    /**
     * db connection
     */
    private $_db;
    
    /**
     * upload file path
     */
    private $_path;

    /**
     * create db connection
     */
    public function __construct()
    {
        $this->_db=Yii::app()->db;
    }
    /**
     * Update Item by delete all then insert data
     *
     * @param data as itemAdd params[data]
     */
    public function activityUpdate($data)
    {
        if($this->activityDelete($data['ItemForm']['Item']['id']))
        {
            if($this->activityAdd($data))
            {
                return TRUE;
            }
        }

        return FALSE;
    }
    /**
     * Delete Item by GroupId
     */
    public function activityDelete($groupId)
    {
        $item=$this->activityQuery($groupId);
        
        $delTable=array(
            'item_section', 'item_attribute', 'item_itinerary', 'item_price', 'item_attachment'    
        );
        
        for($i=0; $i<count($item); $i++)
        {
            for($j=0; $j<count($delTable); $j++)
            {
                if($this->_db->createCommand()->delete($delTable[$j], 'item_id=:id', array(':id'=>$item[$i]['id']))===FALSE)
                    return FALSE;;
            }
        }

        if($this->_db->createCommand()->delete('item', 'group_id=:id', array(':id'=>$groupId))===FALSE)
            return FALSE;

        return TRUE;
    }

    /**
     * validate itemForm's value null or not
     */
    public function validateParams($item)
    {
        foreach($item as $key=>$value)
        {
            switch($key)
            {
                case 'Item':
                    if(($temp=$this->arrayNotNull($value, 'id'))!==TRUE)
                        return $key.'.'.$temp;
                    break;
                case 'ItemSection':
                    for($i=0; $i<count($value); $i++)
                    {
                        if(($temp=$this->arrayNotNull($value[$i]))!==TRUE)
                            return $key.'.'.$i.'.'.$temp;
                    }
                    break;
                case 'ItemAttribute':
                    for($i=0; $i<count($value); $i++)
                    {
                        if(($temp=$this->arrayNotNull($value[$i]))!==TRUE)
                            return $key.'.'.$i.'.'.$temp;
                    }
                    break;
                case 'ItemItinerary':
                    for($i=0; $i<count($value); $i++)
                    {
                        if(($temp=$this->arrayNotNull($value[$i]))!==TRUE)
                            return $key.'.'.$i.'.'.$temp;
                    }
                    break;
                case 'ItemAttachment':
                    for($i=0; $i<count($value); $i++)
                    {
                        if(($temp=$this->arrayNotNull($value[$i]))!==TRUE)
                            return $key.'.'.$i.'.'.$temp;
                    }
                case 'Policy':
                    for($i=0; $i<count($value); $i++)
                    {
                        foreach($value[$i] as $k=>$v)
                        {
                            switch($k)
                            {
                                case 'ItemItinerary':
                                    if(($temp=$this->arrayNotNull($v))!==TRUE)
                                        return $key.'.'.$i.'.'.$k.'.'.$temp;
                                    break;
                                case 'ItemPrice':
                                    for($j=0; $j<count($v); $j++)
                                    {
                                        if(($temp=$this->arrayNotNull($v[$j]))!==TRUE)
                                            return $key.'.'.$i.'.'.$k.'.'.$j.'.'.$temp;
                                    }
                                    break;
                                case 'ItemSection':
                                    for($j=0; $j<count($v); $j++)
                                    {
                                        if(($temp=$this->arrayNotNull($v[$j]))!==TRUE)
                                            return $key.'.'.$i.'.'.$k.'.'.$j.'.'.$temp;
                                    }
                                    break;
                                case 'ItemAttribute':
                                    for($j=0; $j<count($v); $j++)
                                    {
                                        $temp=$this->arrayNotNull($v[$j]);

                                        if((count($v[$j])!=2) || ($temp!==TRUE))
                                            return $key.'.'.$i.'.'.$k.'.'.$j.'.'.$temp;
                                    }
                                    break;
                                case 'begintime':
                                case 'endtime':
                                    if(($temp=$this->arrayNotNull($v))!==TRUE)
                                            return $key.'.'.$i.'.'.$k.'.'.$temp;
                                    break;
                            }
                        }
                    }

            }
        }

        return TRUE;
    }
    
    
    /**
     * Activity Add
     *
     * $data=Array
        (
            [ItemForm] => Array
                (
                    [Item] => Array
                        (
                            [type] => activity
                            [id] => 
                            [name] => 泰国一日游
                            [pre_book] => 5
                            [language] => English
                        )

                    [ItemAttribute] => Array
                        (
                            [0] => Array
                                (
                                    [attr_id] => 1
                                    [value] => 24
                                )

                            [1] => Array
                                (
                                    [attr_id] => 2
                                    [value] => 25
                                )

                            [2] => Array
                                (
                                    [attr_id] => 3
                                    [value] => 1
                                )

                            [3] => Array
                                (
                                    [attr_id] => 4
                                    [value] => beijing
                                )

                            [4] => Array
                                (
                                    [attr_id] => 5
                                    [value] => 0
                                )

                        )

                    [Policy] => Array
                        (
                            [0] => Array
                                (
                                    [ItemAttribute] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [attr_id] => 6
                                                    [value] => vip
                                                )

                                            [1] => Array
                                                (
                                                    [attr_id] => 7
                                                    [value] => English
                                                )

                                            [2] => Array
                                                (
                                                    [attr_id] => 8
                                                    [value] => 6
                                                )

                                        )

                                    [ItemItinerary] => Array
                                        (
                                            [0] => 
                                        )

                                    [ItemPrice] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [type] => adult
                                                    [amt_type] => amount
                                                    [min] => 1
                                                    [max] => 99
                                                    [custom] => 2123
                                                    [industrial] => 1213
                                                )

                                            [1] => Array
                                                (
                                                    [type] => children
                                                    [amt_type] => age
                                                    [min] => 2
                                                    [max] => 8
                                                    [custom] => 343
                                                    [industrial] => 334
                                                )

                                        )

                                )

                        )

                    [ItemSection] => Array
                        (
                            [0] => Array
                                (
                                    [name] => Included
                                )

                            [1] => Array
                                (
                                    [name] => No_itncluded
                                )

                            [2] => Array
                                (
                                    [name] => Feature
                                )

                            [3] => Array
                                (
                                    [name] => Notes
                                )

                        )

                    [ItemItinerary] => Array
                        (
                            [0] => Array
                                (
                                    [title] => d1
                                    [traffic] => a
                                    [food] => aa
                                    [content] => value
                                )

                        )

                    [ItemAttachment] => Array
                        (
                            [0] => Array
                                (
                                    [type] => pictrue
                                    [title] => 图片
                                    [desc] => 描述1
                                )

                            [1] => Array
                                (
                                    [type] => attributes
                                    [title] => 附件
                                    [desc] => 描述2
                                )

                        )

                )

        )

     */
    public function activityAdd($data=array())
    {
        $file_is_upload=FALSE;
		
        $fileName=array();
        
        $this->saveGroupId();

        $group_id=Yii::app()->db->getLastInsertID();

        for($k=0; $k<count($data['ItemForm']['Policy']); $k++)
        {
            //save Item
            $this->saveItem($data['ItemForm']['Item'], $group_id);

            $item_id=Yii::app()->db->getLastInsertID();
            
            //save public Attribute
            $this->saveAttribute($data['ItemForm']['ItemAttribute'], $item_id);
            
			foreach($data['ItemForm']['Policy'][$k] as $key=>$value)
			{
				switch($key)
				{
					case 'ItemAttribute':
						$this->saveAttribute($value, $item_id);
						break;
					case 'ItemPrice':
						$this->savePrice($value, $item_id);
						break;
					case 'ItemSection':
						$this->saveSection($value, $item_id);
						break;
					default:
						break;
				}
			}

            //sava section
            $this->saveSection($_POST['ItemForm']['ItemSection'], $item_id);

            //save itinerary
            $this->saveItinerary($_POST['ItemForm']['ItemItinerary'], $_POST['ItemForm']['Policy'][$k]['ItemItinerary'], $item_id);
            
			if($file_is_upload===FALSE)
            {
                if(($fileName=$this->uploadFile('file'))!==FALSE)
                    $file_is_upload=TRUE;
            }
            //save attachment

            $this->saveAttachment($_POST['ItemForm']['ItemAttachment'], $fileName, $item_id);
        }
        return TRUE;
            
    }

    /**
     * Query Activity by GroupId
     * @param int $groupId
     */
    public function activityQuery($groupId)
    {
        $data=array();

        //set public Item
        $item_group=$this->itemQuery($groupId);
        $this->setFormItem($data, $item_group);
        
        //set public Section
        $section=$this->publicQueryByItemId($item_group[0]['id'], 'item_section');
        $this->setFormSection($data, $section);

        //set public Attachment       
        $attachment=$this->publicQueryByItemId($item_group[0]['id'], 'item_attachment');
        $this->setFormAttachment($data, $attachment);

        //set public Itinerary       
        $itin=$this->publicQueryByItemId($item_group[0]['id'], 'item_itinerary');
        $this->setFormItin($data, $itin);

        //set public Attribute
        $attr=$this->publicQueryByItemId($item_group[0]['id'], 'item_attribute');
        $this->setFormAttr($data, $attr);

        $policy=array();

        for($i=0; $i<count($item_group); $i++)
        {
            //set itinerary of policy
            $hotel=$this->publicQueryByItemId($item_group[$i]['id'], 'item_itinerary');
            $this->setPolicyHotel($policy[$i], $hotel);

            //set price of policy
            $price=$this->publicQueryByItemId($item_group[$i]['id'], 'item_price');
            $this->setPolicyPrice($policy[$i], $price);

            //set attribute of policy
            $attrOfPolicy=$this->publicQueryByItemId($item_group[$i]['id'], 'item_attribute');
            $this->setPolicyAttr($policy[$i], $attrOfPolicy);

			//set section of policy
			$sectionOfPolicy=$this->publicQueryByItemId($item_group[$i]['id'], 'item_section');
			$this->setPolicySection($policy[$i], $sectionOfPolicy);

        }

        $data['ItemForm']['Policy']=$policy;

        return $data;
    }

    private function saveGroupId()
    {
        return $this->_db->createCommand()->insert('group_id', array( 
            'id'=>NULL   
        ));
    }

	private function setPolicySection(&$policy, $sectionOfPolicy)
	{
		for($i=0; $i<count($sectionOfPolicy); $i++)	
		{
			if($sectionOfPolicy[$i]['name']=='Included' || $sectionOfPolicy[$i]['name']=='Not-included')
			{
				$policy['ItemSection'][$i]['name']=$sectionOfPolicy[$i]['name'];
				$policy['ItemSection'][$i]['value']=$sectionOfPolicy[$i]['value'];
			}
		}
	}

    private function setPolicyAttr(&$policy, $attrOfPolicy)
    {
        for($i=0, $j=0; $i<count($attrOfPolicy); $i++)
        {
            if($attrOfPolicy[$i]['attr_id']==6 || $attrOfPolicy[$i]['attr_id']==7 || $attrOfPolicy[$i]['attr_id']==8 || $attrOfPolicy[$i]['attr_id']==9 || $attrOfPolicy[$i]['attr_id']==10)
            {
                $name=$this->_db->createCommand()
                    ->select('name')
                    ->from('attributes')
                    ->where('id=:attr_id', array(':attr_id'=>$attrOfPolicy[$i]['attr_id']))
                    ->queryRow();
                
				$policy['ItemAttribute'][$j]['attr_id']=$attrOfPolicy[$i]['attr_id'];
                $policy['ItemAttribute'][$j]['value']=$attrOfPolicy[$i]['value'];
                $policy['ItemAttribute'][$j]['name']=$name['name'];

				$j++;
            }
        }
    }

    private function setPolicyPrice(&$policy, $price)
    {
        for($i=0; $i<count($price); $i++)
        {
            array_shift($price[$i]);
            array_shift($price[$i]);

            $policy['ItemPrice'][$i]=$price[$i];
        }
    }

    private function setPolicyHotel(&$policy, $hotel)
    {
        for($i=0; $i<count($hotel); $i++)
        {
            $policy['ItemItinerary'][$i]=$hotel[$i]['hotel'];
        }
    }

    private function setFormAttr(&$data, $attr)
    {
        for($i=0; $i<count($attr); $i++)
        {
            if($attr[$i]['attr_id']>=1 && $attr[$i]['attr_id']<=5 || $attr[$i]['attr_id']==11)
            {
                $name=$this->_db->createCommand()
                    ->select('name')
                    ->from('attributes')
                    ->where('id=:attr_id', array(':attr_id'=>$attr[$i]['attr_id']))
                    ->queryRow();

                $data['ItemForm']['ItemAttribute'][$i]['attr_id']=$attr[$i]['attr_id'];
                $data['ItemForm']['ItemAttribute'][$i]['value']=$attr[$i]['value'];
                $data['ItemForm']['ItemAttribute'][$i]['name']=$name['name'];
            }
        }
    }
    private function setFormItin(&$data, $itin)
    {
        for($i=0; $i<count($itin); $i++)
        {
            $data['ItemForm']['ItemItinerary'][$i]['traffic']=$itin[$i]['traffic'];
            $data['ItemForm']['ItemItinerary'][$i]['title']=$itin[$i]['title'];
            $data['ItemForm']['ItemItinerary'][$i]['food']=$itin[$i]['food'];
            $data['ItemForm']['ItemItinerary'][$i]['content']=$itin[$i]['content'];
            $data['ItemForm']['ItemItinerary'][$i]['day']=$itin[$i]['day'];
        }
    }
    private function setFormAttachment(&$data, $attachment)
    {
        for($i=0; $i<count($attachment); $i++)
        {
            $data['ItemForm']['ItemAttachment'][$i]['type']=$attachment[$i]['type'];
            $data['ItemForm']['ItemAttachment'][$i]['title']=$attachment[$i]['title'];
            $data['ItemForm']['ItemAttachment'][$i]['desc']=$attachment[$i]['desc'];
            $data['ItemForm']['ItemAttachment'][$i]['path']=$attachment[$i]['path'];
        }
    }
    private function setFormSection(&$data, $section)
    {
        for($i=0; $i<count($section); $i++)
        {
			if($section[$i]['name']!='Included' && $section[$i]['name']!='Not-included')
			{
            	$data['ItemForm']['ItemSection'][$i]['name']=$section[$i]['name'];
	            $data['ItemForm']['ItemSection'][$i]['value']=$section[$i]['value'];
			}
        }
    }

    private function setFormItem(&$data, $item)
    {
        $data=array();
        $data['ItemForm']['Item']['type']=$item[0]['type'];
        $data['ItemForm']['Item']['name']=$item[0]['name'];
        $data['ItemForm']['Item']['pre_book']=$item[0]['pre_book'];
        $data['ItemForm']['Item']['language']=$item[0]['language'];

        return $data;
    }
    
    private function publicQueryByItemId($item_id, $from)
    {
        return $this->_db->createCommand()
                ->select('*')
                ->from($from)
                ->where('item_id=:item_id', array(':item_id'=>$item_id))
                ->queryAll();
    }

    private function itemQuery($groupId)
    {
        return $this->_db->createCommand()
                ->select('*')
                ->from('item')
                ->where('group_id=:groupId', array(':groupId'=>$groupId))
                ->queryAll();
    
    }

    private function saveAttachment($attach=array(), $fileName, $item_id)
    {    
		//controll array attach and array fileName 	
		$i=0;

        foreach($attach as $value)
        {
            if(!($this->_db->createCommand()->insert('item_attachment', array(
                'item_id'=>$item_id,
                'path'=>$this->_path.$fileName[$i++],
                'type'=>$value['type'],
                'desc'=>$value['desc'],
                'title'=>$value['title'],
            )))) return FALSE;

        }

        return TRUE;
    }

    private function uploadFile($name)
    {
        Yii::import('ext.file.FileUpload');

        $u=new FileUpload();
        
        $this->_path=Yii::getPathOfAlias('webroot').'/files/'.date('Ymd', time()).'/';

        $u->set('path', $this->_path);

        if($u->upload($name))
            return $u->getFileName();
        else 
            return FALSE;
    }

    private function saveItinerary($itin, $hotel, $item_id)
    {
        for($i=0; $i<count($hotel); $i++)
        {
            if(!($this->_db->createCommand()->insert('item_itinerary', array(
                'item_id'=>$item_id,
                'title'=>$itin[$i]['title'],
                'day'=>$i+1,
                'hotel'=>$hotel[$i],
                'food'=>$itin[$i]['food'],
                'traffic'=>$itin[$i]['traffic'],
                'content'=>$itin[$i]['content']
            )))) return FALSE;
        }

        return TRUE;
    }

    private function saveSection($section=array(), $item_id)
    {
        for($i=0; $i<count($section); $i++)
        {
            if(!($this->_db->createCommand()->insert('item_section', array(
                'item_id'=>$item_id,
                'name'=>$section[$i]['name'],
                'value'=>$section[$i]['value']
            )))) return FALSE;
        }

        return TRUE;
    }
    private function saveItem($item=array(), $group_id)
    {
        return $this->_db->createCommand()->insert('item', array(
            'name'=>$item['name'],
            'vendor_id'=>10000,
            'type'=>$item['type'],
            'language'=>$item['language'],
            'pre_book'=>$item['pre_book'],
            'group_id'=>$group_id,
            'sn'=>'10000010',
            'is_on_sale'=>1,
        ));
    }
    private function savePrice($price=array(), $item_id)
    {
        for($i=0; $i<count($price); $i++)
        {
            if(!$this->_db->createCommand()->insert('item_price', array(
                'item_id'=>$item_id,
                'type'=>$price[$i]['type'],
                'amt_type'=>$price[$i]['amt_type'],
                'min'=>$price[$i]['min'],
                'max'=>$price[$i]['max'],
                'customer'=>$price[$i]['customer'],
                'industrial'=>$price[$i]['industrial'],
            ))) return FALSE;   
        }

        return TRUE;
    }
    private function saveAttribute($attr=array(), $item_id)
    {
        for($i=0; $i<count($attr); $i++)
        {
            if(!$this->_db->createCommand()->insert('item_attribute', array(
                'item_id'=>$item_id,
                'attr_id'=>$attr[$i]['attr_id'],
                'value'=>$attr[$i]['value'],
            ))) return FALSE;   
        }
		
        return TRUE;
    }

    private function arrayNotNull($value, $except='')
    {
        if(is_array($value))
        {
            foreach($value as $k=>$v)
            {
                if($v=='' && $k!==$except)
                    return $k;
            }           
        }
        else
        {
            if($value=='')
                    return $value;
        }

        return TRUE;
    }
}
