<?php

class Hotel
{
	
	/**
	 *
	 * 酒店搜索
	 * 
	 * $case=array(
			//目的地value前缀
			'destType'=>'C',
			//destType+destCode 组成目的地value
			'destCode'=>'MFM',
			//城市名
			'cityName'=>'Macau 澳门, 中国澳门',
			//入住日
			'arrival'=>'2013-08-04',
			//居住天数 自行计算
			'duration'=>'2',
			//
			 // 房间代号组合：00 00 00 00 
			// 最多每人订购四间房 00:占位符
			 //
			'rooms'=>'111620610810',
			//酒店位置 G2：机场
			'loc'=>' ',
			//成人数 ：房间数*每个房间人数
			'adults'=>6,
			//儿童数：根据床位类型
			'children'=>1,
			//每个儿童年龄相连接
			'ages'=>'03',
			//酒店名
			'hotelName'=>'',
			//酒店星级标准
			'star'=>'0',
			//酒店设施：根据checkbox数组选择键值进行组合
			'facilities'=>'1|'
		)
	 *
	 * return array(
			//酒店1
			array(
				//酒店名
				'hotelName'=>"sheraton macao cotai central",
				//酒店图片地址
				'imageUrl'=>"http://images.gta-travel.com/HH/Images/MO/MFMth/MFM-95-1.jpg",
				//酒店中文名
				'boldsm'=>"macau 澳门",
				//酒店位置
				'location'=>"位置: Central",
				//酒店条件设施
				'nobr'=>array(
					'泊车','电视',
				),
				//酒店描述
				'description'=>"澳门喜来登金沙城中心酒店是澳门最大的酒店。 ",
				//房间信息
				'roomInfo'=>array(
					//房间类型
					'aid'=>"豪华房",
					//付费是否包含早餐
					'mealInfo'=>"全 包含早餐",
					//价格
					'price'=>"2,232.00"
				)
			),
			//酒店2
			array()
		);
	 */	
	public function hotelSearch($case=array())
	{
		$data=Yii::app()->curl->setOption(CURLOPT_HEADER, 1)->get('http://gbs.gta-travel.com/fe/GetSiteServlet?siteid=AOFAN');
		if(preg_match('/Set-Cookie:\s+JSESSIONID=([0-9a-zA-Z]+\.[0-9a-zA-Z]{5})/i', $data, $jid))
        {
			$params='';
			
			foreach($case as $key=>$val)
			{
				$params.=$key.'='.$val.'&';
			}
			
			$params.='newHotelSearch=Search&category=&loc=&budget=0&ages=&children=0&hotelName=&order=&star=0&facilities=&hotelType=';
            Yii::app()->curl->setOptions(array(CURLOPT_HEADER=>0, CURLOPT_COOKIE=>'JSESSIONID='.$jid[1].'; sessionSiteId=AOFAN'))->post('http://gbs.gta-travel.com/fe/HotelSearchServlet', $params);
            
			return $this->getPregexpArr(Yii::app()->curl->get('http://gbs.gta-travel.com/fe/HotelPriceListFullDetails.jsp'));
			
		}
		
		else return FALSE;
		
	}
	/**
	 *
	 * 查询酒店详细信息
	 * $item： 已在hotelSearch中进行返回
	 * $city: 城市代码 MFM-澳门
	 * $row: hotelSearch中的整形索引
	 *
	 */
	public function getHotelInfo($item, $city, $row)
	{
		$data=Yii::app()->curl->setOption(CURLOPT_HEADER, 1)->get('http://gbs.gta-travel.com/fe/GetSiteServlet?siteid=AOFAN');
		
		if(preg_match('/Set-Cookie:\s+JSESSIONID=([0-9a-zA-Z]+\.[0-9a-zA-Z]{5})/i', $data, $jid))
		{
			$data=Yii::app()->curl->setOptions(array(CURLOPT_HEADER=>0, CURLOPT_COOKIE=>'JSESSIONID='.$jid[1].'; sessionSiteId=AOFAN'))->get('http://gbs.gta-travel.com/fe/HotelInfo.jsp?noFooter=true&noButton=true&noClose=true&city='.$city.'&item='.$item.'&lang=CS&listName=HotelPriceList&row='.$row.'&book=2&existBed=false&immed=true&showCotMsg=false&fromAlt=false&tabid=0&viewTripAdvisor=false&KeepThis=true&');	
		
			return $this->getHotelInfoArr($data);
			
		}
		
		
		
	}
	/**
	 *
	 * 酒店查询，正则匹配结果返回二维数组
	 *
	 */
	private function getPregexpArr($content='', $city='')
	{
		$reg=array(
			//item
			'item'=>"/<a\s+href=\"#\"\s+class=\"hotelname\"\s+onclick=\"return\s+showItemBook\(event,gShowInfoUrl,&quot;[a-zA-Z0-9]+&quot;,&quot;([a-zA-Z0-9]+)&quot;.*?\);\"/is",
			//hotelName
			'hotelName'=>"/<span\s+dir=\"LTR\"\s+class=\"hotelname\">(.+)<\/span>/i",
			//imageUrl
			'imageUrl'=>"/<img\s+src=\"(http:\S+)\"/i",
			//boldsm
			'boldsm'=>"/<span\s+class=\"boldsm\"\s+style=\"text-transform: capitalize\">(.+)<\/span>/i",
			//location
			'location'=>"/<span\s+class=\"smItemCode\">(.+)<\/span>/i",
			//nobr
			'nobr'=>"/(<img\s+src='\/\/\S+'\s+alt=\"(\S+)\">)+/is",
			//description
			'description'=>"/<span\s+class=\"smaller\">(.+)<\/span>/i",
			//roomInfo
			'roomInfo'=>array(
				'aid'=>"/<a href=\"#\" class=\"aid\".*?>(.*?)<\/a>/is",
				'mealInfo'=>"/<span class=\"smallerTitleCaps\s+mealInfo\">(.*?)<\/span>/is",
				'price'=>"/<a href=\"#\" class=\"price\".*?>(.*?)<\/a>/is"
			)
			
		);
		
		preg_match_all("/<table\s+width=\"100%\"\s+class=\"hotelGroupTable\"\s+cellpadding=\"0\"\s+cellspacing=\"0\">(.*?)<hr/is", $content, $result);
		
		if(count($result[1])<=0) return FALSE;
		
		$searchResult=array();
		
		for($i=0; $i<count($result[1]); $i++)
		{
			foreach($reg as $key=>$value)
			{
				if($key!=='roomInfo')
				{
					preg_match_all($reg[$key], $result[1][$i], $temp);	
				
					if($key=='nobr')
						$searchResult[$i]['nobr']=$temp[count($temp)-1];
					elseif(isset($temp[1][0])) $searchResult[$i][$key]=$temp[1][0];	
				}
				else
				{
					preg_match_all($reg[$key]['aid'], $result[1][$i], $tempAid);		
					preg_match_all($reg[$key]['mealInfo'], $result[1][$i], $tempMealInfo);	
					preg_match_all($reg[$key]['price'], $result[1][$i], $tempPrice);		
					
					for($j=0; $j<count($tempAid[1]); $j++)
					{
						$searchResult[$i]['roomInfo'][$j]['aid']=trim($tempAid[1][$j]);
						$searchResult[$i]['roomInfo'][$j]['price']=$tempPrice[1][$j];
						
						if(preg_match("/<a.*?>(.*?)<\/a>/is", trim($tempMealInfo[1][$j]), $t))
							$searchResult[$i]['roomInfo'][$j]['mealInfo']=trim($t[1]);	
						else
							$searchResult[$i]['roomInfo'][$j]['mealInfo']=trim($tempMealInfo[1][$j]);
						
					}
				}
			}
			
			
		}
		
		return $searchResult;	
	}
	
