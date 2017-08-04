<?php
	header("content-type:text/html;charset=utf8");	

	$passwd='1';

	function list_dir($path){
		$dirArray=array_merge(glob($path.'*',GLOB_ONLYDIR),glob($path.'*.*'));
		foreach ($dirArray as $this_file){
			if(is_dir($this_file)){
				echo "<div class=\"list-dir\" onclick=\"opendir('".$this_file."','".basename($this_file)."')\"><span id=\"dir-b-".basename($this_file)."\" >▸ </span>".basename($this_file)."</div>";
				echo "<div id=\"dir-".basename($this_file)."\" class=\"dir-content\" style=\"display:none;\"></div>";
			}else{
				echo "<div class=\"list-file\" onclick=\"openfile('".$this_file."')\" >".basename($this_file)."</div>";
			}
		}
	}

	if($passwd==''){
		exit("Passwd Not Set");
	}
	$passwd=md5($passwd);

	if(md5($_POST['passwd'])==$passwd){
		setcookie("file_passwd",md5($_POST['passwd']),time()+36000000);
		echo "正在登录...";
		header("Location:".htmlspecialchars($_SERVER["PHP_SELF"]));
	}

	if($_COOKIE['file_passwd']!=$passwd):?>
		<title>输入密码</title>
		<body style="background:#eee;">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width:300px;margin:50px auto;padding:10px;font-size:14px;color:#555;background:#fff;border:0;box-shadow:0px 2px 6px rgba(100, 100, 100, 0.3);">
			<input type="password" placeholder="密码" name="passwd" style="background:#fff;color:#555;padding:5px;border:1px solid #555;height:32px;width:235px;" />
			<input type="submit" name="submit" style="background:#fff;color:#555;padding:5px;border:1px solid #555;height:32px;width:60px;" value="确定" >
			</form>
		</body>
	<?php
		exit();
	endif;

	if(isset($_POST['job'])){

		if($_POST['job']=="get_list"){
			list_dir($_POST['dir']."/*");
		}

		if($_POST['job']=="get_file"){
			echo file_get_contents($_POST['file']);
		}

		if($_POST['job']=="save_file"){
			file_put_contents($_POST['file'],$_POST['data']);
		}

	}else{

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>在线文件编辑器</title>

		<style type="text/css">
			body{
				font-size: 14px;
				font-family: "文泉驛正黑","Microsoft yahei UI","Microsoft yahei","微软雅黑","Lato",Helvetica,Arial,sans-serif;
			    cursor: default;
			    margin: 0;
			}
			#head{
				background-color: #34495E;
				height: 32px;
				width: 100%;
				color: #fff;
			}
			#body{
				margin-left: 230px;
			}
			#left{
				float: left;
				width: 230px;
				margin-left: -230px;
				height: 100%;
				background-color: #455A6F;
				overflow: auto;
			}
			#right{
				height: 100%;
			}
			#title{
				font-size: 20px;
				padding: 4px 0 0 4px;
				display: inline-block;
			}
			#save{
				position: fixed;
				top: 3px;
				right: 0px;
				display: inline-block;
				background-color: #4D6277;
				padding: 3px 8px 4px 8px;
				margin-top: -3px;
				z-index: 10;
				font-size: 20px;
			}
			#save:hover{
				background-color: #58BCFF;
			}
			.list-file,.list-dir{
				color: #fff;
				font-size: 16px;
				padding: 5px 5px 5px 20px;
			}
			.list-file:hover,.list-dir:hover{
				background-color: #566B7F;
			}
			.list-dir{
				padding-left: 5px;
			}
			.dir-content{
				padding-left: 20px;
			}
			#editor{
				height: 100%;
				margin: 0;
			}
		</style>
	</head>
	<body>
		<div id="head">
			<span id="title">在线文件编辑器</span>
			<span id="save" style="display:none;">保存</span>
		</div>

		<div id="body">
			<div id="left">
				<?php
					list_dir("./");
				?>
			</div>
			<div id="right">
				<pre id="editor"></pre>
			</div>
		</div>
	</body>


		<script type="text/javascript">

			function opendir(path,id){
				if($("#dir-"+id).css("display")=="none"){
					$("#dir-b-"+id).html("▾ ");
				}else{
					$("#dir-b-"+id).html("▸ ");
				}
				if($("#dir-"+id).html()==''){
					$.post("<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>",
					{
						job:"get_list",
						dir:path
					},
					function(data,status){
						//alert("Data: " + data + "\nStatus: " + status);
						$("#dir-"+id).html(data);
						$("#dir-"+id).slideToggle(300);
					});
				}else{
					$("#dir-"+id).slideToggle(300);
				}
			}

			function openfile(path){
				$.post("<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>",
					{
						job:"get_file",
						file:path
					},
					function(data,status){
						editor.session.setValue(data);
						$("#save").show();
						$("#save").attr("onclick","savefile('"+path+"')")
				});
			}

			function savefile(path){
				$.post("<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>",
					{
						job:"save_file",
						file:path,
						data:editor.getValue()
					},
					function(data,status){
						// alert("Data: " + data + "\nStatus: " + status);
						alert("已保存");
				});
			}

			var winh=window.innerHeight
				|| document.documentElement.clientHeight
				|| document.body.clientHeight;

			var body_H=winh-32;
			the_body = document.getElementById('body');
			the_body.style.height = body_H +'px';

			window.onresize = function (){
				var winh=window.innerHeight
					|| document.documentElement.clientHeight
					|| document.body.clientHeight;

				var body_H=winh-32;
				the_body = document.getElementById('body');
				the_body.style.height = body_H +'px';
			}
			
		</script>

		<script src="http://cdn.bootcss.com/jquery/2.1.1-rc2/jquery.min.js"></script>
		<script src="http://cdn.bootcss.com/ace/1.1.3/ace.js"></script>

		<script type="text/javascript">
			var editor = ace.edit("editor");
			editor.session.setMode("ace/mode/php");
		</script>

	</html>

	<?php
	}
?>
