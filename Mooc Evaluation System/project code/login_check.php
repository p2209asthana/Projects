<?php
$connection=mysql_connect('localhost','root','');
if(!$connection)
echo "Unable to connect".mysql_error();
mysql_select_db("project_db",$connection);

$data=mysql_query("select * from instructor_table");
while($row =mysql_fetch_array($data))
{
if (($row['email_id']==$_POST['i_emailid'])&&($row['password']==$_POST['i_password']))
{
session_start();
$_SESSION['sessionid']=$row['instructor_id'];
header('location: instructor_home.php');
}
}
echo "<center> <h1>"."Wrong username or password"."<br>"."redirecting in 2 s"."</h1><center>";
header('Refresh:2;url=main.php');


?>
</body>

</html>