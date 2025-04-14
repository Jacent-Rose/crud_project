<?php
use yii\helpers\Html;

//THIS VIEW IS FOR READING MORE THE LATEST POSTS(in site/index), ACTION View IN PostsController.php
//THE VIEW IS DISPLAYED WHEN THE USER CLICKS ON 'View Full Post' IN THE VIEW site/index.php 

/** @var yii\web\View $this */
/** @var app\models\Posts $post */

$this->title = Html::encode($post->title ?: 'Untitled Post');
?>

<div class="user-posts container mt-5">
    <h1 class="text-center mb-4"> <?= Html::encode($this->title) ?> </h1>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body p-4">
                    <!-- Post content -->
                    <h5 class="card-title text-center"> <?= Html::encode($post->title) ?> </h5>
                    
                    <?php if ($post->description): ?>
                        <p class="text-muted text-center"> <?= Html::encode($post->description) ?> </p>
                    <?php endif; ?>
                    
                    <p class="text-muted">
                        <strong>Published on:</strong> <?= Yii::$app->formatter->asDate($post->created_at) ?>
                        <?php if ($post->created_by): ?>
                            <span class="ml-3"><strong>By:</strong> <?= Html::encode($post->createdBy->first_name) ?></span>
                        <?php endif; ?>
                    </p>
                    
                    <hr>
                    <div class="post-content">
                        <?= nl2br(Html::encode($post->post)) ?>
                    </div>
                    <hr>
                    
                    <div class="text-center">
                        <?= Html::a('Back to Posts', ['/site/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
