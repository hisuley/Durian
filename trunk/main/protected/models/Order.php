<?php

/**
 * Order Model
 *
 * @author xstudio
 * @version 1.0
 * @date 15/09/13
 */
class Order
{

    /**
     * Database Connection
     */
    private $_db;
    
    public function __construct()
    {
        $this->_db=Yii::app()->db;
    }

    /**
     * Add to Cart
     * 
     * @param int $item_id
     * @param array $order_info=array(
     *  'cart_plan'=>array(
     *      'duration'=>2,
     *      'start_time'=>121212,
     *      'end_time'=>131312,
     *  ),
     *  'item'=>array(
     *      array(
     *          'cart_item'=>array(
     *              'item_id'=>1,
     *              'item_name'=>'aa',
     *              'item_price'=>13212,
     *              'send_number'=>2,
     *              'item_amount'=>2,
     *              'raw_info'=>'{name:"aaa", age:34}',
     *          ),
     *          'cart_plan_item'=>array(
     *              'start_offset'=>1,
     *              'end_offset'=>2
     *          ),
     *      ),
     *      array(
     *          'cart_item'=>array(
     *              'item_id'=>2,
     *              'item_name'=>'aa',
     *              'item_price'=>13212,
     *              'send_number'=>2,
     *              'item_amount'=>2,
     *              'raw_info'=>'{name:"aaa", age:34}',
     *          ),
     *          'cart_plan_item'=>array(
     *              'start_offset'=>1,
     *              'end_offset'=>2
     *          ),
     *      ),
     *  )
     * )
     * @return bool
     */
    public function addToCart($order_info)
    {
        //1.插入cart_plan表 cart_plan唯一

        $user_id=$this->getUserID();
        $create_time=time();
        
        $order_info['cart_plan']['user_id']=$user_id;
        $order_info['cart_plan']['session_id']=$_COOKIE['PHPSESSID'];
        $order_info['cart_plan']['create_time']=$create_time;

        $this->_db->createCommand()->insert('cart_plan', $order_info['cart_plan']);
        
        $cart_plan_id=$this->_db->getLastInsertID();

        //2.遍历cart_plan_item和cart_item 进行插入
        foreach($order_info['item'] as $key=>$value)
        {
            $value['cart_item']['user_id']=$user_id;
            $value['cart_item']['session_id']=$_COOKIE['PHPSESSID'];
            $value['cart_item']['create_time']=$create_time;
            
            $this->_db->createCommand()->insert('cart_item', $value['cart_item']);

            $value['cart_plan_item']['create_time']=$create_time;
            $value['cart_plan_item']['cart_item_id']=$this->_db->getLastInsertID();
            $value['cart_plan_item']['cart_plan_id']=$cart_plan_id;

            $this->_db->createCommand()->insert('cart_plan_item', $value['cart_plan_item']);
        }

        return TRUE;
        
    }

    /**
     * @param int $id
     * @param array $order_info
     * @return bool
     */
    public function modifyCartItem($id, $order_info)
    {
        $this->_db->createCommand()->update('cart_item', $order_info['cart_item'], 'id=:id', array(':id'=>$id));

        return $this->_db->createCommand()->update('cart_plan_item', $order_info['car_plan_item'], 'cart_item_id=:id', array(':id'=>$id));
    }

    /**
     * @param int $cart_item_id
     * @return bool
     */
    public function removeFromCart($cart_item_id)
    {
        $this->_db->createCommand()->delete('cart_item', 'id=:id', array(':id'=>$cart_item_id));

        return $this->_db->createCommand()->delete('cart_plan_item', 'cart_item_id=:id', array(':id'=>$cart_item_id));
    }

    /**
     * @return bool
     */
    public function removeAllCartItems()
    {
        $this->_db->createCommand()->delete('cart_item', 'user_id=:uid OR session_id=:sid', array(':uid'=>$this->getUserID(), 'sid'=>$_COOKIE['PHPSESSID']));

        $cart_plan=$this->_db->createCommand()->select('id')->from('cart_plan')->where('user_id=:uid OR session_id=:sid', array(':uid'=>$this->getUserID(), 'sid'=>$_COOKIE['PHPSESSID']))->queryRow();

        $this->_db->createCommand()->delete('cart_plan', 'user_id=:uid OR session_id=:sid', array(':uid'=>$this->getUserID(), 'sid'=>$_COOKIE['PHPSESSID']));

        return $this->_db->createCommand()->delete('cart_plan_item', 'cart_plan_id=:cid', array(':cid'=>$cart_plan['id']));
    }

