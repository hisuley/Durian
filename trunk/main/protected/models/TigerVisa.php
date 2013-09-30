<?php

/**
 *
 * 签证对接
 *
 * @author xstudio
 * @version 1.0
 * @date 2013.08.05
 *
 */
class TigerVisa
{
    private $config = array(
		'partner' => 'HZ10000044',
		'key' => '2029537a83144db0bd5359b6d4dd1074',
		'url' => 'http://www.hzvisa.com/huize',
		'default_params' => array(
			'service_version' => '1.0',
			'partner' => 'HZ10000044',
			'user_ip' => "192.168.1.1"
		)
    );
    private function getSign($params)
    {
        $tempParams='';

        ksort($params);
        foreach($params as $key=>$val)
        {
            $tempParams.=$key.'='.$val.'&';
        }
        //echo $tempParams.'key='.$this->config['key'];
        return strtoupper(md5($tempParams.'key='.$this->config['key']));
    }
    private function setParams($p=array())
    {
        $params=$this->config['default_params'];
        $params['user_ip']=$_SERVER['REMOTE_ADDR'];

        if(!empty($p))
        {
            foreach($p as $key=>$val)
            {
                $params[$key]=$val;
            }
        }
        
        $params['sign']=$this->getSign($params);

        return $params;
    }
    private function xmlstr_to_array($xmlstr) 
    {
	  $doc = new DOMDocument();
	  $doc->loadXML($xmlstr);
	  return $this->domnode_to_array($doc->documentElement);
	}
    private function domnode_to_array($node) 
    {
	  $output = array();
	  switch ($node->nodeType) {
	   case XML_CDATA_SECTION_NODE:
	   case XML_TEXT_NODE:
	    $output = trim($node->textContent);
	   break;
	   case XML_ELEMENT_NODE:
	    for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) { 
	     $child = $node->childNodes->item($i);
	     $v = $this->domnode_to_array($child);
	     if(isset($child->tagName)) {
	       $t = $child->tagName;
	       if(!isset($output[$t])) {
	        $output[$t] = array();
	       }
	       $output[$t][] = $v;
	     }
	     elseif($v) {
	      $output = (string) urldecode($v);
	     }
	    }
	    if(is_array($output)) {
	     if($node->attributes->length) {
	      $a = array();
	      foreach($node->attributes as $attrName => $attrNode) {
	       $a[$attrName] = (string) $attrNode->value;
	      }
	      $output['@attributes'] = $a;
	     }
	     foreach ($output as $t => $v) {
	      if(is_array($v) && count($v)==1 && $t!='@attributes') {
	       $output[$t] = $v[0];
	      }
	     }
	    }
	   break;
	  }
	  return $output;
    }
    private function getResponseArr($url, $params)
    {
        $result=Yii::app()->curl->post($url, $params);
        $result = str_replace('encoding=""', 'encoding="utf-8"', $result);
        
        return $this->xmlstr_to_array($result); 
    }
    /**
     *
     * 签证在线提供所有签证国家的洲列表
     */
    public function getContinentList()
    {
        $params=$this->setParams();
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetContinentList', $params);
    }

    /**
     *
     * 根据洲标识查询对应的国家列表，洲标识由签证在线提供
     *
     * $continentID 洲ID 选填
     */
    public function getCountryListByContinentID($continentID=0)
    {
        if($continentID!==0)
            $params=$this->setParams(array('continent_id'=>$continentID));
        else
            $params=$this->setParams();
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetCountryListByContinentID', $params);
    }

    /**
     *
     * 签证在线根据国家名称返回签证国家信息
     *
     * $arr=array(
     *  //洲ID 选填
     *  'continent_id'=>'',
     *  //国家ID 选填
     *  'country_id'=>'',
     *  //国家名称 选填
     *  'country_name'=>'',
     *  //每页显示条数 最小传入值1，最大传入值25，超出范围默认为10
     *  'page_size'=>'',
     *  //访问第几页
     *  'page_index'=>''
     * )
     */
    public function getVisaListByParams($arr=array())
    {
        $params=$this->setParams($arr);
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetVisaListByParams', $params);
    }

    /**
     *
     * 签证在线根据签证国家id返回单条签证国家信息
     *
     * $visa_id 签证ID
     */
    public function getVisaByVisaID($visaID)
    {
        $params=$this->setParams(array('visa_id'=>$visaID));
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetVisaByVisaID', $params);
    }

    /**
     *
     * 签证在线提供签证国家相关信息查询接口。包括注意事项、签证咨询、案例分析、资料下载的相关信息
     *
     * $arr=array(
     *  //签证相关信息类型
     *   签证关联类型（必填），选值范围
     *   Matters      //注意事项
     *   VisaConsult  //签证资讯
     *   CaseAnalysis //案例分析
     *   MaterialDownload //资料下载
     *  'visa_association_type'=>'',
     *  //国家名称（选填），如果不选则查所有
     *  'country_name'=>'',
     *  //每页显示条数
     *  'page_size'=>'',
     *  //访问第几页
     *  'page_index'=>''
     * )
     */
    public function getVisaAssociationListByPramas($arr)
    {
        $params=$this->setParams($arr);
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetVisaAssociationListByPramas', $params);
    }

    /**
     *
     * 签证在线提供签证国家相关信息详细查询接口。包括注意事项、签证咨询、案例分析、资料下载的相关信息
     *
     * $visaAssociationID 签证相关信息id
     */
    public function getVisaAssociationByVisaAssociationID($visaAssociationID)
    {
        $params=$this->setParams(array('visa_association_id'=>$visaAssociationID));
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetVisaAssociationByVisaAssociationID', $params);
    }

    /**
     *
     * 签证在线提供签证预约动态信息查询接口。包括预约国家、预约时间、更新时间的相关信息
     *
     * $count 查询条数 选填 默认为10
     */
    public function getAppointmentList($count=10)
    {
        $params=$this->setParams(array('top'=>$count));
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetAppointmentList', $params);
    }

    /**
     *
     * 在支付之前，使用此接口提交用户信息、产品信息创建订单、价格信息，签证在线根据信息创建订单。
     * 订单号是后续操作的依据，务必保持唯一
     *
     * $info=array(
     *  //订单号:商户号+yyMMddhhmmffff
     *  'order_id'=>'',
     *  //用户在合作方的用户名，如QQ号码
     *  'user_id'=>'',
     *  //签证产品id 
     *  'visa_id'=>'',
     *  //签证人数
     *  'visa_count'=>'',
     *  //多余1人，名称用”，”隔开，例如：张三，李四，王五
     *  'visa_name'=>'',
     *  签证总费用(元）
     *  'total_price'=>'',
     *  //出发时间 yyyy-MM-dd
     *  'depart_date'=>'',
     *  //其他备注 选填
     *  'other_remark'=>'',
     *  //联系人名称
     *  'contact_name'=>'',
     *  //联系人电话
     *  'phone'=>'',
     *  //联系人地址
     *  'address'=>''
     * )
     */
    public function createOrder($info=array())
    {
        $params=$this->setParams($info);
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/CreateOrder', $params);
    }

    /**
     *
     * 完成支付之后，通过此接口通知签证在线，签证在线收到通知后，认为钱已经到账，可以给用户提供服务。
     * 如果调用事情需要用同个订单重新发起
     *
     * $info=array(
     *  //订单号
     *  'order_id'=>'',
     *  //签证总费用
     *  'total_price'=>'',
     *  //支付时间 yyyy-MM-dd hh:mm:ss
     *  'pay_time'=>''
     * )
     */
    public function paymentConfirmation($info=array())
    {
        $params=$this->setParams($info);
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/PaymentConfirmation', $params);
    }

    /**
     *
     * 用户寄出资料后填写起快递单号，方便跟踪管理
     *
     * $info=array(
     *  //订单号
     *  'order_id'=>'',
     *  //快递公司
     *  'express_company'=>'',
     *  //快递单号
     *  'express_no'=>''
     * )
     */
    public function editExpressNoByOrderId($info=array())
    {
        $params=$this->setParams($info);
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/EditExpressNoByOrderId', $params);
    }

    /**
     *
     * 通过订单号查询订单信息、状态。一般用户交易过程确认订单信息
     *
     * $orderID 订单号
     */
    public function getSingleOrder($orderID)
    {
        $params=$this->setParams(array('order_id'=>$orderID));
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetSingleOrder', $params);
    }

    /**
     *
     * 通过用户名、时间段、状态查询多条订单信息列表。一般用与订单列表查询
     *
     * $info=array(
     *  //用户在合作方的用户名，查询条件
     *  'user_id'=>'',
　　 *  //查询条件，不填则选所有
     *  //订单状态
　　 *　    OrderConfirm    //订单确认
     *　　　ReceivedSuccess   //收件成功
　　 *   　 DeliveryVisa     //递送签证
　　 *　    VisaRetrieve     //签证取回
     *      VisaSend        //签证寄出
     *  'order_status'=>'',
     *  //创建时间的开始时间 yyyy-MM-dd hh:mm:ss 选填
     *  'create_time_begin'=>'',
     *  //创建时间的结束时间 yyyy-MM-dd hh:mm:ss 选填
     *  'create_time_end'=>'',
     *  //支付时间的开始时间 yyyy-MM-dd hh:mm:ss 选填
     *  'pay_time_begin'=>'',
     *  //支付时间的结束时间 yyyy-MM-dd hh:mm:ss 选填
     *  'pay_time_end'=>'',
     *  //每页显示条数 选填
     *  'page_size'=>'',
     *  //访问第几页 选填
     *  'page_index'=>'',
     * )
     *
     */
    public function geOrderListByParams($info=array())
    {
        $params=$this->setParams($info);
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GeOrderListByParams', $params);
    }

    /**
     *
     * 通过订单号查询本订单操作的每步详情，方便用户跟踪签证过程。一般用于订单查询中的订单详情
     *
     * $orderID 订单ID
     */
    public function getOrderRunningWaterByOrderId($orderID)
    {
        $params=$this->setParams(array('order_id'=>$orderID));
        
        return $this->getResponseArr('http://www.hzvisa.com/huize/GetOrderRunningWaterByOrderId', $params);
    }
}
