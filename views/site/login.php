<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Sign In';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login d-flex justify-content-center align-items-center vh-50 ">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center mb-4"><?= Html::encode($this->title) ?></h2>
        <p class="text-center text-muted">Please fill out the following fields to sign in:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>

        <?= $form->field($model, 'username', [
            'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter your username', 'autofocus' => true]
        ])->label(false) ?>

        <?= $form->field($model, 'password', [
            'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Enter your password']
        ])->passwordInput()->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([ 'class' => 'form-check-input' ])->label('Remember me', ['class' => 'form-check-label']) ?>

        <div class="text-center mt-3">
            <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary w-100']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
