<?php

use core\entities\Chat;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\ChatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'message:ntext',
            [
                'attribute' => 'userId',
                'value' => 'user.username'
            ],
            [
                'attribute' => 'hidden',
                'value' => function (Chat $chat) {
                    return $chat->isHidden() ? 'Yes' : 'No';
                }
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'filter' => false,
            ],
            [
                'label' => 'Actions',
                'value' => function (Chat $chat) {
                    $action = $chat->isHidden() ? 'show' : 'hide';
                    return Html::a($action, [$action, 'id' => $chat->id], [
                        'data' => ['method' => 'post'],
                    ]);
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>
