<?php

/**
 * Order Controller
 *
 * @author xstudio
 * @date 16/09/13
 * @version 1.0
 */
class OrderController extends Controller
{

    public function actionCartAdd()
    {
        $order=new Order();
        $order->addToCart(array(
       'cart_plan'=>array(
           'duration'=>2,
           'start_time'=>121212,
           'end_time'=>131312,
       ),
       'item'=>array(
           array(
               'cart_item'=>array(
                   'item_id'=>1,
                   'item_name'=>'aa',
                   'item_price'=>13212,
                   'send_number'=>2,
                   'item_amount'=>2,
                   'raw_info'=>'{name:"aaa", age:34}',
               ),
               'cart_plan_item'=>array(
                   'start_offset'=>1,
                   'end_offset'=>2
               ),
           ),
           array(
               'cart_item'=>array(
                   'item_id'=>2,
                   'item_name'=>'aa',
                   'item_price'=>1412,
                   'send_number'=>2,
                   'item_amount'=>2,
                   'raw_info'=>'{name:"aaa", age:34}',
               ),
               'cart_plan_item'=>array(
                   'start_offset'=>3,
                   'end_offset'=>4
               ),
           ),
       )));
    }

    public function actionCartRemove()
    {
        $order=new Order;
        
        $order->removeFromCart($_GET['id']);
    }

    public function actionCartClear()
    {
        $order=new Order;
        $order->removeAllCartItems();
    }

    public function actionCarts()
    {
        $order=new Order;
        $p=0;
        print_r($order->getAllCartItems($p));

        echo $p;
    }

    public function actionOrderMake()
    {
        $order=new Order;

        $order->makeOrder();

    }

    public function actionOrderInfo()
    {
        $order=new Order;
        print_r($order->getOrder($_GET['id']));
    }


    public function actionPay()
    {
        Yii::import('ext.alipay.*');

        $this->render('index');
    }
}
