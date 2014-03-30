<div id="main">
<div id="vleft">

    <!--常用下载-->
    <ul class="titlelist">
        <li class="title"><span style="width: 52%"><b>·&nbsp;</b>常用下载</span>
            <span class="more"><a href="/Visa/VisaAssociationList?VisaAssociationType=MaterialDownload&amp;Keyword=%E8%8F%B2%E5%BE%8B%E5%AE%BE" target="_blank">
                    更多&gt;&gt;
                </a></span>
        </li>
        <li class="item" title="单击下载"><a href="/Visa/GetFileFromDisk?fileName=%E8%8F%B2%E7%AD%BE59%E5%A4%A9%E5%9F%BA%E6%9C%AC%E8%B5%84%E6%96%99%E8%A1%A8%E6%A0%B7%E6%9D%BF.rar" title="单击下载"><b>·&nbsp;</b>菲签59天基本资料表样板</a>
        </li>
        <li class="item" title="单击下载"><a href="/Visa/GetFileFromDisk?fileName=%E8%8F%B2%E5%BE%8B%E5%AE%BE%E6%AD%A3%E8%A7%84%E7%94%B3%E8%AF%B7%E8%A1%A8%E7%A9%BA%E7%99%BD.rar" title="单击下载"><b>·&nbsp;</b>菲律宾正规申请表空白</a>
        </li>
        <li class="item" title="单击下载"><a href="/Visa/GetFileFromDisk?fileName=%E8%8F%B2%E5%BE%8B%E5%AE%BE%E6%AD%A3%E8%A7%84%E7%94%B3%E8%AF%B7%E8%A1%A8%E5%A1%AB%E5%86%99%E6%A0%B7%E6%9D%BF.rar" title="单击下载"><b>·&nbsp;</b>菲律宾正规申请表填写样板</a>
        </li>
    </ul>
    <br>
</div>
<div id="vright">
<div>
    <img src="/static/yutong/img/Nv/003.jpg"></div>
<script type="text/javascript">
    $(function(){
        //搜索国家
        $("#KeyWord").keyup(function () {
            var tThis = $(this);
            $("#likeSearch").remove();
            var valuess = tThis.val();
            var url = "/Country/AjaxSearch"+ "?code=" + encodeURI(valuess);
            $.ajax({
                url: url,
                dataType: 'html',
                success: function (data) {
                    $(".popupcountry").hide();
                    $("#popupcountry").hide();
                    $(data).appendTo($("body"));
                    $("#likeSearch").hide();
                    var tTop = tThis.parent("span").offset().top+tThis.height()+1;
                    var tLeft = tThis.parent("span").offset().left;
                    $("#likeSearch").css({ "top": tTop, "left": tLeft,"width":"365px" });
                    $("#likeSearch").show();
                },  error: function () {
                    alert("error");
                }
            });
        }).focus(function(){
            countryFocus = true;
            var tThis = $(this);
            if(tThis.val()=="支持关键字和拼音模糊查询"){
                tThis.val("");
            }

            var tTop = tThis.parent("span").offset().top+tThis.height()+1;
            var tLeft = tThis.parent("span").offset().left;
            $(".popupcountry").css({ "top": tTop, "left": tLeft }).show();

            return false;
        });

    });
</script>
<form action="/Visa" id="searchFrm" method="get">    <ul class="findc">
        <li style="width: 15%;">
            <label>
                请输入国家名：</label></li>
        <li style="width: 400px;"><span>
            <input type="text" id="KeyWord" name="KeyWord" value="菲律宾" class="textbox  validate[required]" style="width: 355px; color: #999999;padding:5px; font-size:larger" maxlength="50">
        </span></li>
        <li style="width: 15%;">
            <input type="submit" class="btn" value="查询">
        </li>
    </ul>
</form>
<!--
    操作结果时，给出信息提示
-->
<form action="/Order/Create" id="createOrderFrm" method="post"><input data-val="true" data-val-number="The field LoginId must be a number." data-val-required="The LoginId field is required." id="LoginId" name="LoginId" type="hidden" value="0"><input data-val="true" data-val-number="The field VisaId must be a number." data-val-required="The VisaId field is required." id="VisaId" name="VisaId" type="hidden" value="63"><input data-val="true" data-val-number="The field Price must be a number." data-val-required="The Price field is required." id="Price" name="Price" type="hidden" value="480.0000"><input id="Keyword" name="Keyword" type="hidden" value="菲律宾"><input data-val="true" data-val-number="The field InsuranNum must be a number." data-val-required="The InsuranNum field is required." id="InsuranNum" name="InsuranNum" type="hidden" value=""><input data-val="true" data-val-number="The field InsurancePrice must be a number." data-val-required="The InsurancePrice field is required." id="InsurancePrice" name="InsurancePrice" type="hidden" value="92.00"><input data-val="true" data-val-number="The field OriginalPrice must be a number." data-val-required="The OriginalPrice field is required." id="OriginalPrice" name="OriginalPrice" type="hidden" value="115.00"><input data-val="true" data-val-number="The field InsuranceTypeId must be a number." data-val-required="The InsuranceTypeId field is required." id="InsuranceTypeId" name="InsuranceTypeId" type="hidden" value="47"><input id="PlanCode" name="PlanCode" type="hidden" value="">            <!--创建订单-->
<ul class="cor" style="width: 98%;">
<li>
    <ul>
        <li>
            <label>
                签证国家：</label><input id="CurrencyCountryName" name="CurrencyCountryName" type="hidden" value="菲律宾">
            菲律宾 </li>
        <li>
            <label>
                签证类型：</label>旅游两天加急</li>
    </ul>
