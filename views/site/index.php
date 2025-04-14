<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;



AppAsset::register($this);


$this->title = 'Rose Daily ';
?>



    <style>
        .welcome-banner-img {
            width: 1080px;
            height:300px;



        }
    </style>


<div class="site-index">

    <!-- <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Jacent Rose Blog</h1>

        <p class="lead">Start blogging today!</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['users/users']) ?>">Sign Up</a></p>
    </div>
-->


    <div class="body-content">
        <div class="latest-posts mt-0">
            <div class=image-banner>
                <!-- Replace 'welcome_image.jpg' with the actual   web/Images/download.jpeg filename of your image -->
                <?= Html::img('web/uploads/download.jpeg', ['alt' => 'Welcome to Rose Daily', 'class' => 'welcome-banner-img']) ?>
            </div>
            <h2 class="text-center mt-1 p-2 bg-primary text-white rounded" style="max-width: 1085px;">Our Latest Posts</h2> <!-- Latest Posts heading added -->
            <div class="row">
                <!--<div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div> -->


                <!-- <div class="featured-blogs mt-5">
            <h2 class="text-center">Featured Blogs</h2>
            <a href="
            "class="btn btn-primary">Read More</a>

        </div> -->



                <?php if (!empty($model)): ?>
                    <div class="col-md-12 mb-4" style="max-width: 1110px;">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <!-- Post title -->
                                <h5 class="card-title"><?= Html::encode($model[0]->title) ?></h5>

                                <!-- Post description -->
                                <p class="card-text"><?= Html::encode($model[0]->description) ?></p>

                                <!-- Post content -->
                                <p class="card-text"><?= substr(Html::encode($model[0]->post), 0, 150) ?>...</p>

                                <!-- Created at -->
                                <p><small class="text-muted"><?= Yii::$app->formatter->asDatetime($model[0]->created_at) ?></small></p>

                                <!-- Link to view the full post -->
                                <div class="text-end mt-3">
                                    <?= Html::a('Read Full Post', ['posts/view', 'id' => $model[0]->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subsequent Posts: 2 columns -->
                    <div class="row">
                        <?php foreach (array_slice($model, 1) as $post): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <!-- Post title -->
                                        <h5 class="card-title"><?= Html::encode($post->title) ?></h5>

                                        <!-- Post description -->
                                        <p class="card-text"><?= substr(Html::encode($post->description), 0, 150) ?>...</p>

                                        <!-- Post content -->
                                        <p class="card-text"><?= substr(Html::encode($post->post), 0, 150) ?>...</p>

                                        <!-- Created at -->
                                        <p><small class="text-muted"><?= Yii::$app->formatter->asDatetime($post->created_at) ?></small></p>

                                        <!-- Link to view the full post -->
                                        <div class="text-end mt-3">
                                            <?= Html::a('Read Full Post', ['posts/view', 'id' => $post->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No posts available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>