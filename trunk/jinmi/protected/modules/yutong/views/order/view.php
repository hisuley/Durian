<div id="main">

<div id="vleft">
    <ul class="opgui">
        <li class="lisd" id="lit1"><a href="javascript:">订单管理</a></li>
        <li class="lic" style="display: block;">
            <a href="<?php echo $this->createUrl('order/list'); ?>" id="order1" style="color: red;">订单进度查询</a><br>
        </li>
    </ul>
</div>
<div id="vright">

    <div class="order">

        <!--
            操作结果时，给出信息提示
        -->
        <table border="0" cellpadding="6" cellspacing="1">
            <tbody><tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        国家：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    <?php
                        echo $model->visa->country->name;
                    ?>
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        签证类型：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    <?php
                    echo $model->visa->type->name;
                    ?>
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        订单号：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    <?php
                        echo $model->id;
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        姓名：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    <?php
                        echo YutongVisaOrder::joinCustomer($model->customers);
                    ?>
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        人数：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    <?php
                        echo $model->amount;
                    ?>
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        签证费单价：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥ <?php
                        echo $model->single_price;
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        预计出发日期：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    <?php
                    echo empty($model->depart_date) ? '': $model->depart_date;
                    ?>
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        保险费合计：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥0                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        签证费合计：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥ <?php
                    echo $model->price;
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        支付状态：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    未支付                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        优惠金额：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥0
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        订单总额：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥<?php
                    echo $model->price;
                    ?>
                </td>
            </tr>

            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        跟进人：
                    </label>
                </td>
                <td bgcolor="#E3ECFB" colspan="5">
                    <?php
                        if(isset($model->follow_id)){
                            echo YutongUser::getUserRealname($model->follow_id);
                        }
                    ?>
                                    </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">

                    <label>
                        特殊要求：</label>
                </td>
                <td bgcolor="#E3ECFB" colspan="5">
                        <?php echo $model->comment; ?>
                </td>
            </tr>

            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        护照返回地址：</label>
                </td>
                <td bgcolor="#E3ECFB" colspan="5">
                    <span>公司名：<?php
                        echo $model->company_name;
                        ?> &nbsp;</span>
                    <span> 地址：<?php
                        echo $model->contact_address."(".$model->contact_name." 收)  ".$model->contact_phone;
                        ?></span>
                </td>
            </tr>
            </tbody></table>
        <div class="orderno">
           </div>
        <?php
            if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_SALES_ORDER)){ ?>
                <div class="orstep">
                    <ul class="title">
                        <li style="width: 50%">&gt;&gt; 第一步&nbsp;下单成功 </li>
                        <li style="width: 15%">
                            <label>
                                操作人：<?php echo YutongUser::getUserRealname($model->op_id); ?></label></li>
                        <li style="width: 35%">
                            <label>
                                操作时间：<?php echo date('Y-m-d H:i:s', $model->op_time); ?></label>
                        </li>
                    </ul>
                    <ul class="main">
                        <li style="width: 100%">
                            <label>
                                备 注：</label>
                            <?php echo $model->op_comment; ?>
                        </li>
                    </ul>
                </div>
        <?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_OP_CONFIRM)){ ?>
                <div class="orstep">
                    <ul class="title">
                        <li style="width: 50%">&gt;&gt; 第二步&nbsp;已收证 </li>
                        <li style="width: 15%">
                            <label>
                                操作人：<?php echo YutongUser::getUserRealname($model->material_id); ?></label></li>
                        <li style="width: 35%">
                            <label>
                                操作时间：<?php echo date('Y-m-d H:i:s', $model->material_time); ?></label>
                        </li>
                    </ul>
                    <ul class="main">
                        <li style="width: 100%">
                            <label>
                                收到资料时间：</label><?php echo date('Y-m-d H:i:s', $model->material_time); ?></li>
                        <li style="width: 100%">
                            <label>
                                已提交资料：</label><?php echo $model->material_comment; ?></li>
                    </ul>
                </div>

         <?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_MT_VERIFY)){ ?>
                <div class="orstep">
                    <ul class="title">
                        <li style="width: 50%">&gt;&gt; 第三步&nbsp;资料审核
                            <span>等待送签</span></li>
                        <li style="width: 15%">
                            <label>
                                操作人：<?php echo YutongUser::getUserRealname($model->mverify_id); ?></label>
                        </li>
                        <li style="width: 35%">
                            <label>
                                操作时间：<?php echo date('Y-m-d H:i:s', $model->mverify_time); ?></label>
                        </li>
                    </ul>
                    <ul class="main">
                        <li style="width: 100%"><span style="float: left; width: 250px;">
                        <label>
                            需要补充的资料：</label><?php echo $model->mverify_resubmit; ?>
                    </span><span style="float: left; width: 560px;">
                    </span> </li>
                        <li style="width: 100%">
                            <label>
                                详细描述：</label><?php echo $model->mverify_comment; ?></li>
                    </ul>
                </div>

         <?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_SENTOUT)){ ?>
                <div class="orstep">
                    <ul class="title">
                        <li style="width: 50%">&gt;&gt; 第四步&nbsp;已送签 </li>
                        <li style="width: 15%">
                            <label>
                                操作人：<?php echo YutongUser::getUserRealname($model->sent_id); ?></label></li>
                        <li style="width: 35%">
                            <label>
                                操作时间：<?php echo date('Y-m-d H:i:s', $model->sent_time); ?></label>
                        </li>
                    </ul>
                    <ul class="main">
                        <li style="width: 48%">
                            <label>
                                送签时间：</label><?php echo date('Y-m-d H:i:s', $model->sent_out_time); ?></li>
                        <li style="width: 50%">
                            <label>
                                预计出证时间：</label><?php echo $model->sent_predict_time; ?></li>
                        <li style="width: 100%">
                            <label>
                                面试情况：</label><?php echo $model->sent_comment; ?></li>
                        <li class="remark">出证时间为预计时间，签证未有结果前请不要出机票，一切损失自行承担. </li>
                    </ul>
                </div>
         <?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_ISSUE_VISA)){ ?>
                <div class="orstep">
                    <ul class="title">
                        <li style="width: 50%">&gt;&gt;第五步&nbsp;已出结果 </li>
                        <li style="width: 15%">
                            <label>
                                操作人：<?php echo YutongUser::getUserRealname($model->back_id); ?></label></li>
                        <li style="width: 35%">
                            <label>
                                操作时间：<?php echo date('Y-m-d H:i:s', $model->back_time); ?></label>
                        </li>
                    </ul>
                    <ul class="main">
                        <li style="width: 46%; color: Red;">
                            <label style="color: Red;">
                                签证结果：</label><?php echo $model->back_comment; ?></li>
                        <li style="width: 50%">
                            <label>
                                指派跟进人：</label><?php echo YutongUser::getUserRealname($model->follow_id); ?></li>
                    </ul>
                </div>
        <?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_SENTBACK)){ ?>
            <div class="orstep">
                <ul class="title">
                    <li style="width: 50%">&gt;&gt;第六步&nbsp;寄回 </li>
                    <li style="width: 15%">
                        <label>
                            操作人：<?php echo YutongUser::getUserRealname($model->delivery_id); ?></label></li>
                    <li style="width: 35%">
                        <label>
                            操作时间：<?php echo date('Y-m-d H:i:s', $model->delivery_time); ?></label>
                    </li>
                </ul>
                <ul class="main">
                    <li style="width: 99%; ">
                        <label>寄回备注：</label><?php echo $model->delivery_comment; ?></li>
                </ul>
            </div>
        <?php } ?>

        <div class="ods">
             </div>
    </div>

</div>

</div>