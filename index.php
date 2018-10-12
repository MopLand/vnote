<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>VNote Reader - 手机便笺 - 手机便签 - 备忘录 - .vnt 格式文件在线读取器</title>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">在线实用小工具</a></li>
			<li class="breadcrumb-item active" aria-current="page">vnote</li>
		</ol>
	</nav>

	<?php

	$v = isset( $_POST["vnote"] ) ? $_POST["vnote"] : '';
	$f = isset( $_FILES["vfile"] ) ? $_FILES["vfile"] : array();

	//从上传文件中读取
	if( $v == '' && $f && $f["error"] == 0 ){
		
		$v = file_get_contents( $f["tmp_name"] );
		
		unlink( $f["tmp_name"] );
		
	}

	//将内容转编码
	if( $v ){
		
		//将内容转编码
		$c = preg_replace('/BEGIN:VNOTE([\S\s]+?)QUOTED-PRINTABLE:/','',$v);
		$c = preg_replace('/DCREATED:([\S\s]+?)END:VNOTE/','',$c);
			
		$t = str_replace(array('='.chr(13),chr(10),'==','='),array('','','=','%'),$c);
		$t = urldecode($t);
		
		//写入日志文件
		$file = 'log/'. date('Y-m-d') . '.txt';
		$f = fopen($file,'a'); 
		fwrite( $f, $t . "\r\n*****************************************\r\n\r\n" ); 
		fclose($f);

	}else{
		
		$t = '';
		
	}

	?>
  
	<div class="my-3 mx-3"></div>
	
	<div class="container" id="app">

		<blockquote class="blockquote">VNote Reader - .vnt 格式文件在线读取器</blockquote>

		<form method="post" enctype="multipart/form-data" action="?">

			<div class="form-group">
				<!-- 网文精选_自适应 -->
				<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7104481011578148" data-ad-slot="7430051000" data-ad-format="auto" data-full-width-responsive="true"></ins>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			</div>
						
			<div class="form-group">
				<label>粘贴内容：</label>
				<textarea class="form-control" name="vnote" rows="8"><?php echo $v;?></textarea>
			</div>

			<div class="form-group">
				<label>上传文件：*.vnt 或 *.txt 格式</label>
				<input class="form-control-file" type="file" name="vfile" value="" />
			</div>

			<div class="form-group">
				<button class="btn btn-success" type="submit">提交处理</button>
			</div>

			<?php if( $t ){ ?>
			<div class="form-group">
				<label>读取结果：</label>
				<textarea class="form-control" rows="8"><?php echo $t;?></textarea>
			</div>
			<?php } ?>

			<div class="form-group">
				<!-- 网文精选_自适应 -->
				<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7104481011578148" data-ad-slot="7430051000" data-ad-format="auto" data-full-width-responsive="true"></ins>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			</div>

			<div class="form-group">
				2013/11/06 增加文件上传选项 <br />
				2018/10/12 优化页面样式细节 <code>（觉得工具好用，请点击一下上面的广告，谢谢）</code>
			</div>
			
		</form>

	</div>

	<hr />

	<footer>
		<p class="text-center"><i>Powered by <a href="http://www.veryide.com/" target="_blank">VeryIDE</a></i></p>
	</footer>

	<script src="/project/app.js"></script>
    
</body>
</html>