</li>
<li>
    <ul>
        <li>
            <label>
                签证人数：</label><small class="required">*</small>
            <input class="textbox validate[custom[onlyNumberNotZero]]" data-val="true" data-val-number="The field Number must be a number." data-val-required="The Number field is required." id="Number" maxlength="3" name="Number" style="width:100px" type="text" value="0">
        </li>
        <li>
            <label>
                签证价格：
            </label>
            ￥480</li>
    </ul>
</li>
<li>
    <ul>
        <li>
            <label>
                出发时间：</label><small class="required">*</small>
            <input class="textbox validate[required]" data-val="true" data-val-required="The DepartureDate field is required." id="DepartureDate" name="DepartureDate" onclick="WdatePicker({lang:'zh-CN'})" style="width:100px" type="text" value="0001-1-1 0:00:00">&nbsp;格式：1990-01-01
        </li>
        <li>
            <label>
                团号(如有)：</label>
            <input class="textbox" id="TuanNo" name="TuanNo" style="width:100px" type="text" value="">
        </li>
    </ul>
</li>

<li>
    <label>
        签证人姓名：</label><small class="required">*</small>
    <textarea class="textbox validate[required]" cols="50" data-val="true" data-val-required="The VisaName field is required." id="VisaName" name="VisaName" rows="3"></textarea>
    &nbsp;<label style="color: red; width: 170px;">注：如有多人，请用逗号隔开<br>
        例如：张三，李四，王五</label>
</li>
<li>
    <div style="float: left; width: 25%;">
        <label>
            是否上门收件：</label>
        <input data-val="true" data-val-number="The field ChargeCard must be a number." data-val-required="The ChargeCard field is required." id="ChargeCard" name="ChargeCard" onclick="isChargeCard(this)" type="radio" value="1">
        是&nbsp;
        <input checked="True" id="ChargeCard" name="ChargeCard" onclick="isChargeCard(this)" type="radio" value="0">否
    </div>
    <strong>
        <div id="IsChargeCard" style="display: none; float: left; width: 60%; color: Red;">
            您提交订单后，收件员将会上门收件，请确认资料已经在您手中。</div>
    </strong></li>
<li>
    <label>
        特殊要求：</label><small class="required">&nbsp;</small>
    <textarea class="textbox" cols="50" id="OtherRemark" name="OtherRemark" rows="3"></textarea>
</li>
<li>
    <label>
        护照返回地址：</label>
    <input data-val="true" data-val-required="The IsCompanyAddress field is required." id="IsCompanyAddress" name="IsCompanyAddress" onclick="useNewAddress(this)" type="radio" value="true">
    使用公司地址&nbsp;
    <input checked="checked" id="IsCompanyAddress" name="IsCompanyAddress" onclick="useNewAddress(this)" type="radio" value="false">
    使用其他地址</li>
<div id="insureUl2" style="display: block">
    <div class="selinsnrancenew" style="width: 500px; margin-left: 100px;">
        公司：<input class="textbox" id="CompanyName" maxlength="50" name="CompanyName" style="width:100px" type="text" value="北京美景假期国际旅行社有限公司建国东路门市部" readonly="">
        地址：<input class="textbox validate[required]" data-val="true" data-val-required="The CompanyAddress field is required." id="CompanyAddress" maxlength="200" name="CompanyAddress" style="width:250px" type="text" value="北京市东城区东直门外东中街40号元嘉国际A座407" readonly=""><br>
        <br>
        联系人：<input class="textbox validate[required]" data-val="true" data-val-required="The ReceiverName field is required." id="ReceiverName" maxlength="10" name="ReceiverName" style="width:100px" type="text" value="沐文生" readonly="">
        电话：<input class="textbox validate[required]" data-val="true" data-val-required="The ReceiverPhone field is required." id="ReceiverPhone" maxlength="20" name="ReceiverPhone" style="width:100px" type="text" value="010-56292115" readonly=""></div>
</div>
<br>
                <span style="width: 500px; margin-left: 100px; ">备注：地址若有误，
<a href="/Member/Edit?me=7&amp;mid=member1" style="color:red;" target="_blank">点此修改</a>                    ，一劳永逸</span><br>
<br>


<li>
    <label>
        是否需要保险：</label>
    <input data-val="true" data-val-required="The IsInsurance field is required." id="IsInsurance" name="IsInsurance" onclick="isInsurance(this)" type="radio" value="true">
    是&nbsp;
    <input checked="checked" id="IsInsurance" name="IsInsurance" onclick="isInsurance(this)" type="radio" value="false">
    否
