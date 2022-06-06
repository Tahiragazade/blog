<?php 
$session = Yii::$app->session;

?>
<? echo "Salam ";?>

<?php 
$name=$_POST['name'];
$session->set('name', $name);
$ad = $session->get($name);
echo $ad;
?>
