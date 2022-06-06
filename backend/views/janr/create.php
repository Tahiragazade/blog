<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Janr */

$this->title = 'Create Janr';
$this->params['breadcrumbs'][] = ['label' => 'Janrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="janr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