	/**
	 *
	 * 酒店信息查询，正则匹配结果返回数组
	 */
	private function getHotelInfoArr($source)
    {
		$result=array();
		
		$regexp=array(
			'image'=>"/new FilmImage\((.*?)\)/is",
			'ct'=>"/(<div\s+class=\"textHeading\">(.*?)<\/div>(.*?)<br>{0,2})+/is",
			'detail'=>"/<td\s+style=\"width:\s+50%;\s+vertical-align:\s+top;\">(.*?)<\/td>/is",
		);	
		if(preg_match_all($regexp['image'], $source, $temp))
		{
			for($i=0; $i<count($temp[1]); $i++)	
				$result['rooms'][$i]=explode(',', $temp[1][$i]);
		}
		if(preg_match_all($regexp['ct'], $source, $temp))
		{
			for($i=0; $i<count($temp[2])-1; $i++)
			{
				$result['ct'][$temp[2][$i]]=$temp[3][$i];
			}
			
			if(preg_match("/(.*?)<\/div>/is", $temp[3][count($temp[2])-1], $r))
				$result['ct'][$temp[2][count($temp[2])-1]]=$r[1];
		}
		if(preg_match_all($regexp['detail'], $source, $temp))
		{
			for($i=0; $i<count($temp[1]); $i++)
			{
				$splite=explode('<br>',$temp[1][$i]);	
				
				for($j=0; $j<count($splite); $j++)
				{
					if(!empty($splite[$j]))	
						$result['detail'][$i][$j]=$splite[$j];
				}
			}
		}
		
		return $result;
	}
	
}
