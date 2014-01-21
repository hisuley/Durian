<style type="text/css">	

	/*
	Pretty Table Styling
	CSS Tricks also has a nice writeup: http://css-tricks.com/feature-table-design/
	*/
	
	table {
		overflow:hidden;
		border:1px solid #d3d3d3;
		background:#fefefe;
		width:100%;
		margin:1% 0px auto 0;
		-moz-border-radius:5px; /* FF1+ */
		-webkit-border-radius:5px; /* Saf3-4 */
		border-radius:5px;
		-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	}
	
	th, td {padding:15px 10px 10px; text-align:center; }
	
	th {text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
	
	td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
	
	tr.odd-row td {background:#f6f6f6;}
	
	td.first, th.first {text-align:left}
	
	td.last {border-right:none;}
	
	/*
	Background gradients are completely unnecessary but a neat effect.
	*/
	
	td {
		background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
	}
	
	tr.odd-row td {
		background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
	}
	
	th {
		background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
		background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
	}
	
	/*
	I know this is annoying, but we need additional styling so webkit will recognize rounded corners on background elements.
	Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
	
	And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
	*/
	
	tr:first-child th.first {
		-moz-border-radius-topleft:5px;
		-webkit-border-top-left-radius:5px; /* Saf3-4 */
	}
	
	tr:first-child th.last {
		-moz-border-radius-topright:5px;
		-webkit-border-top-right-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.first {
		-moz-border-radius-bottomleft:5px;
		-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.last {
		-moz-border-radius-bottomright:5px;
		-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
	}

	</style>
	<div class="row">
		<div class="col-md-2">
			<h4 style="margin:0px;"><span class="label label-info"><?php echo OfflineOrder::translateStatus($result->status); ?></span></h4>
			</div>
			<div class="col-md-10">
				<div class="progress  progress-striped">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo OfflineOrder::getProgress($result->type, $result->status); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo OfflineOrder::getProgress($result->type, $result->status); ?>%;">
						<span class="sr-only"><?php echo OfflineOrder::getProgress($result->type, $result->status); ?>% complete</span>

					</div>
				</div>
			</div>

		</div>

		<table cellspacing="0">
			<tr><th>国家</th><td><?php echo OrderHelper::findAttr('country', $result->attrs); ?></td><th>签证类型</th><td><?php echo OrderHelper::findAttr('type', $result->attrs); ?></td><th>订单号</th><td>Y1309231400526708</td></tr>
			<tr><th>姓名</th><td><?php echo OrderHelper::findAttr('contact_name', $result->attrs); ?></td><th>人数</th><td><?php echo $result->amount; ?></td><th>签证费单价</th><td>￥<?php echo intval($result->total_price/$result->amount); ?></td></tr>
			<tr><th>预计出发日期</th> <td><?php echo OrderHelper::findAttr('start_time', $result->attrs); ?></td> <th>支付状态</th> <td><?php if($result->pay_status == 'paid'){echo "支付"; }else{echo "未支付";} ?></td> <th>订单总额</th> <td>￥<?php echo $result->total_price; ?></td></tr>
			<tr>
				<th>地址</th>
				<td colspan="5">名字：<?php echo OrderHelper::findAttr('customers', $result->attrs); ?>|电话：<?php echo OrderHelper::findAttr('contact_phone', $result->attrs); ?>|地址：<?php echo OrderHelper::findAttr('contact_address', $result->attrs); ?></td>
			</tr>
			<tr>
				<th>材料清单</th>
				<td colspan="5">
                    <?php
                    $materials = OrderHelper::findMaterial($result->attrs);
                    foreach($materials as $material){
                                echo '<span class="glyphicon glyphicon-check"></span> '.$material;
                    }
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo Yii::t('portal', 'Finance Operation'); ?></th>
					<?php if($result->pay_status == OfflineOrder::PAY_NO){
						$postUrl = 'js:function(id, fileName, responseJSON){$.ajax({ type: "POST", url: ';
						$postUrl .= Yii::app()->createUrl('portal/visa/addcert', array('id'=>$result->id));
						$postUrl .= ", data: { name: fileName }}).done(function( msg ) {}); }";
						echo "<td colspan='4'>";
						$this->widget('application.extensions.EAjaxUpload.EAjaxUpload',
						array(
						        'id'=>'uploadFile',
						        'config'=>array(
						               'action'=>Yii::app()->createUrl('portal/default/upload'),
						               'allowedExtensions'=>array("jpg","jpeg","gif","png","bmp","txt","doc","pdf","xls","3gp","php","ini","avi","rar","zip","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
						               'sizeLimit'=>1000*1024*1024,// maximum file size in bytes
						               'minSizeLimit'=>1*1024,
						               'auto'=>true,
						               'multiple' => true,
						               'onComplete'=> $postUrl,
						               'messages'=>array(
						                                 'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
						                                'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
						                                'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
						                                'emptyError'=>"{file} is empty, please select files again without it.",
						                                'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
						                               ),
						               'showMessage'=>"js:function(message){ alert(message); }"
						               )
						 
						               ));
						echo "</td><td>";
						echo '<a href="javascript:void();" class="btn btn-primary">'.Yii::t('portal', 'Set Paid')."</a>";
						echo "</td>";
					}else{
						echo "<td colspan='4'>";
						echo Yii::t('portal', 'it\'s been paid, to view the certification, please click the image. ');
						echo "</td>";
					} ?>
					<?php if($result->pay_status == OfflineOrder::PAY_OK){
						echo "<td>";
						$img = OrderHelper::findAttr(OfflineOrderAttribute::ATTR_PAY_CERT, $result->attrs);
						if(!empty($img)){ 
							$this->beginWidget('application.extensions.thumbnailer.Thumbnailer', array(
							        'thumbsDir' => 'images/thumbs',
							        'thumbWidth' => 50,// Optional
							    )
							); ?>
							 
							<img src="<?php echo $img; ?>" />
							 
							<?php $this->endWidget();
						}
						echo "</td>";
					}
					?>
			</tr>

		</table>
		<div class="panel panel-danger"  style="margin-top:20px;padding:10px; ">
			<div class="panel-body">
			<label for="" class="control-label col-md-3" style="margin-top:7px;">当前操作：
                <?php
                OfflineOrder::translateStatus($result->status);
                ?>

            </label>
			<div class="col-md-9">
                <?php
                $orderHelper = new OrderHelper();
                $orderHelper->review($result->status, $result);
                ?>
			</div>
			</div>
		</div>

    <!--
		<div class="panel panel-success review-panel" style="margin-top:40px;">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="glyphicon glyphicon-ok-circle"></span> 下单 <span class="label label-success">下单成功</span><span class="pull-right ">操作员：<strong>沐文生</strong>  <small>2013-07-23 12:30</small></span></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-5">
					备注：<?php echo empty($review[OfflineOrderReviewHistory::TYPE_SUCCESS]) ? '':$review[OfflineOrderReviewHistory::TYPE_SUCCESS]->memo; ?>
				</div>
				<div class="col-md-7">
					<div class="col-md-3">
						付款凭证：
					</div>
					<div class="col-md-9">
						<div><a href="<?php echo Yii::app()->request->baseUrl; ?>/upload/portal/visa_demo.jpg" class="thumbnail">
							<img  style="height:120px;" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/portal/visa_demo.jpg" alt="...">
						</a></div>
						<div><a href="<?php echo Yii::app()->request->baseUrl; ?>/upload/portal/visa_demo.jpg" class="thumbnail">
							<img  style="height:120px;" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/portal/visa_demo.jpg" alt="...">
						</a></div>

					</div>

				</div>

			</div>
		</div>
		-->
        <?php
        $review = OfflineOrderReviewHistory::getAllReviewData($result->id);
        $reviewSwitch = false;
        foreach(OfflineOrderReviewHistory::$typeIntl as $key=>$value){
            echo '<div class="panel ';
            echo empty($review[$key]) ? 'panel-warning' : 'panel-success';
            echo '">';
            echo '<div class="panel-heading">'.
				 '<h3 class="panel-title"><span class="glyphicon glyphicon-ok-circle"></span>'.$value.'<span class="label ';
            echo empty($review[$key]) ? (!$reviewSwitch) ? ('label-info">审核中' && $reviewSwitch = true): '' : 'label-success">审核成功';
            echo '</span>';
            echo !empty($review[$key]) ? '<span class="pull-right ">操作员：<strong> '.User::getUserRealname($review[$key]->user_id).' </strong>  <small>'.date('Y-m-d H:i:s', $review[$key]->create_time).'</small></span></h3>' : '';
			echo '</div>';
            echo '<div class="panel-body">';
            echo empty($review[$key]->memo) ? '':$review[$key]->memo;
            echo "<br />";
            if($key == OfflineOrderReviewHistory::TYPE_SUCCESS){
                echo '材料清单：';
                $data = OrderHelper::findAttr(OfflineOrderAttribute::ATTR_MATERIAL, $result->attrs);
                foreach($data as $item){
                    echo '<span class="glyphicon glyphicon-check"></span>'.$item." ";
                }
            }
            echo '</div></div>';
        }
        ?>

