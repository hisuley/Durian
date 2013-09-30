<?php
/**
 * Insurance API
 *
 *
 * @author xstudio
 * @version 1.0
 * @date 07/25/13
 *
 */
class Insurance
{
    /**
	 * 
	 * 登录用户名、密码
	 */
	
    private $_insuranceConfig=array(
		'UserLoginName'=>'jmly',
    	'UserPswd'=>'bmgomhpieccknpdj'
	);
    
	//订单信息
	private $_orderInfo;
	
	//保险费表
    private $_insuranceTable=array(
        //1-7天
        'scopeA'=>array(
            '白银计划'=>array(
                'adults'=>105,
                'childs'=>85
            ),
            '黄金计划'=>array(
                'adults'=>165,
                'childs'=>135
            ),
            '钻石计划'=>array(
                'adults'=>210,
                'childs'=>170
            )
        ),
        //8-10天
        'scopeB'=>array(
            '白银计划'=>array(
                'adults'=>135,
                'childs'=>105
            ),
            '黄金计划'=>array(
                'adults'=>210,
                'childs'=>170
            ),
            '钻石计划'=>array(
                'adults'=>280,
                'childs'=>225
            )
        ),
        //11-14天
        'scopeC'=>array(
            '白银计划'=>array(
                'adults'=>180,
                'childs'=>145
            ),
            '黄金计划'=>array(
                'adults'=>285,
                'childs'=>230
            ),
            '钻石计划'=>array(
                'adults'=>375,
                'childs'=>300
            )
        ),
        //15-17天
        'scopeD'=>array(
            '白银计划'=>array(
                'adults'=>210,
                'childs'=>170
            ),
            '黄金计划'=>array(
                'adults'=>335,
                'childs'=>265
            ),
            '钻石计划'=>array(
                'adults'=>440,
                'childs'=>350
            )
        ),
        //18-21天
        'scopeE'=>array(
            '白银计划'=>array(
                'adults'=>255,
                'childs'=>200
            ),
            '黄金计划'=>array(
                'adults'=>405,
                'childs'=>330
            ),
            '钻石计划'=>array(
                'adults'=>530,
                'childs'=>425
            )
        ),
        //22-24天
        'scopeF'=>array(
            '白银计划'=>array(
                'adults'=>285,
                'childs'=>230
            ),
            '黄金计划'=>array(
                'adults'=>455,
                'childs'=>365
            ),
            '钻石计划'=>array(
                'adults'=>595,
                'childs'=>475
            )
        ),
        //25-28天
        'scopeG'=>array(
            '白银计划'=>array(
                'adults'=>330,
                'childs'=>265
            ),
            '黄金计划'=>array(
                'adults'=>525,
                'childs'=>420
            ),
            '钻石计划'=>array(
                'adults'=>690,
                'childs'=>555
            )
        ),
        //超过28天,每周的增量
        'scopeH'=>array(
            '白银计划'=>array(
                'adults'=>75,
                'childs'=>60
            ),
            '黄金计划'=>array(
                'adults'=>120,
                'childs'=>80
            ),
            '钻石计划'=>array(
                'adults'=>160,
                'childs'=>130
            )
        ),
        //全年保障
        'scopeI'=>array(
            '白银计划'=>array(
                'adults'=>945,
                'childs'=>760
            ),
            '黄金计划'=>array(
                'adults'=>1550,
                'childs'=>1235
            ),
            '钻石计划'=>array(
                'adults'=>2250,
                'childs'=>1800
            )
        ),
    );
	
	
    /**
     *
     * 根据人数、年龄、保险时间、所购计划计算报表
     *
     * $info=array(
     *  array(
     *      //年龄
     *      'age'=>20,
     *      //保险时间
     *      'time'=>45,
     *      //所购计划
     *      'scope'=>'白银计划'
     *  )
     * )
     *
     * return 总金额
     */

    public function calculateQuote($info=array())
    {
        $money=0;

        for($i=0; $i<count($info); $i++)
        {
			
            $money+=$this->calculateSingle($info[$i]);
			
        }

        return $money;
    }

    /**
     * 
     * 计算单一客户保险金额
     *
     * return 金额
     */
    private function calculateSingle($info=array())
    {
        if(empty($info))
            return 0;

        $ageKind='childs';
        $money=0;

        foreach($info as $key=>$val)
        {
            if($key=='age' && $val>=18)
            {
                $ageKind='adults';
            }
            if($key=='time')
            {
                $money=$this->toMoney($val, $info, $ageKind);
            }
        }

        return $money;
    }
    
