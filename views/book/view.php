<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'category',
            'code:ntext',
            'title:ntext',
            'author:ntext',
        ],
    ]) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'publisher',
            'year',
            'size',
            'page',
            'price',
        ],
    ]) ?>
</div>
