<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerCss("    
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color:#FAF3E0;
    }
    .custom-navbar {
        background-color:#FFFFFF !important;
        border-bottom: 2px solid #F7F7F7;
    }
    .navbar-nav .nav-item .nav-link {
        color: #333 !important;
        transition: color 0.3s ease;
    }
    .navbar-nav .nav-item .nav-link:hover {
    text-decoration: underline !important; /* Add underline on hover */
    color: inherit; /* Keep the original color */
}
    .navbar-nav.left-nav {
        margin-right: auto;
    }
    .navbar-nav.right-nav {
        margin-left: auto;
    }
        .navbar-brand {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        
        font-style: italic;
        font-family: 'Poppins', sans-serif;

        font-size: 30px; /* Double the font size */
    }
        .navbar-brand:hover {
        text-decoration: underline;
");
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on("pjax:start", function() { 
            $("#loading").show(); 
        }).on("pjax:end", function() { 
            $("#loading").hide(); 
        });

        $("a").on("click", function() {
            $("#loading").show();
        });

        $(window).on("load", function(){
            $("#loading").fadeOut();
        });
    });
</script>

    <title><?= Html::encode($this->title) ?>Rose Daily</title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="site.css">
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => 'Rose Daily',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => "navbar navbar-expand-lg navbar-light bg-light custom-navbar"]
        ]);
        echo '<div class="d-flex w-100">';
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav left-nav'],
            'items' => [
                
                Yii::$app->user->isGuest
                ? ['label' => 'Sign In', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Sign Out (' . Yii::$app->user->identity->first_name . ')',
                        ['class' => 'nav-link btn btn-link logout']
                        
                        
                    )
                    . Html::endForm()
                    . '</li>',
                   
                    
                    Yii::$app->user->isGuest
                ? ['label' => '', 'url' => ['/site/login']]
                : ['label' => "Create Posts", 'url' => ['/posts/posts'], 'options' => ['class' => 'nav-item']],
                
                Yii::$app->user->isGuest
                ? ['label' => '', 'url' => ['/site/login']]
                : ['label' => "View Posts", 'url' => ['/posts/read-posts', 'id' => Yii::$app->user->identity->id], 'options' => ['class' => 'nav-item']],
                
                //Yii::$app->user->isGuest
                // ? ['label' => '', 'url' => ['/site/login']]
                // : ['label' => "Your Info", 'url' => ['/users/read-users', 'id' => Yii::$app->user->identity->id], 'options' => ['class' => 'nav-item']],
            
                
                ]

                
        ]);
        
        if (Yii::$app->user->isGuest): ?>
            <div class="navbar-nav right-nav">
                <a href="users/users" class="nav-item">
                    <button type="button" class="btn btn-outline-secondary">Sign Up</button>
                </a>
            </div>
        <?php endif; 
        
        echo '</div>';

        /**if (!Yii::$app->user->isGuest): ?>
            <div class="navbar-nav right-nav">
                <a href="<?= \yii\helpers\Url::to(['/users/read-users', 'id'=>Yii::$app->user->identity->id]) ?>" class="nav-item right-nav">
                    <button type="button" class="btn btn-outline-info">You</button>
                </a>
            </div>
        <?php endif; 
        echo '</div>'; **/
        
     if (!Yii::$app->user->isGuest): ?>
            <div class="navbar-nav right-nav">
                <a href="<?= \yii\helpers\Url::to(['/users/read-users', 'id' => Yii::$app->user->identity->id]) ?>" class="nav-item right-nav">
                    <button type="button" class="btn btn-outline-info">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </button>
                </a>
            </div>
        <?php endif; 
        

        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <dliv class="row text-muted">
              <div class="col-md-6 text-center text-md-start">&copy; Jacent Rose <?= date('Y') ?></div>
                <dv class="col-md-6 text-center text-md-end"><?=
                                                                'Jacent Rose' ?></div>
            </div>
        </div>
    </footer>
    <div id="loading" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); z-index:9999;">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
        <img src="/path-to-your-spinner.gif" alt="Loading..." width="100">
    </div>
</div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
