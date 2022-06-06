<?php

use yii\db\Query;
use yii\web\Response;

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table border="1">
		<th>id</th>
		<th>Blog name</th>
		<th>Author name</th>
<?php
$query = new Query;
$query->select('id AS blogId, name AS blogName ,author_id')
    ->from('blog')
    ->limit(10);

$rows = $query->all();
//print_r( $rows[5]);
foreach ($rows as $row) {
	echo '<tr><td>'.$row['subject'].'<td>'.$row['blogName'].'</td><tr>

';
$query1 = new Query;
$query1->select('name AS authorName')
    ->from('author')
    ->where ('id='.$row['author_id'])
    ->limit(10);

$rows2 = $query1->all();

	

foreach ($rows2 as $row1) {
echo $row1['authorName'];
}

echo'	</td></tr>';
}
?>

</table>
<br>

<? \Yii::$app->logging->nanay();?>
<br>
	<?php 

	  $session = Yii::$app->session;
  
	  $session->setFlash('Tahir',' <div class="alert alert-success alert-dismissable">
     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
     <strong>Validation error! </strong> Your message goes here.</div>');
	  echo $session->getFlash('Tahir');

	   // $session->set('user_id', '1234');
	  $session->destroySession('user_id');
   // foreach ($session as $session_name => $session_value){
      //  echo $session_name.' - '.json_encode($session_value);
      //  echo "<br>";
    //}die;
	?>


<?php
	
?>
</body>
</html>