<?php

use core\entities\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'filter' => false,
            ],
            [
                'value' => function (User $user) {
                    $class = $user->isAdmin() ? 'danger' : 'default';
                    return Html::tag('span', Html::encode($user->role->item_name), ['class' => 'label label-' . $class]);
                },
                'format' => 'raw',
            ],
            [
                'value' => function (User $model) {
                    return Html::a('change role', ['role', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>
