<?php
	require("conn.php");
	$url=$_POST["url"];
	if($url){
		if (!preg_match("/^(http|ftp|https):\/\//", $url)) {
			$url = 'http://'.$url;
		} 
		$url=stripslashes($url);
		$row=$dbh->query('SELECT id,url FROM url where url="'.$url.'";')->fetch();
		if($row[0]){
			echo "$row[1] 已经存在：<br/><input size='30' value='".$config["baseurl"].base_convert($row[0],10,36)."' onmouseover='this.select();'";
		}else{
			$sql="INSERT INTO url (url,userid) VALUES ('$url',1);";
			$dbh->exec($sql);
			$ret = $dbh->query("select last_insert_rowid()")->fetch();

			echo '<input size="30" value="'.$config["baseurl"].base_convert($ret[0],10,36).'" onmouseover="this.select();"';
		}
	}
?>
<form method="post" action="add.php">
	<input name="url"/>
	<input type="submit"/>
</form>
把下面的链接拖入书签栏即可快速实现<a href='javascript:var%20s=document.createElement("script");s.src="<?php echo $config["baseurl"];?>bookmark.php?url="+window.location.href;void(document.body.appendChild(s));'>缩短网址</a>