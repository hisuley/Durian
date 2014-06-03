<div id="main">

<div id="vleft">
    <ul class="opgui">
        <li class="lisd" id="lit1"><a href="javascript:">订单管理</a></li>
        <li class="lic" style="display:list-item">
            <a href="<?php echo $this->createUrl('order/list'); ?>" id="order1" style="color: red;">订单进度查询</a><br>
        </li>
    </ul>

    <ul class="opgui">
        <li class="lisd" id="lit7"><a href="javascript:">账号管理</a></li>
        <li class="lic" style="display: list-item;">
            <a href="<?php echo $this->createUrl('user/profile'); ?>" id="member1">修改资料</a>
        </li>
    </ul>

    <br>


</div>
<div id="vright">

    <div class="table" style="padding-top: 0;">
        <div class="hm" style="width: 80%">
            修改资料         </div>
        <br>



        <!--
            操作结果时，给出信息提示
        -->
        <form action="<?php echo $this->createUrl('user/profile'); ?>" id="editFrm" method="post">
            <ul class="register" style="width: 80%">
                <li>
                    <label>
                        登录名（手机号）：</label><?php echo $model->username; ?> </li>

                <li>
                    <label>
                        公司名称：</label>
                    <small class="required">*</small>
                    <input class="textbox validate[required]" data-val="true" data-val-required="公司名称必需填的" id="CompanyName" maxlength="50" name="YutongUserAddress[company_name]" style="width:200px" type="text" value="<?php echo $model->address->company_name; ?>">
                </li>

                <li>
                    <label>
                        公司联系人：</label>
                    <small class="required">*</small>
                    <input class="textbox validate[required]" data-val="true" data-val-required="公司联系人必需填的" id="ContactName" maxlength="50" name="YutongUserAddress[contact_name]" style="width:200px" type="text" value="<?php echo $model->address->contact_name; ?>">
                </li>
                <li>
                    <label>
                        联系人性别：</label>
                    <small class="required">*</small>
                    <input <?php if($model->address->contact_sex == "男"){echo "checked='checked'";} ?> data-val="true" data-val-length="性别只能是男或女" data-val-length-max="1" data-val-length-min="1" data-val-required="性别必需选的" id="Sex" name="Sex" type="radio" value="男">
                    男&nbsp;
                    <input id="Sex" name="Sex" type="radio" value="女">女</li>
                <li>
                    <label>
                        公司固话：</label>
                    <small class="required">*</small>
                    <input class="textbox validate[required]" data-val="true" data-val-required="公司固话必需填的" id="Phone" maxlength="20" name="YutongUserAddress[contact_phone]" style="width:200px" type="text" value="<?php echo $model->address->contact_phone; ?>">
                </li>
                <li>
                    <label>
                        公司地址：</label>
                    <small class="required">*</small>
                    <input class="textbox validate[required]" data-val="true" data-val-required="公司联系人必需填的" id="ContactName" maxlength="50" name="YutongUserAddress[contact_province]" style="width:200px" type="text" value="<?php echo $model->address->contact_province; ?>">
                </li>
                <li>
                    <label>
                        详细地址：</label>
                    <small class="required">*</small>
                    <textarea class="textarea validate[required,length[1,500]]" cols="39" data-val="true" data-val-required="公司地址必需填的" id="Address" name="YutongUserAddress[contact_address]" rows="3"><?php echo $model->address->contact_address; ?></textarea>
                </li>
                <li>
                    <label>
                        联系人邮箱：</label>
                    <small class="required">&nbsp;</small>
                    <input class="textbox" id="Email" maxlength="50" name="YutongUserAddress[contact_email]" style="width:200px" type="text" value="<?php echo $model->address->contact_email; ?>">
                </li>
                <li>
                    <label>
                        联系人QQ：</label>
                    <small class="required">&nbsp;</small>
                    <input class="textbox" id="QQ" maxlength="20" name="YutongUserAddress[contact_qq]" style="width:200px" type="text" value="<?php echo $model->address->contact_qq; ?>">
                </li>
                <li style="text-align: center"><span style="margin-left: 180px;">
                    <input class="btn" type="submit" value=" 提 交 ">
                </span></li>
            </ul>
        </form>    </div>

</div>

</div>