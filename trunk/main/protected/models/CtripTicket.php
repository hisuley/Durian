<?php
/**
 * Flight API
 *
 * @author xstudio
 * @date 07/25/13
 * @version 1.0
 *
 */
Yii::import('application.extensions.socket.*');

class CtripTicket
{
	
	private $_allianceInfo = array(
		'id' => '8257',
		'sid' => '178016',
		'api_key' => 'C9644F2F-1B13-4BED-8871-963E6195D592',
		'time_stamp'=>''
	);
	
	/**
	 *
	 * 查询国内航班(单/双程)信息
	 * $case 查询条件
	 * return 航班详细信息
	 */
	public function flightSearch($case=array())
	{
		
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/DomesticFlight/OTA_FlightSearch.asmx', $this->toFlightSeaInnerXML($case));
		return $this->xmlstr_to_array($HttpRequestData);
		
	}
	/**
	 *
	 * 国际航班查询
	 * $case 查询条件
	 * return 航班详情
	 *
	 */
	public function intlFilghtSearch($case=array())
	{
		
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/IntlFlight/OTA_IntlFlightSearch.asmx', $this->toIntlFlightSeaInnerXML($case));
		
		return $this->xmlstr_to_array($HttpRequestData);
	}
	/**
	 *
	 * 国内机票生成订单
	 *
	 */
	public function fltSaveOrder($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/DomesticFlight/OTA_FltSaveOrder.asmx', $this->toFltSaveOrderInnerXML($case));
		return $this->xmlstr_to_array($HttpRequestData);
	}
	
	/**
	 *
	 * 国内机票取消订单
	 */
	public function fltCancelOrder($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/DomesticFlight/OTA_FltCancelOrder.asmx', $this->toFltCancelOrderInnerXML($case));
		return $this->xmlstr_to_array($HttpRequestData);	
	}
	/**
	 *
	 * 国内机票订单列表
	 */
	public function fltOrderList($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/DomesticFlight/OTA_FltOrderList.asmx', $this->toFltOrderListInnerXML($case));
		return $this->xmlstr_to_array($HttpRequestData);	
	}
	/**
	 *
	 * 国内机票订单详情
	 */
	public function fltViewOrder($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/DomesticFlight/OTA_FltViewOrder.asmx', $this->toFltViewOrderInnerXML($case));
		return $this->xmlstr_to_array($HttpRequestData);		
	}
	/**
	 *
	 * 国内机票订单变更
	 */
	public function getStatusChangedOrders($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/DomesticFlight/OTA_GetStatusChangedOrders.asmx', $this->toGetStatusChangedOrdersInnerXML($case));
		
		return $this->xmlstr_to_array($HttpRequestData);		
	}
	/**
	 *
	 * 国际机型信息查询
	 */
	public function fltGetCraftInfos($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/FlightProduct/OTA_FltGetCraftInfos.asmx', $this->toFltGetCraftInfosInnerXML($case));
		
		return $this->xmlstr_to_array($HttpRequestData);		
	}
	/**
	 *
	 * 国际城市查询
	 */
	public function fltGetCityInfos($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/FlightProduct/OTA_FltGetCityInfos.asmx', $this->toFltGetCityInfosInnerXML($case));
		
		return $this->xmlstr_to_array($HttpRequestData);		
	}
	
	/**
	 *
	 * 国际机场查询
	 */
	public function fltGetAirportInfos($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/FlightProduct/OTA_FltGetAirportInfos.asmx', $this->toFltGetAirportInfosInnerXML($case));
		
		return $this->xmlstr_to_array($HttpRequestData);		
	}
	/**
	 *
	 * 国际航空公司信息
	 */
	public function fltGetAirlineInfos($case=array())
	{
		$HttpRequestData = Curl::httpRequestSoapData('http://openapi.ctrip.com/Flight/FlightProduct/OTA_FltGetAirlineInfos.asmx', $this->toFltGetAirlineInfosInnerXML($case));
		
		return $this->xmlstr_to_array($HttpRequestData);		
	}
	/**
	 * 
	 * 构造国内机票查询内部XML结构
	 */
	private function toFlightSeaInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
				<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FlightSearch" Signature="%s" />
			<FlightSearchRequest>
				<SearchType>%s</SearchType>
				<Routes>
					%s
				</Routes>
				<SendTicketCity>%s</SendTicketCity>
				<BookDate>%s</BookDate>
				<OrderBy>%s</OrderBy>
				<Direction>%s</Direction>
			</FlightSearchRequest>
		</Request>';
		
