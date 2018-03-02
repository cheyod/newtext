<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"C:\Users\cheyod\Desktop\Home\WWW\bigbase\public/../application/index\view\index\head.html";i:1500869039;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	  <title><?php echo (isset($title) && ($title !== '')?$title:"好像差个标题"); ?></title>
	  <link rel="stylesheet" href="/layui/css/layui.css">
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
	</body>
</html>
<script src="/layui/layui.js"></script>
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