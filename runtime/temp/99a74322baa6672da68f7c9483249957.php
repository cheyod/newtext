<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"C:\Users\cheyod\Desktop\Home\WWW\bigbase\public/../application/index\view\index\left.html";i:1500869460;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	  <title><?php echo (isset($title) && ($title !== '')?$title:"好像差个标题"); ?></title>
	  <link rel="stylesheet" href="/layui/css/layui.css">
	</head>
	<body>
		<ul class="layui-nav layui-nav-tree" lay-filter="test">
		<!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
		  <li class="layui-nav-item layui-nav-itemed">
		    <a href="javascript:;">默认展开</a>
		    <dl class="layui-nav-child">
		      <dd><a href="javascript:;" target="main">选项1</a></dd>
		      <dd><a href="javascript:;" target="main">选项2</a></dd>
		      <dd><a href="" target="main">跳转</a></dd>
		    </dl>
		  </li>
		  <li class="layui-nav-item">
		    <a href="javascript:;">解决方案</a>
		    <dl class="layui-nav-child">
		      <dd><a href="" target="main">移动模块</a></dd>
		      <dd><a href="" target="main">后台模版</a></dd>
		      <dd><a href="" target="main">电商平台</a></dd>
		    </dl>
		  </li>
		  <li class="layui-nav-item"><a href="" target="main">产品</a></li>
		  <li class="layui-nav-item"><a href="" target="main">大数据</a></li>
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