</li>
<li>
    <div id="insureUl" style="display: none">
        <div class="selinsnrancenew">
            <div>
                &nbsp;保险类型&nbsp;<select class="selectbox" id="InsuranceType" name="InsuranceType" onchange="serarchInsuranceInfo()" style="width:300px;"><option value="47">平安"快乐旅程Ⅲ"计划二（全面型）</option>
                    <option value="48">平安"快乐旅程Ⅲ"计划三（豪华型）</option>
                    <option value="46">平安"快乐旅程Ⅲ"计划一（经济型）</option>
                    <option value="43">安联“全球商旅通”保障-计划一</option>
                    <option value="44">安联“全球商旅通”保障-计划二</option>
                    <option value="45">安联“全球商旅通”保障-计划三</option>
                    <option value="17">泰康环球旅程-A</option>
                    <option value="18">泰康环球旅程-B</option>
                    <option value="19">泰康环球旅程-C</option>
                    <option value="1">平安"商旅护航"亚洲基础计划(除日本)</option>
                    <option value="2">平安"商旅护航"欧洲基础计划</option>
                    <option value="3">平安"商旅护航"全球基础计划</option>
                    <option value="13">平安乐途-经济型</option>
                    <option value="14">平安"商旅护航"亚洲全面计划(除日本)</option>
                    <option value="15">平安"商旅护航"欧洲全面计划</option>
                    <option value="16">平安"商旅护航"全球全面计划</option>
                    <option value="26">平安乐途-全面型</option>
                    <option value="20">泰康环球畅游-A</option>
                    <option value="21">泰康环球畅游-B</option>
                    <option value="22">泰康环球畅游-C</option>
                    <option value="24">泰康环球至尊-B</option>
                    <option value="23">泰康环球至尊-A</option>
                    <option value="25">泰康环球至尊-C</option>
                    <option value="60">安联安享全球计划</option>
                    <option value="58">安联乐享全球计划</option>
                    <option value="57">安联畅享全球计划</option>
                    <option value="59">安联尊享全球计划</option>
                    <option value="49">美亚万国游踪-白银计划</option>
                    <option value="50">美亚万国游踪-黄金计划</option>
                    <option value="51">美亚万国游踪-钻石计划</option>
                    <option value="52">美亚乐悠游-计划1</option>
                    <option value="53">美亚乐悠游-计划2</option>
                    <option value="61">安联畅享亚洲旅行保障计划一</option>
                    <option value="62">安联畅享亚洲旅行保障计划二</option>
                    <option value="63">安联畅享亚洲旅行保障计划三</option>
                    <option value="64">安联安享宝岛台湾旅行保障计划一</option>
                    <option value="65">安联安享宝岛台湾旅行保障计划二</option>
                    <option value="66">安联安享宝岛台湾旅行保障计划三</option>
                    <option value="67">平安"快乐旅程Ⅲ"签证宝计划</option>
                    <option value="12">平安“航空意外险”</option>
                </select>
            </div>
            <br>
            <div>
                &nbsp;年龄&nbsp;<select id="AgeRange" name="AgeRange" style="width:80px;"><option value="0-80周岁">0-80周岁</option></select>
                &nbsp;由&nbsp;
                <input class="textbox validate[required]" id="StartTime" name="StartTime" onclick="WdatePicker({lang:'zh-CN'})" onfocus="loadPrice()" style="width:80px;" type="text" value="2014-03-31">
                &nbsp;至&nbsp; <input class="textbox validate[required]" id="EndTime" name="EndTime" onclick="WdatePicker({lang:'zh-CN'})" onfocus="loadPrice()" style="width:80px;" type="text" value="2014-03-30">
                <input type="button" id="btnInsuranceTypeSearch" value="搜 索" style="color: White" class="smallbtn">
                <span id="planCodeName" style="display: none;">00821</span><span class="label">共计<span id="lblDays1">7</span>天 人均保费 <span id="lblPrice">92.00</span>元</span>
            </div>
            <br>
            <div id="divInsuranceData">

                <ul style="background-color: #d9e4f7;">
                    <li style="width: 5%;">选择</li>
                    <li style="width: 15%;">市场价</li>
                    <li style="width: 15%;">优惠价</li>
                    <li style="width: 15%;">天数</li>
                    <li style="width: 40%; *width: 38%;">描述</li>
                    <li style="width: 5%; *width: 5%;">操作</li>
                </ul>
                <ul>
                    <li style="width: 5%;">
                        <input type="radio" value="478" checked="checked" onclick="clickRadio(this)" name="InsuranceId" id="InsuranceId">
                    </li>
                    <li style="width: 15%;">115.00</li>
                    <li style="width: 15%;">92.00</li>
                    <li style="width: 15%;">1-7天</li>
                    <li style="width: 40%; *width: 38%">
                        平安"快乐旅程Ⅲ"计划二</li>
                    <li style="width: 5%; *width: 5%;">
                        <a href="/Insurance/InsuranceNew/47" target="_blank">详细</a>
                    </li>
                </ul>
                <ul>
                    <li style="width: 5%;">
                        <input type="radio" value="489" name="InsuranceId" onclick="clickRadio(this)" id="InsuranceId">
                    </li>
                    <li style="width: 15%;">1200.00</li>
                    <li style="width: 15%;">960.00</li>
                    <li style="width: 15%;">年度保障（每次出境不超过90天）</li>
                    <li style="width: 40%; *width: 38%">
                        平安"快乐旅程Ⅲ"计划二</li>
                    <li style="width: 5%; *width: 5%;">
                        <a href="/Insurance/InsuranceNew/47" target="_blank">详细</a>
                    </li>
                </ul></div>
        </div>
    </div>
</li>
<li id="insurePriceLi" style="display: none">
<div class="ic_addinsurancenum" style="margin-left: 0;">
<div class="addbtn" style="width:700px;background-image:url(/Content/Images/bg1.gif)">
    <input type="button" class="button" value=" " id="btnAddInsurancePersonal">
    <span>(当前<label id="lblPersonalNum1" style="display: inline;">1</label>人)</span>
                            <span style="margin-left: 57px;">
                                <label style="display: inline-block; width: 50px;">
                                    前往国家</label><span> 
                                        <input class="validate[required]" id="CountryName" maxlength="1000" name="CountryName" readonly="readonly" style="width:300px;" type="text" value="菲律宾">
                                        <input type="button" id="btnSelCountry" style="background: #f1f8b4; width: 70px;
                                            height: 25px; border: 1px solid #ababab; background-image: url(../../Content/Images/18_1.png);
                                            border: 0; color: White; font-weight: 800" value="选择国家" class="bigsubmit">
                                    </span>
                        </span></div>
<div class="ic_cform" style="margin-left: 0;">
<script type="text/javascript">
    /*将中文转换为拼音*/
    function ChineseToPinyin(ele,ele1){
        $.ajax({
            url: "/Insurance/ChineseToPingYing",
            data: {"chineseCode":$(ele).val()},
            dataType: "json",
            success: function (data) {
                $(ele1).val(data);
            }
        });
    }
