<?php

//THIS VIEW IS NOT USED YET, IT IS FOR DISPLAYING THREE LATEST POSTS


use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="latest-blogs mt-5">
    <h2 class="text-center mb-4">Most Recent Posts</h2>
    <div class="row">
        
        <?php foreach ($model as $post): ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <!-- Post title -->
                        <h5 class="card-title"><?= Html::encode($post->title) ?></h5>
                        
                        <!-- Post description -->
                        <p class="card-text"><?= Html::encode($post->description) ?></p>
                        
                        <!-- Post content -->
                        <p class="card-text"><?= substr(Html::encode($post->post), 0, 150) ?>...</p>
                        
                        <!-- Display the created date -->
                        <p><strong><?= Yii::$app->formatter->asDatetime($post->created_at) ?></strong></p>

                        <!-- Action Buttons (Optional like and comment) -->
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="btn btn-outline-primary btn-sm">Like</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm">Comment</a>
                        </div>
                        
                        <!-- Link to full post -->
                        <div class="text-end mt-3">
                            <?= Html::a('View Full Post', ['posts/view', 'id' => $post->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
