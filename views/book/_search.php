<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'publisher') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'page') ?>

    <?php // echo $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
