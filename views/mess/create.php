<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mess */

$this->title = 'Create Mess';
$this->params['breadcrumbs'][] = ['label' => 'Messes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mess-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
