<?php

use app\models\Book;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'Code',
                'headerOptions' => ['width' => '11%'],
                'value' => function($model) {
                    return $model->code;
                }  
            ],
            [
                'header' => 'Title',
                'attribute' => 'title',
                'filter' => ArrayHelper::map(Book::find()->orderBy('title', 'ASC')->all(), 'title', 'title'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterInputOptions' => [ 'placeholder' => '*All*' ],
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'resolve'
                    ],
                ],
            ],
            [
                'noWrap' => true,
                'template' => '{view}',
                'class' => 'kartik\grid\ActionColumn'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