    /**
     * 
     * 根据天数计算
     * 
     *
     */
    private function toMoney($val, $info, $ageKind)
    {
        if($val>=1 && $val<=7)
            $money=$this->_insuranceTable['scopeA'][$info['scope']][$ageKind];
        elseif($val>=8 && $val<=10)
            $money=$this->_insuranceTable['scopeB'][$info['scope']][$ageKind];
        elseif($val>=11 && $val<=14)
            $money=$this->_insuranceTable['scopeC'][$info['scope']][$ageKind];
        elseif($val>=15 && $val<=17)
            $money=$this->_insuranceTable['scopeD'][$info['scope']][$ageKind];
        elseif($val>=18 && $val<=21)
            $money=$this->_insuranceTable['scopeE'][$info['scope']][$ageKind];
        elseif($val>=22 && $val<=24)
            $money=$this->_insuranceTable['scopeF'][$info['scope']][$ageKind];
        elseif($val>=25 && $val<=28)
            $money=$this->_insuranceTable['scopeG'][$info['scope']][$ageKind];
        elseif($val>28 && $val<365)
        {
            $z=ceil(($val-28)/7);
			
			
            $money=$z*$this->_insuranceTable['scopeH'][$info['scope']][$ageKind]
                +$this->_insuranceTable['scopeG'][$info['scope']][$ageKind];
				
			
        }
        elseif($val==365)
            $money=$this->_insuranceTable['scopeI'][$info['scope']][$ageKind];
        elseif($val>365)
        {
            $y=floor($val/365);
            $d=$val%365;
			
            $money+=$this->_insuranceTable['scopeI'][$info['scope']][$ageKind]*$y+$this->toMoney($d, $info, $ageKind);
        }

        return $money;
    }
	
	/**
	 *
	 * 下单
	 * return boolean
	 *
	 */
	public function order($info=array())
	{
		
		$xml = new SimpleXMLElement("<?xml version='1.0'  encoding='utf-8'?><TXLife></TXLife>");
		 
		$info['TXLifeRequest']['TransExeTime']=date('Y-m-d H:i:s');
		$info['TXLifeRequest']['TransactionType']='NSell';
		
		$info=array(
			'UserAuthRequest'=>array(
				'UserLoginName'=>$this->_insuranceConfig['UserLoginName'],
				'UserPswd'=>$this->_insuranceConfig['UserPswd']
			),
			$info
		);
		
		$this->arrayToXML($info, $xml);
		
		$postInfo = mb_convert_encoding($xml->asXML(), 'GBK', 'UTF-8');
        
		$result=$this->doRequest('POST', 'http://biz.mingya.com.cn:9080/partener.shtml', $postInfo);
		
		$this->_orderInfo['PolicyNumber']='';
		$this->_orderInfo['PolicyUrl']='';
		
		if(preg_match('/<PolicyNumber>(.+)<\/PolicyNumber><PolicyUrl>(.+)<\/PolicyUrl>/i',$result,$order))
		{
			$this->_orderInfo['PolicyNumber']=$order[1];
			$this->_orderInfo['PolicyUrl']=$order[2];
			return TRUE;
		}
		else return FALSE;
		
		
		
	}
	/**
	 *
	 * 数组转化为XML文件
	 * return 
	 */
	
	
	private function arrayToXML($insurance_info, &$xml_insurance_info)
	{
		foreach($insurance_info as $key => $value) 
		{
	        if(is_array($value)) 
			{
	            if(!is_numeric($key))
				{
	                $subnode = $xml_insurance_info->addChild("$key");
	                $this->arrayToXML($value, $subnode);
	            }
	            else $this->arrayToXML($value, $xml_insurance_info);
	        }
	        else $xml_insurance_info->addChild("$key","$value");
	        
    	}
	}
	
	/**
	 *
	 * 发送远程WEB请求
	 * return HttpHeader信息+服务器信息
	 */
	
	private function doRequest($method, $url, $vars) 
	{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
			curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
			if ($method == 'POST') 
			{
			   curl_setopt($ch, CURLOPT_POST, 1);
			   curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
			}
			
			$data = curl_exec($ch);
			curl_close($ch);
			if ($data) 
			{
			   if ($this->callback)
			   {
				   $callback = $this->callback;
				   $this->callback = false;
				   return call_user_func($callback, $data);
			   } 
			   else return $data;
			} 
			else return curl_error($ch);

	}
	/**
	 *
	 * 获取订单信息 FLASE/rarray
	 * 订单信息不为空
	 * return array(
	 *  //订单号
	 * 	'PolicyNumber'=>'IA334545',
	 *  //用户订单详情URL
	 *  'PolicyUrl'=>'https://fulfillment.uat.tra**'
	 * )
	 * 订单信息为空 
	 * retutn FALSE;
	 */
	public function getOrder()
	{
		if(!empty($this->_orderInfo['PolicyNumber']) && !empty($this->_orderInfo['PolicyUrl']))
			return $this->_orderInfo;	
		else 
			return FALSE;
	}
	
}
