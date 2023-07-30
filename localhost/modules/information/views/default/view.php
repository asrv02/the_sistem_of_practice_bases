<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\ActionColumn;
use app\models\OrganizationName;
// use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Information */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="information-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить в список работодателей', ['/information/default/move', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'surname',
            'patronymic',
            'address',
            // 'organization_name_id',
            [
                'attribute' => 'organization_name_id',
                'value' => function($model){
                    return OrganizationName::findOne($model->organization_name_id)->title;
                },              
                'label' => 'Наименование организации',
                'filter' => $organization_name,
            ],
            'email:email',
            'phone',
        ],
    ]) ?>

</div>
