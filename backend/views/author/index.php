<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Author', ['create'], ['class' => 'btn btn-success']) ?>
        <?=Html::button('Yeni Müəllif yarat',['value'=>Url::to('index.php\?r=author%2Fcreate'),'class'=>'btn','id'=>'modalButton'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'photo',
            'ststusu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?php


Modal::begin([
    'header' => '<h4>CreateApplyment</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
    'toggleButton' => false,
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>