</script>
<div class="item" id="divNewInsurancePersonal">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人1</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName" maxlength="50" name="PersonalName" onchange="ChineseToPinyin('#PersonalName','#NamePinYin')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin" maxlength="50" name="NamePinYin" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate" name="Birthdate" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex" name="Sex" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select>
            <br>
            <label>
                证件类型</label><select id="CertificateType" name="CertificateType" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo" maxlength="18" name="CertificateNo" style="width:130px;" type="text" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人1</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName" maxlength="50" name="ApplicantName" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone" maxlength="50" name="ApplicantPhone" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate" name="ApplicantBirthdate" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex" name="ApplicantSex" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select>
            <br>
            <label>
                证件类型</label><select id="ApplicantCertificateType" name="ApplicantCertificateType" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo" maxlength="18" name="ApplicantCertificateNo" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel" name="ApplicantInsuredRel" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal2" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人2</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName2" maxlength="50" name="PersonalName2" onchange="ChineseToPinyin('#PersonalName2','#NamePinYin2')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin2" maxlength="50" name="NamePinYin2" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate2" name="Birthdate2" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex2" name="Sex2" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType2" name="CertificateType2" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo2" maxlength="18" name="CertificateNo2" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation2" name="Validation2" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人2</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName2" maxlength="50" name="ApplicantName2" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone2" maxlength="50" name="ApplicantPhone2" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate2" name="ApplicantBirthdate2" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex2" name="ApplicantSex2" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType2" name="ApplicantCertificateType2" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo2" maxlength="18" name="ApplicantCertificateNo2" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel2" name="ApplicantInsuredRel2" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal3" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人3</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName3" maxlength="50" name="PersonalName3" onchange="ChineseToPinyin('#PersonalName3','#NamePinYin3')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin3" maxlength="50" name="NamePinYin3" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate3" name="Birthdate3" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex3" name="Sex3" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType3" name="CertificateType3" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo3" maxlength="18" name="CertificateNo3" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation3" name="Validation3" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人3</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName3" maxlength="50" name="ApplicantName3" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone3" maxlength="50" name="ApplicantPhone3" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate3" name="ApplicantBirthdate3" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex3" name="ApplicantSex3" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType3" name="ApplicantCertificateType3" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo3" maxlength="18" name="ApplicantCertificateNo3" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel3" name="ApplicantInsuredRel3" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal4" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人4</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName4" maxlength="50" name="PersonalName4" onchange="ChineseToPinyin('#PersonalName4','#NamePinYin4')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin4" maxlength="50" name="NamePinYin4" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate4" name="Birthdate4" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex4" name="Sex4" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType4" name="CertificateType4" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo4" maxlength="18" name="CertificateNo4" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation4" name="Validation4" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人4</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName4" maxlength="50" name="ApplicantName4" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone4" maxlength="50" name="ApplicantPhone4" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate4" name="ApplicantBirthdate4" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex4" name="ApplicantSex4" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType4" name="ApplicantCertificateType4" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo4" maxlength="18" name="ApplicantCertificateNo4" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel4" name="ApplicantInsuredRel4" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal5" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人5</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName5" maxlength="50" name="PersonalName5" onchange="ChineseToPinyin('#PersonalName5','#NamePinYin5')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin5" maxlength="50" name="NamePinYin5" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate5" name="Birthdate5" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex5" name="Sex5" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType5" name="CertificateType5" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo5" maxlength="18" name="CertificateNo5" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation5" name="Validation5" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人5</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName5" maxlength="50" name="ApplicantName5" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone5" maxlength="50" name="ApplicantPhone5" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate5" name="ApplicantBirthdate5" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex5" name="ApplicantSex5" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType5" name="ApplicantCertificateType5" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo5" maxlength="18" name="ApplicantCertificateNo5" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel5" name="ApplicantInsuredRel5" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal6" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人6</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName6" maxlength="50" name="PersonalName6" onchange="ChineseToPinyin('#PersonalName6','#NamePinYin6')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin6" maxlength="50" name="NamePinYin6" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate6" name="Birthdate6" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex6" name="Sex6" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType6" name="CertificateType6" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo6" maxlength="18" name="CertificateNo6" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation6" name="Validation6" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人6</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName6" maxlength="50" name="ApplicantName6" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone6" maxlength="50" name="ApplicantPhone6" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate6" name="ApplicantBirthdate6" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex6" name="ApplicantSex6" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType6" name="ApplicantCertificateType6" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo6" maxlength="18" name="ApplicantCertificateNo6" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel6" name="ApplicantInsuredRel6" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal7" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人7</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName7" maxlength="50" name="PersonalName7" onchange="ChineseToPinyin('#PersonalName7','#NamePinYin7')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin7" maxlength="50" name="NamePinYin7" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate7" name="Birthdate7" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex7" name="Sex7" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType7" name="CertificateType7" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo7" maxlength="18" name="CertificateNo7" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation7" name="Validation7" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人7</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName7" maxlength="50" name="ApplicantName7" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone7" maxlength="50" name="ApplicantPhone7" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate7" name="ApplicantBirthdate7" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex7" name="ApplicantSex7" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType7" name="ApplicantCertificateType7" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo7" maxlength="18" name="ApplicantCertificateNo7" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel7" name="ApplicantInsuredRel7" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal8" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人8</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName8" maxlength="50" name="PersonalName8" onchange="ChineseToPinyin('#PersonalName8','#NamePinYin8')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin8" maxlength="50" name="NamePinYin8" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate8" name="Birthdate8" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex8" name="Sex8" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType8" name="CertificateType8" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo8" maxlength="18" name="CertificateNo8" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation8" name="Validation8" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人8</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName8" maxlength="50" name="ApplicantName8" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone8" maxlength="50" name="ApplicantPhone8" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate8" name="ApplicantBirthdate8" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex8" name="ApplicantSex8" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType8" name="ApplicantCertificateType8" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo8" maxlength="18" name="ApplicantCertificateNo8" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel8" name="ApplicantInsuredRel8" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal9" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人9</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName9" maxlength="50" name="PersonalName9" onchange="ChineseToPinyin('#PersonalName9','#NamePinYin9')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin9" maxlength="50" name="NamePinYin9" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate9" name="Birthdate9" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex9" name="Sex9" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType9" name="CertificateType9" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo9" maxlength="18" name="CertificateNo9" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation9" name="Validation9" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人9</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName9" maxlength="50" name="ApplicantName9" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone9" maxlength="50" name="ApplicantPhone9" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate9" name="ApplicantBirthdate9" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex9" name="ApplicantSex9" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType9" name="ApplicantCertificateType9" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo9" maxlength="18" name="ApplicantCertificateNo9" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel9" name="ApplicantInsuredRel9" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal10" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人10</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName10" maxlength="50" name="PersonalName10" onchange="ChineseToPinyin('#PersonalName10','#NamePinYin10')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin10" maxlength="50" name="NamePinYin10" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate10" name="Birthdate10" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex10" name="Sex10" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType10" name="CertificateType10" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo10" maxlength="18" name="CertificateNo10" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation10" name="Validation10" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人10</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName10" maxlength="50" name="ApplicantName10" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone10" maxlength="50" name="ApplicantPhone10" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate10" name="ApplicantBirthdate10" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex10" name="ApplicantSex10" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType10" name="ApplicantCertificateType10" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo10" maxlength="18" name="ApplicantCertificateNo10" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel10" name="ApplicantInsuredRel10" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal11" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人11</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName11" maxlength="50" name="PersonalName11" onchange="ChineseToPinyin('#PersonalName11','#NamePinYin11')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin11" maxlength="50" name="NamePinYin11" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate11" name="Birthdate11" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex11" name="Sex11" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType11" name="CertificateType11" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo11" maxlength="18" name="CertificateNo11" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation11" name="Validation11" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人11</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName11" maxlength="50" name="ApplicantName11" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone11" maxlength="50" name="ApplicantPhone11" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate11" name="ApplicantBirthdate11" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex11" name="ApplicantSex11" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType11" name="ApplicantCertificateType11" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo11" maxlength="18" name="ApplicantCertificateNo11" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel11" name="ApplicantInsuredRel11" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal12" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人12</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName12" maxlength="50" name="PersonalName12" onchange="ChineseToPinyin('#PersonalName12','#NamePinYin12')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin12" maxlength="50" name="NamePinYin12" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate12" name="Birthdate12" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex12" name="Sex12" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType12" name="CertificateType12" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo12" maxlength="18" name="CertificateNo12" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation12" name="Validation12" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人12</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName12" maxlength="50" name="ApplicantName12" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone12" maxlength="50" name="ApplicantPhone12" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate12" name="ApplicantBirthdate12" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex12" name="ApplicantSex12" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType12" name="ApplicantCertificateType12" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo12" maxlength="18" name="ApplicantCertificateNo12" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel12" name="ApplicantInsuredRel12" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal13" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人13</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName13" maxlength="50" name="PersonalName13" onchange="ChineseToPinyin('#PersonalName13','#NamePinYin13')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin13" maxlength="50" name="NamePinYin13" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate13" name="Birthdate13" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex13" name="Sex13" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType13" name="CertificateType13" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo13" maxlength="18" name="CertificateNo13" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation13" name="Validation13" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人13</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName13" maxlength="50" name="ApplicantName13" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone13" maxlength="50" name="ApplicantPhone13" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate13" name="ApplicantBirthdate13" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex13" name="ApplicantSex13" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType13" name="ApplicantCertificateType13" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo13" maxlength="18" name="ApplicantCertificateNo13" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel13" name="ApplicantInsuredRel13" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal14" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人14</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName14" maxlength="50" name="PersonalName14" onchange="ChineseToPinyin('#PersonalName14','#NamePinYin14')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin14" maxlength="50" name="NamePinYin14" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate14" name="Birthdate14" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex14" name="Sex14" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType14" name="CertificateType14" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo14" maxlength="18" name="CertificateNo14" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation14" name="Validation14" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人14</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName14" maxlength="50" name="ApplicantName14" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone14" maxlength="50" name="ApplicantPhone14" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate14" name="ApplicantBirthdate14" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex14" name="ApplicantSex14" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType14" name="ApplicantCertificateType14" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo14" maxlength="18" name="ApplicantCertificateNo14" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel14" name="ApplicantInsuredRel14" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal15" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人15</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName15" maxlength="50" name="PersonalName15" onchange="ChineseToPinyin('#PersonalName15','#NamePinYin15')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin15" maxlength="50" name="NamePinYin15" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate15" name="Birthdate15" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex15" name="Sex15" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType15" name="CertificateType15" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo15" maxlength="18" name="CertificateNo15" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation15" name="Validation15" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人15</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName15" maxlength="50" name="ApplicantName15" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone15" maxlength="50" name="ApplicantPhone15" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate15" name="ApplicantBirthdate15" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex15" name="ApplicantSex15" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType15" name="ApplicantCertificateType15" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo15" maxlength="18" name="ApplicantCertificateNo15" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel15" name="ApplicantInsuredRel15" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal16" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人16</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName16" maxlength="50" name="PersonalName16" onchange="ChineseToPinyin('#PersonalName16','#NamePinYin16')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin16" maxlength="50" name="NamePinYin16" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate16" name="Birthdate16" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex16" name="Sex16" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType16" name="CertificateType16" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo16" maxlength="18" name="CertificateNo16" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation16" name="Validation16" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人16</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName16" maxlength="50" name="ApplicantName16" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone16" maxlength="50" name="ApplicantPhone16" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate16" name="ApplicantBirthdate16" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex16" name="ApplicantSex16" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType16" name="ApplicantCertificateType16" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo16" maxlength="18" name="ApplicantCertificateNo16" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel16" name="ApplicantInsuredRel16" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal17" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人17</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName17" maxlength="50" name="PersonalName17" onchange="ChineseToPinyin('#PersonalName17','#NamePinYin17')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin17" maxlength="50" name="NamePinYin17" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate17" name="Birthdate17" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex17" name="Sex17" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType17" name="CertificateType17" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo17" maxlength="18" name="CertificateNo17" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation17" name="Validation17" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人17</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName17" maxlength="50" name="ApplicantName17" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone17" maxlength="50" name="ApplicantPhone17" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate17" name="ApplicantBirthdate17" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex17" name="ApplicantSex17" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType17" name="ApplicantCertificateType17" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo17" maxlength="18" name="ApplicantCertificateNo17" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel17" name="ApplicantInsuredRel17" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal18" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人18</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName18" maxlength="50" name="PersonalName18" onchange="ChineseToPinyin('#PersonalName18','#NamePinYin18')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin18" maxlength="50" name="NamePinYin18" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate18" name="Birthdate18" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex18" name="Sex18" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType18" name="CertificateType18" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo18" maxlength="18" name="CertificateNo18" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation18" name="Validation18" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人18</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName18" maxlength="50" name="ApplicantName18" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone18" maxlength="50" name="ApplicantPhone18" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate18" name="ApplicantBirthdate18" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex18" name="ApplicantSex18" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType18" name="ApplicantCertificateType18" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo18" maxlength="18" name="ApplicantCertificateNo18" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel18" name="ApplicantInsuredRel18" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal19" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人19</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName19" maxlength="50" name="PersonalName19" onchange="ChineseToPinyin('#PersonalName19','#NamePinYin19')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin19" maxlength="50" name="NamePinYin19" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate19" name="Birthdate19" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex19" name="Sex19" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType19" name="CertificateType19" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo19" maxlength="18" name="CertificateNo19" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation19" name="Validation19" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人19</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName19" maxlength="50" name="ApplicantName19" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone19" maxlength="50" name="ApplicantPhone19" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate19" name="ApplicantBirthdate19" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex19" name="ApplicantSex19" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType19" name="ApplicantCertificateType19" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo19" maxlength="18" name="ApplicantCertificateNo19" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel19" name="ApplicantInsuredRel19" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
