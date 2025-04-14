<?php

//THIS  VIEW IS FOR UPDATING A POST ACTION Update IN PostsController.php
//THE VIEW IS DISPLAYED WHEN THE USER CLICKS ON 'Update icon' IN THE VIEW posts/posts_info.php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
/** @var ActiveForm $form */

?>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= Yii::t('app', 'Create a New Post') ?></h4>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="mb-3">
                <?= $form->field($model, 'title')->textInput(['class' => 'form-control']) ?>
            </div>

            <div class="mb-3">
                <?= $form->field($model, 'description')->textarea(['rows' => 3, 'class' => 'form-control']) ?>
            </div>

            <div class="mb-3">
                <?= $form->field($model, 'post')->textarea(['rows' => 6, 'class' => 'form-control']) ?>
            </div>

            <div class="d-grid">
                <?= Html::submitButton(Yii::t('app', 'Update Post'), ['class' => 'btn btn-success btn-lg']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
