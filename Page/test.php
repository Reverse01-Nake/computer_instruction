<html>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<form name="form1" method="post" action="Sample2.php">
<?
$host="localhost";
$username="";
$password="";
$db="mydatabase";
$tb="testing";
mysql_connect( $host,$username,$password) or die ("ติดต่อกับฐานข้อมูล Mysql ไม่ได้ ");
mysql_select_db($db) or die("เลือกฐานข้อมูลไม่ได้");
$sql="Select * From $tb order by rand() limit 5";
$db_query=mysql_query($sql);
$i=0;
while($result=mysql_fetch_array($db_query))
{
$i++;
?>
<table width="64%" border="0" align="center">
<tr>
<td width="18%"> <div align="center">
<input name="id[<?=$i;?>]" type="hidden" value="<?=$result["id"];?>">
<?=$result["question"];?>
</div></td>
<td width="14%"> <input name="c<?=$i;?>" type="radio" value="1" checked>
<?=$result["c1"];?>
</td>
<td width="16%"> <input type="radio" name="c<?=$i;?>" value="2">
<?=$result["c2"];?>
</td>
<td width="16%"> <input type="radio" name="c<?=$i;?>" value="3">
<?=$result["c3"];?>
</td>
<td width="15%"> <input type="radio" name="c<?=$i;?>" value="4">
<?=$result["c4"];?>
<input name="answer[<?=$i;?>]" type="hidden" value="<?=$result["answer"];?>">
</td>
</tr>
</table>
<?
}
mysql_close();
?>
<div align="center"><br>
<input type="submit" name="Submit" value="ตรวจคะแนน">
</div>
</form>
</body>
</html> 
