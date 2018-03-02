<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"C:\Users\cheyod\Desktop\Home\WWW\bigbase\public/../application/index\view\index\index.html";i:1511258291;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo (isset($title) && ($title !== '')?$title:"好像差个标题"); ?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="../../../../layui/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
	
	<ul class="layui-nav" lay-filter="">
		<li class="layui-nav-item layui-this">
			<a href="javascript:;">BigBase</a>
			<dl class="layui-nav-child"> <!-- 二级菜单 -->
				<dd><a href="">移动模块</a></dd>
				<dd><a href="">后台模版</a></dd>
				<dd><a href="">电商平台</a></dd>
			</dl>
		</li>
	</ul>
	<div class="layui-main">
		<form class="layui-form" action="/index.php/index/index/add" method="get">
		  <div class="layui-form-item">
		    <label class="layui-form-label">订单号</label>
		    <div class="layui-input-block">
		      <input type="text" name="orderno" required  lay-verify="required" placeholder="请输入订单号" autocomplete="off" class="layui-input">
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">运单号</label>
		    <div class="layui-input-block">
		      <input type="text" name="logicno" required  lay-verify="required" placeholder="请输入运单号" autocomplete="off" class="layui-input">
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <label class="layui-form-label">标题</label>
		    <div class="layui-input-block">
		      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
		    </div>
		  </div>
		  <div class="layui-form-item">
		    <div class="layui-inline">
		      <label class="layui-form-label">销售价</label>
		      <div class="layui-input-inline">
		        <input type="number" name="saleprice" required  lay-verify="required" placeholder="￥" autocomplete="off" class="layui-input">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <label class="layui-form-label">进货价</label>
		      <div class="layui-input-inline">
		        <input type="number" name="stockprice" required  lay-verify="required" placeholder="￥" autocomplete="off" class="layui-input">
		      </div>
		    </div>
		  </div>

		  <div class="layui-form-item">
		    <div class="layui-inline">
		      <label class="layui-form-label">手续费</label>
		      <div class="layui-input-inline">
		        <input type="number" name="poundage" required value="2" lay-verify="required" placeholder="￥" autocomplete="off" class="layui-input">
		      </div>
		    </div>
		    <div class="layui-inline">
		      <label class="layui-form-label">运费</label>
		      <div class="layui-input-inline">
		        <input type="number" name="freight" required value="6" lay-verify="required" placeholder="￥" autocomplete="off" class="layui-input">
		      </div>
		    </div>
		  </div>

		  <div class="layui-form-item">
		    <div class="layui-input-block">
		      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
		      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		  </div>
		</form>

		<blockquote class="layui-elem-quote">
			总销量(单)：<?php echo count($goods); ?><br/>
			总金额(元)：<?php echo $sumprice; ?><br/>
			总利润(元)：<?php echo $profit; ?><br/>
		</blockquote>


	 	<div class="layui-form">
		  <table class="layui-table">
		    <colgroup>
		      <col width="30">
		      <col width="150">
		      <col width="150">
		      <col width="100">
		      <col width="100">
		      <col width="100">
		      <col width="100">
		      <col width="100">
		      <col width="100">
		      <col>
		    </colgroup>
		    <thead>
		      <tr>
		        <th><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
		        <th>订单号</th>
		        <th>标题</th>
		        <th>销售价</th>
		        <th>数量</th>
		        <th>进货价</th>
		        <th>手续费/运费</th>
		        <th>赚差价</th>
		        <th>运单号</th>
		        <th>时间</th>
		      </tr> 
		    </thead>
		    <tbody>
		    	<?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): if( count($goods)==0 ) : echo "" ;else: foreach($goods as $key=>$vo): ?>
			      <tr>
			        <td><input type="checkbox" lay-skin="primary"></td>
			        <td><?php echo $vo['orderno']; ?></td>
			        <td><?php echo $vo['title']; ?></td>
			        <td><?php echo $vo['saleprice']; ?></td>
			        <td><?php echo $vo['number']; ?></td>
			        <td><?php echo $vo['stockprice']; ?></td>
			        <td><?php echo $vo['poundage']; ?>/<?php echo $vo['freight']; ?></td>
			        <td><?php echo $vo['saleprice'] - $vo['stockprice'] - $vo['poundage'] - $vo['freight']; ?></td>
			        <td><?php echo $vo['logicno']; ?></td>
			        <td><?php echo $vo['creattime']; ?></td>
			      </tr>
			      <?php endforeach; endif; else: echo "" ;endif; ?>
		    </tbody>
		  </table>
		</div>
	</div>
<script src="../../../../layui/layui.js"></script>
<script>
layui.use(['element','form','layer'], function(){
  var $ = layui.jquery,
  		layer = layui.layer,
		form = layui.form(),
		element = layui.element();
  //监听导航点击
  element.on('nav(demo)', function(elem){
    //console.log(elem)
    layer.msg(elem.text());
  });

  form.on('checkbox(allChoose)', function(data){
    var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
    child.each(function(index, item){
      item.checked = data.elem.checked;
    });
    form.render('checkbox');
  });


});
</script> 
  
</body>
</html>