    /**
     * @param &int total_price default 0
     * @return array CartItems
     */
    public function getAllCartItems(&$total_price=0)
    {    
        $result=array();

        //1.根据user_id获取唯一的cart_plan
        $result['cart_plan']=$this->_db->createCommand()->select('*')->from('cart_plan')->where('user_id=:uid OR session_id=:sid', array(':uid'=>$this->getUserID(), ':sid'=>$_COOKIE['PHPSESSID']))->queryRow();

        $cart_item=$this->_db->createCommand()->select('*')->from('cart_item')->where('user_id=:uid OR session_id=:sid', array(':uid'=>$this->getUserID(), ':sid'=>$_COOKIE['PHPSESSID']))->order('id')->queryAll();

        //2.根据cart_plan_id和cart_item_id 获取
        foreach($cart_item as $key=>$value)
        {
            $result['item'][$key]['cart_item']=$value;
            $result['item'][$key]['cart_plan_item']=$this->_db->createCommand()->select('*')->from('cart_plan_item')->where('cart_plan_id=:pid AND cart_item_id=:id', array(':pid'=>$result['cart_plan']['id'], ':id'=>$value['id']))->queryRow();

            $total_price+=$value['item_price'];
        }
        
        return $result;
    }
    
    /**
     * @return int order_number
     */
    public function makeOrder()
    {
        $total_price=0;

        //1.cart_pan转移至order_plan    

        $cart_items=$this->getAllCartItems($total_price);

        $user_id=$cart_items['cart_plan']['user_id'];
        $create_time=time();

        unset($cart_items['cart_plan']['id']);
        unset($cart_items['cart_plan']['user_id']);
        unset($cart_items['cart_plan']['session_id']);

        $cart_items['cart_plan']['create_time']=$create_time;

        $this->_db->createCommand()->insert('order_plan', $cart_items['cart_plan']);
        
        $order_plan_id=$this->_db->getLastInsertID();

        //2.根据order_plan_id生成order_info
        $order_info=array(
            'user_id'=>$user_id,
            'order_status'=>0,
            'pay_status'=>0,
            'confirm_time'=>$create_time,
            'total_price'=>$total_price,
            'create_time'=>$create_time,
            'order_plan_id'=>$order_plan_id,
            'pay_method_id'=>1
        );
        $this->_db->createCommand()->insert('order_info', $order_info);

        $order_info_id=$this->_db->getLastInsertID();
        
        //3.循环插入到order_item order_plan_item
        foreach($cart_items['item'] as $value)
        {
            unset($value['cart_item']['id']);
            unset($value['cart_item']['user_id']);
            unset($value['cart_item']['session_id']);
            unset($value['cart_item']['cart_id']);

            $value['cart_item']['create_time']=$create_time;
            $value['cart_item']['order_info_id']=$order_info_id;
            
            $this->_db->createCommand()->insert('order_item', $value['cart_item']);

            unset($value['cart_plan_item']['id']);
            unset($value['cart_plan_item']['cart_plan_id']);
            unset($value['cart_plan_item']['cart_item_id']);
            
            $value['cart_plan_item']['create_time']=$create_time;
            $value['cart_plan_item']['order_plan_id']=$order_plan_id;
            $value['cart_plan_item']['order_item_id']=$this->_db->getLastInsertID();

            $this->_db->createCommand()->insert('order_plan_item', $value['cart_plan_item']);

        }

        return $this->removeAllCartItems();

    }

    /**
     * @param int $order_id
     * @return array OrderInfo
     */
    public function getOrder($order_id)
    {
        
        $result=array();

        //1.根据order_id获取唯一的order_info order_plan
        $result['order_info']=$this->_db->createCommand()->select('*')->from('order_info')->where('id=:id', array(':id'=>$order_id))->queryRow();

        $result['order_plan']=$this->_db->createCommand()->select('*')->from('order_plan')->where('id=:id', array(':id'=>$result['order_info']['order_plan_id']))->queryRow();

        $order_item=$this->_db->createCommand()->select('*')->from('order_item')->where('order_info_id=:oid', array(':oid'=>$result['order_info']['id']))->queryAll();

        //2.根据order_plan_id order_item_id获取order_plan_item
        foreach($order_item as $key=>$value)
        {
            $result['item'][$key]['order_item']=$value;
            $result['item'][$key]['order_plan_item']=$this->_db->createCommand()->select('*')->from('order_plan_item')->where('order_plan_id=:pid AND order_item_id=:id', array(':pid'=>$result['order_plan']['id'], ':id'=>$value['id']))->queryRow();

        }
        
        return $result;
    }

    /**
     * @return int login uid
     */
    private function getUserID()
    {
        $user=User::model()->find('email=? OR cellphone=?', array(Yii::app()->user->name, Yii::app()->user->name));

        return $user['id'];
    }

    /**
     *
     *
    private function getTotalPrice()
    {
        return $this->_db->createCommand()->select('sum(item_price)')->from('cart_item')->where('')->queryScalar(();
    }*/
}
