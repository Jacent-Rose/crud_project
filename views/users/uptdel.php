<?php

//THIS  VIEW IS FOR UPDATING USER INFO - ACTION Update IN UsersController.php
//THE VIEW IS DISPLAYED WHEN THE USER CLICKS ON 'Update icon' IN THE VIEW users/users_info.php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
/** @var ActiveForm $form */
?>

<style>
    .form-control {
        border: 2px solid #007bff; /* Blue border */
        border-radius: 5px; /* Rounded corners */
    }
    
    .form-check-input {
        border: 2px solid #007bff; /* Blue border for radio buttons */
    }

    .btn-primary {
        border: 2px solid #007bff; /* Blue border for button */
    }
</style>
<h5 class="text-center mb-4" style="color: #007bff;">Fill in this form to Sign Up</h5>

<div class="users_form container border p-4 rounded shadow">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'row g-3']]); ?>
    
    <div class="col-md-6">
        <?= $form->field($model, 'first_name')->textInput(['class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'last_name')->textInput(['class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'email')->input('email', ['class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'phone_number')->textInput(['class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <!-- Gender Radio Buttons -->
        <div class="form-check">
            <?= $form->field($model, 'gender')->radioList([
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other'
            ], [
                'item' => function ($index, $label, $name, $checked, $value) {
                    $checked = $checked ? 'checked' : '';
                    return '<div class="form-check">
                                <input class="form-check-input" type="radio" name="' . $name . '" value="' . $value . '" ' . $checked . '>
                                <label class="form-check-label">' . $label . '</label>
                            </div>';
                }
            ])->label(false) ?>
        </div>
    </div>

    
    <div class="col-md-6">
        <?= $form->field($model, 'username')->textInput(['class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'confirm_password')->passwordInput(['class' => 'form-control']) ?>
    </div>
    
   

    <div class="d-grid col-12 text-center">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- users_form -->
