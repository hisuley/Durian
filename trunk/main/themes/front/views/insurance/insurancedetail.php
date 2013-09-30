<script>
	$(document).ready(function() {
			$('ol li>a').click(function(event) {
				/* Act on the event */
				var hr= $(this).attr('href');
				var heights= $(hr).offset().top;
				heights-= 100;
				$('html,body').stop().animate({scrollTop : heights}, 1000);		
			});
		});	


</script>
<div id="insurancedetail">
	<h2>美亚“乐悠游”境外旅行保障计划 </h2>
	<ol>
		<li class='left'><a href="#c1">产品特色</a></li>
		<li class='left'><a href="#c2">保障范围摘要</a></li>
		<li class='left'><a href="#c3">保险费表</a></li>
		<li class='left'><a href="#c4">特别提醒</a></li>
		<li class='left'><a href="#c5">理赔指南</a></li>
		<li class='left'><a href="#c6">紧急救援服务</a></li>
	</ol>
	<div id="insurancedetail-content">
		<div>
			<h3></h3><a id="c1">产品特色</a>
			<ul>
   				<li>保障周全，涵盖境外旅行期间意外伤害、疾病和财物损失等</li>
   				<li><strong>24</strong>小时全球紧急医疗救援和旅行支援服务</li>
   				<li>承保热门娱乐运动：滑雪、潜水、骑马</li>
   				<li>新添银行卡盗刷（不适用于未成年人）&nbsp;</li>
   				<li>投保年龄为<strong>1－80</strong>周岁</li>
			</ul>
		</div>
		<div>
			<h3><a id="c2">保障范围摘要</a></h3>
			<table>
  				<tbody>
  				    <tr class="bxtitleBg">
  				        <td colspan="2" rowspan="2"><span style="color: #808080"><strong>保障范围</strong></span></td>
  				        <td colspan="2"><span style="color: #808080"><strong>保障金额(单位：元)</strong></span></td>
  				    </tr>
  				    <tr class="bxtitleBg">
  				        <td><span style="color: #808080"><strong>计划一</strong></span></td>
  				        <td><span style="color: #808080"><strong>计划二</strong></span></td>
  				    </tr>
  				</tbody>
  				<tbody>
  				    <tr align="center" style="background-color: rgb(238, 204, 85); background-position: initial initial; background-repeat: initial initial;">
  				        <td width="18%" bgcolor="#e8e8e8" rowspan="4" style="border-bottom: #ddd 1px solid"><span style="color: #808080"><strong>个人意外伤害和医疗保障</strong></span></td>
  				        <td align="left" width="65%"><span style="color: #808080"><strong>意</strong></span><span style="color: #808080"><strong>外身故、烧伤及残疾保障</strong><br>
  				        </span>旅行期间因意外事故导致身故、烧伤或残疾，我们将一次性给付保险金。</td>
  				        <td>200,000</td>
  				        <td>300,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(248, 248, 248); background-position: initial initial; background-repeat: initial initial;">
  				        <td align="left"><span style="color: #808080"><strong>医药补偿</strong><br>
  				        </span>旅行期间因意外事故或罹患疾病需治疗。可获实际医药费用补偿。</td>
  				        <td>50,000</td>
  				        <td>80,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;">
  				        <td align="left" style="border-bottom: #ddd 1px solid"><span style="color: #808080"><strong>每日住院津贴</strong><br>
  				        </span>旅行期间因意外事故或罹患疾病需入院治疗，可按住院天数获每日住院津贴。（总赔偿日数以90天为限）</td>
  				        <td style="border-bottom: #ddd 1px solid">100/天</td>
  				        <td style="border-bottom: #ddd 1px solid">100/天</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(248, 248, 248); background-position: initial initial; background-repeat: initial initial;">
  				        <td align="left"><span style="color: #808080"><strong>旅行绑架和非法拘禁（每24小时赔偿额：RMB3，000）</strong><br>
  				        </span>若被保险人在旅行期间遭受绑架或非法拘禁，我们会根据实际被绑架或被非法拘禁的日数补偿该被保险人。</td>
  				        <td>12,000</td>
  				        <td>15,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;">
  				        <td bgcolor="#e8e8e8" rowspan="3" style="border-bottom: #ddd 1px solid"><span style="color: #808080"><strong>紧急救援</strong></span></td>
  				        <td align="left"><span style="color: #808080"><strong>紧急医疗运送和送返</strong><br>
  				        </span>旅行期间因意外事故或罹患疾病，我们将承担医疗运送和送返（Travel Guard）所发生的费用。</td>
  				        <td>400,000</td>
  				        <td>400,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(248, 248, 248); background-position: initial initial; background-repeat: initial initial;">
  				        <td align="left"><span style="color: #808080"><strong>身故遗体送返</strong><br>
  				        </span>旅行期间因意外事故或罹患疾病不幸身故，我们将承担安排遗体送返（Travel Guard）所发生的费用。</td>
  				        <td>80,000</td>
  				        <td>80,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;">
  				        <td align="left"><span style="color: #808080"><strong>未成年人旅行送返费用补偿</strong><br>
  				        </span>旅行期间被保险人罹患疾病需住院治疗或不幸身故，我们将承担一张与被保险人通行的未满18周岁未成年孩子返回中国常住地的经济舱机票或者补偿改签机票的差价。</td>
  				        <td>2,000</td>
  				        <td>3,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(248, 248, 248); background-position: initial initial; background-repeat: initial initial;">
  				        <td bgcolor="#e8e8e8" style="border-bottom: #ddd 1px solid"><span style="color: #808080"><strong>个人责任</strong></span></td>
  				        <td align="left" style="border-bottom: #ddd 1px solid">我们承担旅行期间意外事故导致他人身体或财物损失而需支付给第三方的赔偿金。</td>
  				        <td style="border-bottom: #ddd 1px solid">80，000</td>
  				        <td style="border-bottom: #ddd 1px solid">400，000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;">
  				        <td bgcolor="#e8e8e8" style="border-bottom: #ddd 1px solid"><span style="color: #808080"><strong>旅程阻碍保障</strong></span></td>
  				        <td align="left" tyle="border-bottom: #ddd 1px solid" salign="left"><span style="color: #808080"><strong>旅行延误Travel Delay</strong><br>
  				        </span>若由于恶劣天气、罢工、航空共识超售或航空管制等原因而导致飞机或轮船，每延误5小时，可获赔偿RMB300元</td>
  				        <td style="border-bottom: #ddd 1px solid">600</td>
  				        <td style="border-bottom: #ddd 1px solid">600</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(248, 248, 248); background-position: initial initial; background-repeat: initial initial;">
  				        <td bgcolor="#e8e8e8" rowspan="3" style="border-bottom: #ddd 1px solid"><span style="color: #808080"><strong>个人财物保障</strong></span></td>
  				        <td align="left" style="border-bottom: #ddd 1px solid"><span style="color: #808080"><strong>个人随身财产</strong><br>
  				        </span>旅行期间被保险人随身财产被盗窃或抢劫，或因其他第三方责任遗失、意外损坏，可获赔偿。(其中：每件或每套行李或物品最高赔偿额RMB2，500 元)</td>
  				        <td style="border-bottom: #ddd 1px solid">2,500</td>
  				        <td style="border-bottom: #ddd 1px solid">5,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;">
  				        <td align="left"><span style="color: #808080"><strong>银行卡盗刷（不适用于未成年人）</strong><br>
  				        </span>赔偿被保险人在旅行期间由于银行卡丢失或失窃而造成非授权人非法使用银行卡所发生的帐款损失。（帐款损失须于挂失或失窃银行卡之前的48小时内发生）</td>
  				        <td>5,000</td>
  				        <td>10,000</td>
  				    </tr>
  				    <tr align="center" style="background-color: rgb(248, 248, 248); background-position: initial initial; background-repeat: initial initial;">
  				        <td align="left"><span style="color: #808080"><strong>旅行证件遗失</strong><br>
  				        </span>赔偿被保险人为重置因被抢劫或盗窃而损失的护照、旅行票据等旅行证件所支付的费用及相关交通、住宿费用。</td>
  				        <td>4,000</td>
  				        <td>5,000</td>
  				    </tr>
    			</tbody>
			</table>
		</div>
		<div>
			<h3><a id="c3">保险费表</a></h3>
			<table class="baoxianTabBox" cellspacing="1" cellpadding="2" width="100%" align="center" border="0">
		   		<tbody>
		   		    <tr class="bxtitleBg">
		   		        <td rowspan="2">保险期限</td>
		   		        <td colspan="2">成年人保险费(单位：元)</td>
		   		        <td colspan="2">未成年人保险费(单位：元)</td>
		   		    </tr>
		   		    <tr class="bxtitleBg">
		   		        <td>计划一</td>
		   		        <td>计划二</td>
		   		        <td>计划一</td>
		   		        <td>计划二</td>
		   		    </tr>
		   		</tbody>
		   		<tbody id="setbg" name="setbg">
		   		    <tr align="center" style="background-color: rgb(238, 204, 85); background-position: initial initial; background-repeat: initial initial;">
		   		        <td>1~5 天</td>
		   		        <td>45</td>
		   		        <td>55</td>
		   		        <td>40</td>
		   		        <td>45</td>
		   		    </tr>
		   		    <tr align="center" style="background-color: rgb(248, 248, 248); background-position: initial initial; background-repeat: initial initial;">
		   		        <td>超过5天每天增加</td>
		   		        <td>10</td>
		   		        <td>15</td>
		   		        <td>5</td>
		   		        <td>10</td>
		   		    </tr>
		   		</tbody>
			</table>
		</div>
		<div>
			<h3><a id="c4">特别提醒</a></h3>
			<ul>
			    <li>本计划项下最高给付金额以保险单上被保险人的保险金额为限。</li>
			    <li>本计划的投保年龄为1-80周岁。71至80周岁的被保险人，其“意外身故、烧伤及残疾保障”和"双倍给付意外伤害"的保险金额为上表所载金额的一半，保险费维持不变。</li>
			    <li>未满18周岁的未成年人的“意外身故、烧伤及残疾保障”的保险金额为10万元。</li>
			    <li><strong>如果申请投保的18周岁以下的未成年人已在本保险公司或其他保险公司参保以死亡为给付保险金条件的人身保险，则本保险公司不接受为该未成年人投保本保险的申请。请为其投保本保险公司特别设计的“小探险家少儿旅行保险计划”。</strong></li>
			    <li>本保险不承保任何直接或间接由于前往或途经阿富汗、缅甸、古巴、刚果民主共和国、伊朗、伊拉克、利比里亚、苏丹、叙利亚，或在上述国家旅行期间发生的保险事故。</li>
			    <li>本保险不承保任何国家或国际组织认定的恐怖分子或恐怖组织成员，或非法从事毒品、核武器、生物或化学武器交易人员。</li>
			    <li>每人每次限投一份。&nbsp;</li>
			</ul>
		</div>
		<div>
			<h3><a id="c5">主要责任免除</a></h3>
			<ul>
			   <li>战争、军事行动、暴乱、罢工或武装叛乱。</li>
			   <li>任何生物、化学、原子能武器、原子能或核能装置所造成的爆炸、灼伤或辐射。</li>
			   <li>投保人的故意行为；或被保险人无论当时神志是否清醒，被保险人自致伤害或自杀。</li>
			</ul>
		</div>
		<div>
			<h3><a id="c6">理赔指南</a></h3>
			<ul>
			    <li><a href="/doc/contact-c.htm">联络本保险公司</a>或<a href="/doc/contact-g.htm">代理机构</a>，索取<a href="/insure/projs/lvyezyrlp.zip">理赔申请表格</a>。</li>
			    <li>填妥并递交索赔申请表格及有关证明文件，包括医院或医生报告、医药费用原始收据、警方或承运人证明等。</li>
			    <li>美亚将及时<a href="/doc/flow-c.htm">处理索赔</a>，于十个工作日内给您回复。</li>
			</ul>
		</div>
		<div>
			<h3><a id="c7">亚美保险重要提示</a></h3>
			<ul>
			    <li>本文所述只提供概要介绍，并不涵盖所述保险合同所有的条款、条件和除外事项。如欲了解保险范围和除外事项的详细內容，请参阅&nbsp;<img alt="" style="margin-bottom: -1px" src="/imgs/download.gif"><a href="/insure/projs/tk_lyy.zip">美亚“乐悠游”境外旅行保障计划保险条款</a>。</li>
			    <li>本文仅为一般性介绍，不得被视为咨询意见。如需要对您的保险需求或现有保障提供咨询，应联络美亚服务热线。</li>
			    <li>美亚保险已依法设立分公司的北京市、上海市、江苏省、广东省或深圳市辖区内，将有利于保障您或者被保险人获取便利的保险服务, 如有疑问，请打美亚全国热线号码400-820-8858咨询。</li>
			    <li>本计划由美亚财产保险有限公司北京分公司承保，美亚财产保险有限公司目前在上海、北京、广东省、深圳、江苏省设有相关分支机构，您通过绿野保险购买的保险产品，后续变更与理赔事务均可由百川保险协助您办理。</li>
			    <li>美亚保险全国统一服务热线：<strong>400－820－8858</strong>， 服务热线开通时间： <strong>9:00 - 17:30</strong> (周六、周日、节假日除外)</li>
			    <li>百川保险全国统一服务热线：<strong>400 890 4188</strong>， 服务热线开通时间： <strong>9:00 - 17:30</strong> (周六、周日、节假日除外)&nbsp;</li>
			</ul>
		</div>
	</div>
</div>