		$routes=$this->toRoutes($case['Routes']);
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FlightSearch'), $case['SearchType'], $routes, $case['SendTicketCity'], $case['BookDate'], $case['OrderBy'], $case['Direction']);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国际机票查询内部XML结构
	 */
	private function toIntlFlightSeaInnerXML($case=array())
	{
		$intlFlightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_IntlFlightSearch" Signature="%s" />
				<IntlFlightSearchRequest>
					<TripType>%s</TripType>
					<PassengerType>%s</PassengerType>
					<PassengerCount>%s</PassengerCount>
					<Eligibility>%s</Eligibility>
					<BusinessID />
					<BusinessType>%s</BusinessType>
					<Airline />
					<ClassGrade>%s</ClassGrade>
					<SalesType>%s</SalesType>
					<FareIds />
					<FareType>%s</FareType>
					<AgentID />
					<ResultMode>%s</ResultMode>
					<OrderBy>%s</OrderBy>
					<Direction>%s</Direction>
					<ShoppingInfoID />
					<SegmentInfos>
						%s
					</SegmentInfos>
					<Routings />
				</IntlFlightSearchRequest>
			</Request>';
		
		$SegmentInfos=$this->toSegmentInfos($case['SegmentInfos']);
		//$Routings=$this->toRoutings($case['Routings']);
		
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($intlFlightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_IntlFlightSearch'), $case['TripType'], $case['PassengerType'], $case['PassengerCount'], $case['Eligibility'], $case['BusinessType'], $case['ClassGrade'], $case['SalesType'], $case['FareType'], $case['ResultMode'], $case['OrderBy'], $case['Direction'], $SegmentInfos);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国内机票生成订单内部XML结构
	 */
	private function toFltSaveOrderInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltSaveOrder" Signature="%s" />
				<FltSaveOrderRequest>
					<UID>%s</UID>
					<OrderType>%s</OrderType>
					<Amount>%s</Amount>
					<ProcessDesc></ProcessDesc>
					<FlightInfoList>
						%s
					</FlightInfoList>
					<PassengerList>
						%s
					</PassengerList>
					<ContactInfo>
						<ContactName>%s</ContactName>
						<ConfirmOption>%s</ConfirmOption>
						<MobilePhone>%s</MobilePhone>
						<ContactTel />
						<ForeignMobile />
						<MobileCountryFix />
						<ContactEMail>%s</ContactEMail>
						<ContactFax />
					</ContactInfo>
					<DeliverInfo>
						<DeliveryType>%s</DeliveryType>
						<SendTicketCityID>%s</SendTicketCityID>
						<OrderRemark />
						<PJS>
							<Receiver />
							<Province />
							<City />
							<Canton />
							<Address />
							<PostCode />
						</PJS>
					</DeliverInfo>
					<PayInfo>
						%s					
					</PayInfo>
				</FltSaveOrderRequest>
			</Request>';
		
		$flightInfoList=$this->toFlightInfoList($case['FlightInfoList']);
		$passengerList=$this->toPassengerList($case['PassengerList']);
		$payInfo=$this->toPayInfo($case['PayInfo']);
		
		
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltSaveOrder'), $case['UID'], $case['OrderType'], $case['Amount'], $flightInfoList, $passengerList, $case['ContactInfo']['ContactName'], $case['ContactInfo']['ConfirmOption'],$case['ContactInfo']['MobilePhone'],$case['ContactInfo']['ContactEMail'],$case['DeliverInfo']['DeliveryType'],$case['DeliverInfo']['SendTicketCityID'], $payInfo);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国内机票取消订单内部XML结构
	 */
	private function toFltCancelOrderInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltCancelOrder " Signature="%s" />
				<FltCancelOrderRequest>
					<UserID>%s</UserID>
					<OrderID>
						<int>%s</int>
					</OrderID>
				</FltCancelOrderRequest >
			</Request>';
		
		$this->_allianceInfo['time_stamp']=time();
		
		//$this->toSignature('OTA_FltCancelOrder ')空格不能删
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltCancelOrder '), $case['UserID'], $case['OrderID']);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国内机票订单列表内部XML结构
	 */
	private function toFltOrderListInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
				<Request>
					<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltOrderList" Signature="%s" />
					<FltOrderListRequest>
						<Uid>%s</Uid>
						<EffectDate>%s</EffectDate>
						<ExpiryDate>%s</ExpiryDate>
						<OrderID>%s</OrderID>
						<OrderStatus>%s</OrderStatus>
						<TopCount>%s</TopCount>
						<OrderType>%s</OrderType>
					</FltOrderListRequest>
				</Request>';
		
		$this->_allianceInfo['time_stamp']=time();
		
		//$this->toSignature('OTA_FltCancelOrder ')空格不能删
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltOrderList'), $case['Uid'], $case['EffectDate'], $case['ExpiryDate'], $case['OrderID'], $case['OrderStatus'], $case['TopCount'], $case['OrderType']);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国内机票订单详情内部XML结构
	 */
	private function toFltViewOrderInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltCancelOrder " Signature="%s" />
				<FltViewOrderRequest>
					<UserID>%s</UserID>
					<OrderID>
						%s
					</OrderID>
				</FltViewOrderRequest>
			</Request>';
		
		$OrderID=$this->toOrderID($case['OrderID']);
		$this->_allianceInfo['time_stamp']=time();
		
		//$this->toSignature('OTA_FltCancelOrder ')空格不能删
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltCancelOrder '), $case['UserID'], $OrderID);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国内机票订单变更内部XML结构
	 */
	private function toGetStatusChangedOrdersInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_GetStatusChangedOrders " Signature="%s" />
				<GetStatusChangedOrdersRequest>
					<ChangedTime>%s</ChangedTime>
				</GetStatusChangedOrdersRequest>
			</Request>';
					
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_GetStatusChangedOrders '), $case['ChangedTime']);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国际机型查询内部XML结构
	 */
	private function toFltGetCityInfosInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltGetCityInfos" Signature="%s" />
				<GetCityInfosRequest>
					<CityCode> </CityCode>
					<CityId></CityId>
					<CityName>%s</CityName>
				</GetCityInfosRequest>
			</Request>';
					
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltGetCityInfos'), $case['CityName']);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国际城市查询内部XML结构
	 */
	private function toFltGetCraftInfosInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltGetCraftInfos" Signature="%s" />
				<GetCraftInfosRequest>
					<CraftType>%s</CraftType>
				</GetCraftInfosRequest>
			</Request>';
					
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltGetCraftInfos'), $case['CraftType']);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造国际机场查询内部XML结构
	 */
	private function toFltGetAirportInfosInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltGetAirportInfos" Signature="%s" />
				<GetAirportInfosRequest>
					<AirportCode>%s</AirportCode>
				</GetAirportInfosRequest>
			</Request>';
					
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltGetAirportInfos'), $case['AirportCode']);
		
		return $xmlBody;	
	}
	/**
	 * 
	 * 构造航空公司信息内部XML结构
	 */
	private function toFltGetAirlineInfosInnerXML($case=array())
	{
		$flightXML='<?xml version="1.0" encoding="utf-8"?>
			<Request>
				<Header AllianceID="%s" SID="%s" TimeStamp="%s" RequestType="OTA_FltGetAirlineInfos" Signature="%s" />
				<GetAirlineInfosRequest>
					<AirLine>%s</AirLine>
				</GetAirlineInfosRequest>
			</Request>';
					
		$this->_allianceInfo['time_stamp']=time();
		
		$xmlBody = sprintf($flightXML, $this->_allianceInfo['id'], $this->_allianceInfo['sid'], $this->_allianceInfo['time_stamp'], $this->toSignature('OTA_FltGetAirlineInfos'), $case['AirLine']);
		
		return $xmlBody;	
	}

	/**
	 *
	 * 将国内机票查询的$case['Routes']转化为XML结构
	 */
	private function toRoutes($routes)
	{
		$xml='';
		
		for($i=0; $i<count($routes); $i++)
		{
			$xml.='<FlightRoute><DepartCity>';
			$xml.=$routes[$i]['DepartCity'];
			$xml.='</DepartCity><ArriveCity>';
			$xml.=$routes[$i]['ArriveCity'];
			$xml.='</ArriveCity><DepartDate>';
			$xml.=$routes[$i]['DepartDate'];
			$xml.='</DepartDate><AirlineDibitCode>';
			$xml.=$routes[$i]['AirlineDibitCode'];
			$xml.='</AirlineDibitCode></FlightRoute>';		
		}
		
		return $xml;
		
	}
	
	/**
	 *
	 * 将国际票查询的$case['SegmentInfos']转化为XML结构
	 */
	private function toSegmentInfos($routes)
	{
		$xml='';
		
		for($i=0; $i<count($routes); $i++)
		{
			$xml.='<SegmentInfo><DCode>';
			$xml.=$routes[$i]['DCode'];
			$xml.='</DCode><ACode>';
			$xml.=$routes[$i]['ACode'];
			$xml.='</ACode><DAirport /><AAirport /><DDate>';		
			$xml.=$routes[$i]['DDate'];
			$xml.='</DDate><TimePeriod>';		
			$xml.=$routes[$i]['TimePeriod'];
			$xml.='</TimePeriod></SegmentInfo>';		
		}
		
		return $xml;
		
	}
	
	/**
	 *
	 * 将国际机票查询的$case['Routings']转化为XML结构
	 */
	private function toRoutings($routes)
	{
		$xml='';
		
		for($i=0; $i<count($routes); $i++)
		{
			$xml.='<Routing><DCode>';
			$xml.=$routes[$i]['DCode'];
			$xml.='</DCode><ACode>';
			$xml.=$routes[$i]['ACode'];
			$xml.='</ACode><DAirport>';
			$xml.=$routes[$i]['DAirport'];
			$xml.='</DAirport><AAirport>';
			$xml.=$routes[$i]['AAirport'];
			$xml.='</AAirport><Airline>';		
			$xml.=$routes[$i]['Airline'];
			$xml.='</Airline><SeatClass>';		
			$xml.=$routes[$i]['SeatClass'];
			$xml.='</SeatClass><FlightNo>';		
			$xml.=$routes[$i]['FlightNo'];
			$xml.='</FlightNo><OperatorNo>';		
			$xml.=$routes[$i]['OperatorNo'];
			$xml.='</OperatorNo><SegmentInfoNo>';		
			$xml.=$routes[$i]['SegmentInfoNo'];
			$xml.='</SegmentInfoNo><No>';		
			$xml.=$routes[$i]['No'];
			$xml.='</No></Routing>';	
		}
		
		return $xml;
		
	}
	/**
	 *
	 * 将国内机票生成订单的$case['FlightInfoList']转化为XML结构
	 */
	private function toFlightInfoList($routes)
	{
		$xml='';
		
		for($i=0; $i<count($routes); $i++)
		{
			$xml.='<FlightInfoRequest><DepartCityID>';
			$xml.=$routes[$i]['DepartCityID'];
			$xml.='</DepartCityID><ArriveCityID>';
			$xml.=$routes[$i]['ArriveCityID'];
			$xml.='</ArriveCityID><DPortCode>';
			$xml.=$routes[$i]['DPortCode'];
			$xml.='</DPortCode><APortCode>';
			$xml.=$routes[$i]['APortCode'];
			$xml.='</APortCode><AirlineCode>';		
			$xml.=$routes[$i]['AirlineCode'];
			$xml.='</AirlineCode><Flight>';		
			$xml.=$routes[$i]['Flight'];
			$xml.='</Flight><Class>';		
			$xml.=$routes[$i]['Class'];
			$xml.='</Class><SubClass>';		
			$xml.=$routes[$i]['SubClass'];
			$xml.='</SubClass><TakeOffTime>';		
			$xml.=$routes[$i]['TakeOffTime'];
			$xml.='</TakeOffTime><ArrivalTime>';		
			$xml.=$routes[$i]['ArrivalTime'];
			$xml.='</ArrivalTime><Rate>';		
			$xml.=$routes[$i]['Rate'];
			$xml.='</Rate><Price>';		
			$xml.=$routes[$i]['Price'];
			$xml.='</Price><Tax>';		
			$xml.=$routes[$i]['Tax'];
			$xml.='</Tax><OilFee>';		
			$xml.=$routes[$i]['OilFee'];
			$xml.='</OilFee><NonRer>';		
			$xml.=$routes[$i]['NonRer'];
			$xml.='</NonRer><NonRef>';		
			$xml.=$routes[$i]['NonRef'];
			$xml.='</NonRef><NonEnd>';		
			$xml.=$routes[$i]['NonEnd'];
			$xml.='</NonEnd><RerNote>';		
			$xml.=$routes[$i]['RerNote'];
			$xml.='</RerNote><RefNote>';	
			$xml.=$routes[$i]['RefNote'];
			$xml.='</RefNote><EndNote>';	
			$xml.=$routes[$i]['EndNote'];
			$xml.='</EndNote><Remark>';	
			$xml.=$routes[$i]['Remark'];
			$xml.='</Remark><NeedAppl>';	
			$xml.=$routes[$i]['NeedAppl'];
			$xml.='</NeedAppl><Recommend>';	
			$xml.=$routes[$i]['Recommend'];
			$xml.='</Recommend><Canpost>';	
			$xml.=$routes[$i]['Canpost'];
			$xml.='</Canpost><CraftType>';	
			$xml.=$routes[$i]['CraftType'];
			$xml.='</CraftType><Quantity>';	
			$xml.=$routes[$i]['Quantity'];
			$xml.='</Quantity><Cost>';	
			$xml.=$routes[$i]['Cost'];
			$xml.='</Cost><CostRate>';	
			$xml.=$routes[$i]['CostRate'];
			$xml.='</CostRate><RefundFeeFormulaID>';	
			$xml.=$routes[$i]['RefundFeeFormulaID'];
			$xml.='</RefundFeeFormulaID><UpGrade>';	
			$xml.=$routes[$i]['UpGrade'];
			$xml.='</UpGrade><TicketType>';	
			$xml.=$routes[$i]['TicketType'];
			$xml.='</TicketType><AllowCPType>';	
			$xml.=$routes[$i]['AllowCPType'];
			$xml.='</AllowCPType><DeliverTicketType>';	
			$xml.=$routes[$i]['DeliverTicketType'];
			$xml.='</DeliverTicketType><ProductType /><CanSeparateSale /><RouteIndex>';	
			$xml.=$routes[$i]['RouteIndex'];
			$xml.='</RouteIndex><InventoryType>';	
			$xml.=$routes[$i]['InventoryType'];
			$xml.='</InventoryType><ProductSource>';	
			$xml.=$routes[$i]['ProductSource'];
			$xml.='</ProductSource></FlightInfoRequest>';	
		}
		
		return $xml;
		
	}
	/**
	 *
	 * 将国内机票生成订单的$case['PayInfo']转化为XML结构
	 */
	private function toPayInfo($routes)
	{
		$xml='';
		
		for($i=0; $i<count($routes); $i++)
		{
			$xml.='<CreditCardInfo><CardInfoID>';
			$xml.=$routes[$i]['CardInfoID'];
			$xml.='</CardInfoID><CreditCardType>';
			$xml.=$routes[$i]['CreditCardType'];
			$xml.='</CreditCardType><CreditCardNumber>';
			$xml.=$routes[$i]['CreditCardNumber'];
			$xml.='</CreditCardNumber><Validity>';
			$xml.=$routes[$i]['Validity'];
			$xml.='</Validity><CardBin>';		
			$xml.=$routes[$i]['CardBin'];
			$xml.='</CardBin><CardHolder>';		
			$xml.=$routes[$i]['CardHolder'];
			$xml.='</CardHolder><IdCardType>';		
			$xml.=$routes[$i]['IdCardType'];
			$xml.='</IdCardType><IdNumber>';		
			$xml.=$routes[$i]['IdNumber'];
			$xml.='</IdNumber><CVV2No>';		
			$xml.=$routes[$i]['CVV2No'];
			$xml.='</CVV2No><AgreementCode></AgreementCode><Eid></Eid><Remark></Remark><IsClient>';		
			$xml.=$routes[$i]['IsClient'];
			$xml.='</IsClient><CCardPayFee>';		
			$xml.=$routes[$i]['CCardPayFee'];
			$xml.='</CCardPayFee><CCardPayFeeRate>';		
			$xml.=$routes[$i]['CCardPayFeeRate'];
			$xml.='</CCardPayFeeRate><Exponent>';		
			$xml.=$routes[$i]['Exponent'];
			$xml.='</Exponent><ExchangeRate></ExchangeRate><FAmount></FAmount></CreditCardInfo>';
			
		}
		
		return $xml;
		
	}
	/**
	 *
	 * 将国内机票生成订单的$case['PassengerList']转化为XML结构
	 */
	private function toPassengerList($routes)
	{
		$xml='';
		
		for($i=0; $i<count($routes); $i++)
		{
			$xml.='<PassengerRequest><PassengerName>';
			$xml.=$routes[$i]['PassengerName'];
			$xml.='</PassengerName><BirthDay>';
			$xml.=$routes[$i]['BirthDay'];
			$xml.='</BirthDay><PassportTypeID>';
			$xml.=$routes[$i]['PassportTypeID'];
			$xml.='</PassportTypeID><PassportNo>';
			$xml.=$routes[$i]['PassportNo'];
			$xml.='</PassportNo><ContactTelephone /><Gender>';		
			$xml.=$routes[$i]['Gender'];
			$xml.='</Gender><InsuranceNum>';		
			$xml.=$routes[$i]['InsuranceNum'];
			$xml.='</InsuranceNum><NationalityCode /></PassengerRequest>';	
		}
		
		return $xml;
		
	}
	/**
	 *
	 * 将国内机票订单详情的$case['OrderID']转化为XML结构
	 */
	private function toOrderID($case)
	{
		$xml='';
		for($i=0; $i<count($case); $i++)
		{
			$xml.='<int>';
			$xml.=$case[$i][0];
			$xml.='</int>';
		}
	}
	
	/**
	 *
	 * 生成XML文件的Signature属性
	 */
	private function toSignature($requestType)
	{
		$signString = $this->_allianceInfo['time_stamp'].$this->_allianceInfo['id'].strtoupper(md5($this->_allianceInfo['api_key'])).$this->_allianceInfo['sid'].$requestType;
		
		$signature = strtoupper(md5($signString));
		
	    return $signature;
	}
	/**
	 * 
	 * 返回的XML->array
	 */
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
}
