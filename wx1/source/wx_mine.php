<?php
	
// $m_auth = getAuth();
$result = 0;

/*$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('space')." WHERE wxkey='$_GET[wxkey]'");

if ($_SGLOBAL['db']->fetch_array($query)){
	$result = 1;
}else{
	if (isset($_COOKIE['uchome_m_auth'])) 
	{
		$result = 1;
	}else{
		$result = 0;
	}
}*/

if ($_GET["op"]=="add"){

	include_once S_ROOT.'./uc_client/client.php';
	//include_once( 'weibo/callback.php' );

	
	

	

	// 同步登陆
	$jsonurl = "http://www.betit.cn/capi/connect.php?site=weibo&sinauid='".$uid_get['uid']."'";
	$json = file_get_contents($jsonurl,0,null,null);
	wxshowmessage($jsonurl);
	$json_output = json_decode($json);
	$loginusername=$json_output->data->space->name;
	$credit=$json_output->data->space->credit;
	$experience=$json_output->data->space->experience;
	$avatar=$json_output->data->space->avatar;
	$note=$json_output->data->space->note;
	$friendnum=$json_output->data->space->friendnum;
	$quiznum=$json_output->data->space->quiznum;
	//$avatar = capi_avatar($value["uid"]);
	$device = json_encode(array("os"=>$os, "auth"=>$json_output->data->m_auth));
	// bind
	
	updatetable('space', array('wxkey'=>$_POST['wxkey'], 'device'=>$device), array('uid'=>$passport['uid']));
	
	echo "<script>localStorage.removeItem('auth');localStorage.setItem('auth','".$json_output->data->m_auth."');</script>";
	

	

	// showmessage('do_success', 'wx.php?do=feed&wxkey='.$_POST['wxkey'], 0);

	$result = 1;

}



	

	include_once template("./wx/template/mine");
?>