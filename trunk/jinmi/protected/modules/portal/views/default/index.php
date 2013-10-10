<style>
div.order-info div.row{
	margin-top:10px;
}
</style>
<div class="panel panel-default">
  <div class="panel-heading"><strong>订单信息</strong></div>
  <div class="panel-body order-info">
  	<div class="col-md-3">
  		<div class="row">
  			<strong>进行中订单：</strong> 26
  		</div>
  		<div class="row">
  			<strong>本月订单：</strong> 360
  		</div>
  		<div class="row">
  			<strong>本日订单：</strong> 23
  		</div>
  		<div class="row">
  			<strong>订单增长率：</strong> 23%
  		</div>
  		<table class="table table-striped" style="margin-top:20px;">
  			<thead>
  				<tr>
	  				<th>姓名</th>
	  				<th>订单量</th>
	  			</tr>
  			</thead>
  			<tbody>
  				<tr>
  					<td>周大福</td>
  					<td>283</td>
  				</tr>
  				<tr>
  					<td>周丽萍</td>
  					<td>200</td>
  				</tr>
  				<tr>
  					<td>沐文生</td>
  					<td>180</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
  	<div class="col-md-9">
  		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/exporting.js"></script>

		<div id="chart-container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

		  	</div>
		  	<script type="text/javascript">
    $(function () {
        $('#chart-container').highcharts({
            title: {
                text: '销售统计报表',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: 金米旅游',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: '订单量 (个)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '个'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '销售A',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: '销售B',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: '销售C',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: '销售D',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });
    });
    
	</script>
  </div>
</div>