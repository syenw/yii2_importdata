<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
?>
<!-- start content-wrapper -->
<div class="content-wrapper">
    <!-- start content-header -->
    <section class="content-header">
        <h1>
            <?php
                if ($this->title !== null) {
                    echo $this->title;
                } else {
                    echo \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id));
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } 
            ?>
        </h1>
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
    </section>
    <!-- end content-header -->

    <!-- start content -->
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
    <!-- end content -->
</div>
<!-- end content-wrapper -->

<!-- start main-footer -->
<footer class="main-footer">
    <strong>&copy; <?= date('Y'); ?> <?= Yii::$app->name; ?></strong> | Created by <strong><a href="javascript:;">Syen</a></strong> | All rights reserved.
</footer>
<!-- end main-footer -->