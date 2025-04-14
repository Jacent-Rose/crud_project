<?php

// THIS VIEW IS FOR READING THE INFO OF AN INDIVIDUAL USER - THE USER WHO IS LOGGED IN - ACTION ReadUsers IN UsersController.php
// THE VIEW IS DISPLAYED WHEN THE USER CLICKS ON 'You' IN THE NAVIGATION BAR

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\User[] $model */

$this->title = 'Your Information';
?>
<head>
    <!-- Ensure Bootstrap and Font Awesome are included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<div class="user-info">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($model)): ?>
        <div class="row">
            <?php foreach ($model as $user): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <!-- User information -->
                            <h5 class="card-title"><?= Html::encode($user->first_name . ' ' . $user->last_name) ?></h5>
                            <p class="card-text"><strong>Gender:</strong> <?= Html::encode($user->gender) ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= Html::encode($user->email) ?></p>
                            <p class="card-text"><strong>Phone Number:</strong> <?= Html::encode($user->phone_number) ?></p>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $user->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this user?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No user information found.</p>
    <?php endif; ?>
</div>
