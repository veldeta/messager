<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мессенджер';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mess-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($data){
                    return Html::a($data->title, Url::to('/mess/?id=' . $data->id));
                },
            ],
        ],
    ]); ?>


</div>
