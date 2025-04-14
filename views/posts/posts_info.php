<?php

// THIS VIEW IS FOR READING THE POSTS OF AN INDIVIDUAL USER - THE USER WHO IS LOGGED IN - ACTION ReadPosts IN PostsController.php
// THE VIEW IS DISPLAYED WHEN THE USER CLICKS ON 'View Posts' IN THE NAVIGATION BAR

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Posts[] $model */
 
$this->title = 'Your Posts';
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<div class="user-posts">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($model)): ?>
        <div class="row">
            <?php foreach ($model as $post): ?>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body p-4">
                            <!-- Post content -->
                            <h5 class="card-title"> <?= Html::encode($post->title) ?> </h5>
                            <p class="card-text"> <?= Html::encode($post->description) ?> </p>
                            <p class="card-text"> <?= Html::encode($post->post) ?> </p>
                            <!-- Display created date without 'Created by' -->
                            <p><strong> <?= Yii::$app->formatter->asDatetime($post->created_at) ?> </strong></p>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $post->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $post->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this post?',
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
        <p>You have no posts.</p>
    <?php endif; ?>
</div>