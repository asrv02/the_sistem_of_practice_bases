<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Applicationstud;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationstudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applicationstuds';
?>
<div class="applicationstud-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Applicationstud', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'employer_id',
            'employer_lists_id',
            'specialization_id',
            'status_id',
            'organization_name_id',

        ],
    ]); ?>


</div>
