<?php
session_start();
include('subfiles/_dbconnect.php');
$uid=$_SESSION['id'];
$time=time();
$res=mysqli_query($conn,"select * from users");
$i=1;
$html='';
while($row=mysqli_fetch_assoc($res)){
	$status='Offline';
	$class="btn-danger";
	if($row['last_login']>$time){
		$status='Online';
		$class="btn-success";
	}
    if ($status == "Online") {
	$html.='<tr>
                  <th scope="row">'.$i.'</th>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['Id'].'</td>
                  <td><button type="button" class="btn '.$class.'">'.$status.'</button></td>
               </tr>';
	$i++;
}}
echo $html;
?>