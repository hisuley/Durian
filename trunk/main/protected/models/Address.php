<?php

/**
 * This is the model for table 'address'.
 *
 * @author xstudio
 * @version 1.0
 * @date 08/28/13
 */
class Address extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'address';
    }

    public function rules()
    {
        return array(
            array('consignee, email, cellphone, phone, country, province, city, district, address, zipcode, user_id', 'safe'),
            array('email', 'email'),
        );
    }
    /**
     * set attributes on address insert
     * @param array $address=$_POST['user']['address']
     * @param int $user_id to user insertID
     */
    public function setAddressAttrs($address, $user_id)
    {
        $this->attributes=$address;
        $this->user_id=$user_id;

    }
    /**
     * update user default address info.
     * @param integer $address_id
     * @return boolean
     */
    public function updateAddress($address_id)
    {
        return $this->updateAll(array(
            'consignee'=>$this->consignee,
            'email'=>$this->email,
            'cellphone'=>$this->cellphone,
            'phone'=>$this->phone,
            'country'=>$this->country,
            'province'=>$this->province,
            'city'=>$this->city,
            'district'=>$this->district,
            'address'=>$this->address,
            'zipcode'=>$this->zipcode
        ), 'id=?', array($address_id));
    }
}
