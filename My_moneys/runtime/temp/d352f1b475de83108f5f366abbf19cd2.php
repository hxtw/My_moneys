<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\phpStudy\PHPTutorial\WWW\My_moneys\public/../application/index\view\Statistics\index.html";i:1557799775;}*/ ?>
<!--<link rel="stylesheet" href="/My_moneys/public/static/assets/vendor/chartist/css/chartist-custom.css">-->
<script src="/My_moneys/public/static/echarts/echarts.js"></script>
<script src="/My_moneys/public/static/echarts/macarons.js"></script>
				<div class="container-fluid" style="width: 1900px; height: 950px; margin-left: 1%; margin-top: 1%;">
					<h3 class="page-title">统计</h3>
						<div class="">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">发布统计</h3>

									<div id="main" style="width: 100%;height:800px;"></div>
								</div>
							</div>
						</div>
				</div>
				<div class="container-fluid" style="width: 1900px; height: 65px; margin-left: 1%; margin-top: 1%;">
					<div class="panel-body" style="padding-bottom:0px; padding-top: 0px;">
						<div class="panel-heading" style="margin-left: 35%">
							<p class="demo-button">
								<button type="button" class="btn btn-primary" onclick="Tongji('qitian')">最近七天的统计</button>
								<button type="button" class="btn btn-primary" onclick="Tongji('day')">每天的统计</button>
								<button type="button" class="btn btn-primary" onclick="Tongji('month')">每月的统计</button>
								<button type="button" class="btn btn-primary" onclick="Tongji('year')">每年的统计</button>
							</p>
						</div>
					</div>
				</div>
				<div class="container-fluid" style="width: 1900px; height: 950px; margin-left: 1%; margin-top: 1%;">
					<div class="">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">统计表</h3>
							</div>
							<div class="panel-body">
								<table class="table table-striped">
									<thead>
									<tr>
										<th></th>
										<th><?php echo $count['name']; ?></th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<th>易企秀总数</th>
										<td><?php echo $count['eqx']; ?></td>
									</tr>
									<tr>
										<th>文章总数</th>
										<td><?php echo $count['article']; ?></td>
									</tr>
									<tr>
										<th>视频总数</th>
										<td><?php echo $count['video']; ?></td>
									</tr>
									<tr>
										<th>音频总数</td>
										<td><?php echo $count['dubbing']; ?></td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
</body>
<script>
	function Tongji(val){
		$('#content-load').load( "<?php echo url("Index/Statistics/Index"); ?>" + "?type=" + val );
	}
</script>
<script type="text/javascript">
	// app.title = '折柱混合';
	// 基于准备好的dom，初始化echarts实例
	var myChart = echarts.init(document.getElementById('main'), 'macarons');
	option = {
		tooltip: {
			trigger: 'axis',
			axisPointer: {
				type: 'cross',
				crossStyle: {
					color: '#999'
				}
			}
		},

		toolbox: {
			feature: {
				// dataView: {show: true, readOnly: true},
				magicType: {show: true, type: ['line', 'bar']},
				restore: {show: true},
				saveAsImage: {show: false}
			}
		},
		legend: {
			data:['易企秀','文章','视频','音频']
		},
		xAxis: [
			{
				type: 'category',
				data: [<?php echo $ssum; ?>],
				axisPointer: {
					type: 'shadow'
				}
			}
		],
		yAxis: [
			{
				type: 'value',
				name: '数量',
				min: 0,
				max: <?php echo $max; ?>,
				interval: <?php echo $interval; ?>,
				axisLabel: {
					formatter: '{value} 篇'
				}
			},

		],
		series: [
				<?php      if (in_array('Eqx',$comma_separated)){ ?>
			{
				name:'易企秀',
				type:'bar',
				data:[<?php echo $eqx; ?>]
			},
			<?php  }
			if (in_array('Article',$comma_separated)){
				?>
			{
				name:'文章',
				type:'bar',
				data:[<?php echo $article; ?>]
			},
		<?php      }
			if (in_array('Video',$comma_separated)){
				?>
			{
				name:'视频',
				type:'bar',
				data:[<?php echo $video; ?>]
			},
		<?php  }  if (in_array('Dubbing',$comma_separated)){
				?>
			{
				name:'音频',
				type:'bar',
				data:[<?php echo $dubbing; ?>]
			},
		<?php  } ?>
		]
	};
	// 使用刚指定的配置项和数据显示图表。
	myChart.setOption(option);
</script>
</html>