<div class="item" id="divNewInsurancePersonal20" style="display: none">
    <ul>
        <li style="width: 10%; float: left;"><b>被保人20</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="PersonalName20" maxlength="50" name="PersonalName20" onchange="ChineseToPinyin('#PersonalName20','#NamePinYin20')" style="width:80px;" type="text" value="">
            <label>
                拼音</label><input class="validate[iR]" id="NamePinYin20" maxlength="50" name="NamePinYin20" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="Birthdate20" name="Birthdate20" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="Sex20" name="Sex20" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="CertificateType20" name="CertificateType20" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="CertificateNo20" maxlength="18" name="CertificateNo20" style="width:130px;" type="text" value="">
            <a href="javascript:hideLayer(this)">删除</a><input id="Validation20" name="Validation20" type="hidden" value="">
        </li>
    </ul>
    <ul style="display: none">
        <li style="width: 10%; float: left;"><b>投保人20</b></li>
        <li style="width: 90%; float: left; line-height: 27px;">
            <label>
                姓名</label><input class="validate[iR]" id="ApplicantName20" maxlength="50" name="ApplicantName20" style="width:80px;" type="text" value="">
            <label>
                联系电话</label><input class="validate[iR]" id="ApplicantPhone20" maxlength="50" name="ApplicantPhone20" style="width:130px;" type="text" value="">
            <label>
                出生日期</label><input type="text" id="ApplicantBirthdate20" name="ApplicantBirthdate20" onclick="WdatePicker({lang:'zh-CN'})" class="validate[iR]" style="width:80px;" maxlength="50">
            <label style="width: 35px">
                性别</label><select id="ApplicantSex20" name="ApplicantSex20" style="width:60px;"><option value="M">男</option>
                <option value="F">女</option>
            </select><br>
            <label>
                证件类型</label><select id="ApplicantCertificateType20" name="ApplicantCertificateType20" style="width:88px;"><option value="01">身份证</option>
                <option value="02">护照</option>
            </select>
            <label>
                证件号</label><input class="validate[iR]" id="ApplicantCertificateNo20" maxlength="18" name="ApplicantCertificateNo20" style="width:130px;" type="text" value="">
            <label>
                关系</label><select id="ApplicantInsuredRel20" name="ApplicantInsuredRel20" style="width:60px;"><option value="2">配偶</option>
                <option value="3">父子</option>
                <option value="4">父女</option>
                <option value="5">受益人</option>
                <option value="6">被保人</option>
                <option value="7">投保人</option>
                <option value="A">母子</option>
                <option value="B">母女</option>
                <option value="C">兄弟</option>
                <option value="D">姐弟</option>
                <option value="G">祖孙</option>
                <option value="H">雇佣</option>
                <option value="I">子女</option>
                <option value="9">其他</option>
                <option value="8">转换不详</option>
            </select>
        </li>
    </ul>
