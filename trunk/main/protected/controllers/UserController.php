<?php

class UserController extends SBaseController
{
    public function actionAdd()
    {
        echo '用户添加成功';
    }
    public function actionCenter()
    {
        $info=User::model()->find('email=? OR cellphone=?', array(Yii::app()->user->name, Yii::app()->user->name));

        foreach($info as $key=>$value)
        {
            echo $key.'-'.$value.'<br>';
        }
    }

    public function actionUpdate()
    { 
        $_POST['user']=array(
            'password'=>'bbbbbb',
            'nickname'=>'xstudio3',
            'cellphone'=>'3333',
        );

        $_POST['address']=array(
            array(
                'consignee'=>'',
                'email'=>'aa@qq.com',
                'cellphone'=>'',
                'phone'=>'',
                'country'=>'China',
                'province'=>'Beijing',
                'city'=>'Beijing',
                'district'=>'Changping',
                'address'=>'banjieta',
                'zipcode'=>'410220'
            ),
            array(
                'consignee'=>'aa',
                'email'=>'bb@qq.com',
                'cellphone'=>'13131',
                'phone'=>'11',
                'country'=>'Us',
                'province'=>'Chikago',
                'city'=>'Chikago',
                'district'=>'',
                'address'=>'',
                'zipcode'=>'110220'
            ),
        );

        if(isset($_POST['user']))
        {
            $user=new User;

            $user->scenario='update'; 
            $user->attributes=$_POST['user'];
            
            if($user->validate())
            {
                if(empty($user->password))
                    $user->updateAgainstPwd();
                else
                    $user->updatePersonal();
            }
            else
            {
                var_dump($user->getErrors());
                return;
            }
            
        
        }

        if(isset($_POST['address']))
        {
            $u=User::model()->find('email=? OR cellphone=?', array(Yii::app()->user->name, Yii::app()->user->name));
            $is_updated=FALSE;

            foreach($_POST['address'] as $k=>$v)
            {
                $address=new Address;

                //id exisits update otherwise insert
                if(array_key_exists('id', $v))
                {
                    $address->attributes=$v;
                    if($address->validate() && $address->updateAddress($v['id']))
                    {
                        
                    }
                    else
                    {
                        var_dump($user->getErrors());
                        return;
                    }
                      
                }
                else
                {
                    $address->setAddressAttrs($v, $u['id']);
                    if($address->validate() && $address->save())
                    {
                        if(!$is_updated && !$u['address_id'])
                        {
                            User::model()->updateAll(array(
                                'address_id'=>$address->id
                            ), 'email=? OR cellphone=?', array(Yii::app()->user->name, Yii::app()->user->name));

                            $is_updated=TRUE;
                        }               

                    }
                }
            }

        }
    }
}
