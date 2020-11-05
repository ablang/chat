<?php

/* @var $this yii\web\View
 *
 * @var $model core\forms\ChatForm
 * @var $messages Chat[]
 */

use core\entities\Chat;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Chat';
?>

<div class="container">
    <div class="chat-panel panel panel-default">
        <div class="panel-heading">Chat</div>
        <div class="panel-body" style="height: 500px; overflow: auto;">
            <?php foreach ($messages as $message):
                $class = $message->user->isAdmin() ? 'text-danger' : 'text-muted';
                ?>
                <p>
                    <span class="label label-default"><?= Yii::$app->formatter->asDate($message->createdAt, 'php:d.m.Y h:i:s'); ?></span>
                    <b class="<?= $class ?>"><?= Html::encode($message->user->username) ?>:</b>
                    <?= Html::encode($message->message) ?>
                </p>
            <?php endforeach; ?>
        </div>
        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="panel-footer">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'message')->textarea(['rows' => '3', 'placeholder' => 'Your message...'])->label(false) ?>
                <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