</div>
</div>
<div class="icc_c12">
    <div class="icchar_txt" style="width: 100%; overflow: hidden;">
        <ul style="float: none; overflow: hidden;">
            <li style="float: none; margin-left: 0; width: 100%;">旅行意外险每位被保险人限购一份,请勿重复添加被保险人。</li>
            <li style="float: none; margin-left: 0; width: 100%;">中国大陆居民请填写身份证号及姓名。其它国家和地区的居民请使用护照或其它在中国境内被认为有效的身份证件。</li>
            <li style="float: none; margin-left: 0; width: 100%;">出生日期栏，请按照“1997-07-01”的格式填写。中国大陆身份证号码中的出生日期会被自动填写。</li>
            <li style="float: none; margin-left: 0; width: 100%;">证件号码栏不允许使用汉字。</li>
            <li style="float: none; margin-left: 0; width: 100%;">要指定被保险人的邮箱、联系电话、身故受益人等更多详细信息，可在添加被保险人到列表后点击“修改”按钮</li>
            <li style="float: none; margin-left: 0; width: 100%;">未领取合法身份证件的婴幼儿，请填写形如“20080101”格式的出生日期代替身份证件号码。</li>
        </ul>
    </div>
    <div class="ic_total" style="width: 100%;">
        保险期限<label id="lblDays2" style="display: inline;">7</label>天，被保险人共计<label id="lblPersonalNum2" style="display: inline;">1</label>人，保费合计:RMB <b id="bTotalPrice">92</b>元
    </div>
</div>
</div>
</li>
<li style="text-align: center">
    <input type="submit" class="smallbtn" id="createOrderBtn" value="下单">
    &nbsp; &nbsp; &nbsp;<input type="button" class="smallbtn" value="返回" id="return">
</li>
</ul>
</form>    </div>
<!--弹出保险国家 开始-->
<script type="text/javascript">
$(function () {
    $("#btnSelCountry").click(function () {
        /*弹出提交确认层*/
        CreateBorder($("#divSelCountry"), 0.5);
    });
    $("#btnClear").click(function () {
        $("#lblSGCN").text("");
        $("#lblSGN").text("");
        $("#lblSGEN").text("");
        $("#lblSGNEN").text("");
        $("#lblFSG").text("");
        $("#lblLR").text("");
        $("input[type='checkbox']").each(function () {
            $(this).attr("checked", false);
        });
    });

    $("#btnClose").click(function () {
        /*隐藏确认层*/
        HidePopup($("#divSelCountry"), 0.5);
    });

    $("#btnSave").click(function () {
        $("#CountryName").val($("#liSelCountry").text());
        /*隐藏确认层*/
        HidePopup($("#divSelCountry"), 0.5);
    });

    $("#btnAddCountry").click(function () {
        var ic = $.trim($("#inputCountry").val());

        if (ic != "") {
            var isY = false;
            $("input[type='checkbox']").each(function () {
                if ($(this).val() == ic) {
                    isY = true;
                    return false;
                }
            });

            if (isY) { alert(ic + "已存在"); return false; }

            var cbx = $("<span class='lw'><input type='checkbox' name='cbxCountry' value='" + ic + "' />&nbsp;" + ic + " &nbsp;</span>");
            cbx.appendTo($("#liLR"));
            cbx.find("input[type='checkbox']").click(function () {
                var tv = $(this).val();
                var lbllr = $("#lblLR").text();
                var isexist = false;
                var lrs = lbllr.split(',');

                for (var i = 0; i < lrs.length; i++) {
                    if (lrs[i] == tv) {
                        isexist = true;
                        break;
                    }
                }

                if ($(this).attr("checked") && !isexist) {
                    if (lbllr != "") {
                        lbllr = lbllr + "," + tv;
                    } else {
                        lbllr = tv;
                    }

                } else {
                    if (lrs.length > 1) {
                        var j = 0;
                        for (var i = 0; i < lrs.length; i++) {
                            if (lrs[i] == tv) {
                                j = i;
                                break;
                            }
                        }
                        if (j == 0) {
                            lbllr = lbllr.replaceAll(tv + ",", "");
                        } else {
                            lbllr = lbllr.replaceAll("," + tv, "");
                        }
                    } else {
                        lbllr = lbllr.replaceAll(tv, "");
                    }
                }

                $("#lblLR").text(lbllr);

            });
        }
    });

    $("input[type='checkbox']").each(function () {
        $(this).click(function () {
            var tv = $(this).val();
            var temp = tv.split('-');
            var tppId = $(this).parent().parent().parent().attr("id");

            if (tv == "申根协议国家-SCHENGEN STATES") {
                if ($(this).attr("checked") && $("#lblSGN").val() == "") {
                    $("#lblSGN").text(temp[0] + " ");
                    $("#lblSGNEN").text(temp[1]);
                } else if (!$(this).attr("checked") && $("#lblSGCN").text() == "") {
                    $("#lblSGN").text("");
                    $("#lblSGNEN").text("");
                }

            } else if (tppId == "divSG") {

                var sgcn = temp[0];
                var lblsgcn = $("#lblSGCN").text();
                var sgen = temp[1];
                var lblsgen = $("#lblSGEN").text();

                var isexist = false;
                var sgcns = lblsgcn.split(',');
                for (var i = 0; i < sgcns.length; i++) {
                    if (sgcns[i] == sgcn) {
                        isexist = true;
                        break;
                    }
                }

                if ($(this).attr("checked") && !isexist) {
                    if (lblsgcn != "") {
                        lblsgcn = lblsgcn + sgcn + ",";
                    } else {
                        lblsgcn = sgcn + ",";
                    }
                    $("#lblSGCN").text(lblsgcn);


                    if (lblsgen != "") {
                        lblsgen = lblsgen + sgen + ",";
                    } else {
                        lblsgen = sgen + ",";
                    }

                    $("#lblSGEN").text(lblsgen);

                    if ($("#lblSGN").text() == "") {
                        $("#lblSGN").text("申根协议国家 ");
                        $("#lblSGNEN").text("SCHENGEN STATES");
                    }
                } else if (!$(this).attr("checked")) {

                    if (sgcns.length > 2) {
                        var j = 0;
                        for (var i = 0; i < sgcns.length; i++) {
                            if (sgcns[i] == sgcn) {
                                j = i;
                                break;
                            }
                        }
                        if (j == 0) {
                            lblsgcn = lblsgcn.replaceAll(sgcn + ",", "");
                            lblsgen = lblsgen.replaceAll(sgen + ",", "");
                        } else {
                            lblsgcn = lblsgcn.replaceAll("," + sgcn, "");
                            lblsgen = lblsgen.replaceAll("," + sgen, "");
                        }

                    } else {
                        lblsgcn = lblsgcn.replaceAll(sgcn + ",", "");
                        lblsgen = lblsgen.replaceAll(sgen + ",", "");
                    }


                    $("#lblSGCN").text(lblsgcn);
                    $("#lblSGEN").text(lblsgen);

                    if (lblsgcn == "") {
                        $("#lblSGN").text("");
                        $("#lblSGNEN").text("");
                    }
                }

            } else if (tppId == "divFSG") {

                var lblfsg = $("#lblFSG").text();
                var isexist = false;
                var fsgs = lblfsg.split(',');
                var tt = temp[0] + " " + temp[1];

                for (var i = 0; i < fsgs.length; i++) {
                    if (fsgs[i].split('-')[0] == temp[0]) {
                        isexist = true;
                        break;
                    }
                }

                if ($(this).attr("checked") && !isexist) {
                    if (lblfsg != "") {
                        lblfsg = lblfsg + "," + tt;
                    } else {
                        lblfsg = tt;
                    }
                } else {

                    if (fsgs.length > 1) {
                        var j = 0;
                        for (var i = 0; i < fsgs.length; i++) {
                            if (fsgs[i] == tt) {
                                j = i;
                                break;
                            }
                        }
                        if (j == 0) {
                            lblfsg = lblfsg.replaceAll(tt + ",", "");
                        } else {
                            lblfsg = lblfsg.replaceAll("," + tt, "");
                        }
                    } else {
                        lblfsg = lblfsg.replaceAll(tt, "");
                    }

                }

                $("#lblFSG").text(lblfsg);
            }
        });

    });
});
</script>
<!--保险国家 开始-->
<div class="popupLayer" style="width: 600px; height: 460px; top: 2084.5px; left: 5216.5px;" id="divSelCountry">
    <p class="closep">
        <label class="title">
            新增国家
        </label>
    </p>
    <div class="lc">
        <div>
            录入国家名称：<input type="text" name="inputCountry" id="inputCountry" maxlength="20" style="width: 300px"><input type="button" value="新增国家" style="margin-left: 50px;" id="btnAddCountry" class="seamiddlebtn"><br>
            <br>
        </div>
        <ul id="divSG">
            <li class="tl">申根国家<label class="remind">(选择的第一个默认为签证国家)</label></li>
            <li><span class="lw">
                <input type="checkbox" name="cbxCountry" value="申根协议国家-SCHENGEN STATES">&nbsp;申根协议国家&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="法国-FR">&nbsp;法国&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="意大利-IT">&nbsp;意大利&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="西班牙-ES">&nbsp;西班牙&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="荷兰-NL">&nbsp;荷兰&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="德国-DE">&nbsp;德国&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="芬兰-FI">&nbsp;芬兰&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="葡萄牙-PT">&nbsp;葡萄牙&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="挪威-NO">&nbsp;挪威&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="奥地利-AT">&nbsp;奥地利&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="比利时-BE">&nbsp;比利时&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="希腊-GR">&nbsp;希腊&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="瑞士-CH">&nbsp;瑞士&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="瑞典-SE">&nbsp;瑞典&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="丹麦-DK">&nbsp;丹麦&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="卢森堡-LU">&nbsp;卢森堡&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="捷克-CS">&nbsp;捷克&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="波兰-PL">&nbsp;波兰&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="立陶宛-LT">&nbsp;立陶宛&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="冰岛-IS">&nbsp;冰岛&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="爱沙尼亚-EE">&nbsp;爱沙尼亚&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="斯洛文尼亚-SI">&nbsp;斯洛文尼亚&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="拉脱维亚-LV">&nbsp;拉脱维亚&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="斯洛伐克-SK">&nbsp;斯洛伐克&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="马耳他-MT">&nbsp;马耳他&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="匈牙利-HU">&nbsp;匈牙利&nbsp;</span>
            </li>
        </ul>
        <ul id="divFSG">
            <li class="tl">非申根国家</li>
            <li><span class="lw">
                <input type="checkbox" name="cbxCountry" value="美国-US">&nbsp;美国&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="澳大利亚-AU">&nbsp;澳大利亚&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="加拿大-CA">&nbsp;加拿大&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="英国-GB">&nbsp;英国&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="韩国-KR">&nbsp;韩国&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="日本-JP">&nbsp;日本&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="马来西亚-MY">&nbsp;马来西亚&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="新西兰-NZ">&nbsp;新西兰&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="泰国-TH">&nbsp;泰国&nbsp;</span><span class="lw"><input type="checkbox" name="cbxCountry" value="中国-CN">&nbsp;中国&nbsp;</span>
            </li>
        </ul>
        <ul id="divLR">
            <li class="tl">录入的国家</li>
            <li id="liLR"></li>
        </ul>
        <ul>
            <li class="tl">打印预览<label class="remind">(超过打印长度范围的会保存但不会被打印)</label></li>
            <li id="liSelCountry"><label id="lblSGCN"></label><label id="lblSGN"></label><label id="lblSGEN"></label><label id="lblSGNEN"></label><label id="lblFSG"></label><label id="lblLR"></label></li>
        </ul>
        <div class="dbn">
            <input type="button" value="清空" id="btnClear" class="seabtn">
            <input type="button" value="取消" id="btnClose" class="seabtn">
            <input type="button" value="保存" id="btnSave" class="seabtn">
        </div>
    </div>
</div>


</div>