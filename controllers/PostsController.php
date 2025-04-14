<?php

namespace app\controllers;

use app\models\Posts;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostsController extends Controller
{
    public function actionPosts()
        {
            $model = new Posts();
            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->save(false);
                Yii::$app->session->setFlash('success', 'Post Created successfully'); 
                return $this->redirect(['read-posts', 'id' => Yii::$app->user->id]);
            }
            return $this->render('posts_form', ['model' => $model]);
        }

        public function actionReadPosts($id)
{
    // Fetch posts by the specified user (userId)
    $model = Posts::find()
    ->where(['created_by' => $id])
    ->orderBy(['created_at' => SORT_DESC])
    ->all();

    // If no posts are found, redirect or show a message
    if (empty($model)) {
        Yii::$app->session->setFlash('error', 'You have no posts.');
        return $this->redirect(['site/index']);  // Redirect to a relevant page if no posts are found
    }

    // Render the view for individual user posts
    return $this->render('posts_info', ['model' => $model]);
}

        public function actionUpdate($id)
    {
        $model = Posts::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('success', 'Post updated successfully');
            return $this->redirect(['read-posts', 'id' => Yii::$app->user->id]);
        }

        return $this->render('updel', ['model' => $model]);
    }
    
    public function actionDelete($id)
    {
        $model = Posts::findOne($id);
        $model->delete();
        return $this->redirect(['read-posts', 'id' => Yii::$app->user->id]);
    }
    public function actionLatest()
    {
        // Fetch the 3 most recent blogs, ordered by 'created_at' in descending order
        $model = Posts::find()
            ->orderBy(['created_at' => SORT_DESC])  // Order by the creation date (most recent first)
            ->limit(3)  // Limit to the latest 3 blogs
            ->all();

        return $this->render('latest', ['model' => $model]);
    }
    
    public function actionView($id)
{
    $post = Posts::findOne($id);
    
    if (!$post) {
        throw new NotFoundHttpException('Post not found.');
    }
    
    return $this->render('view', ['post' => $post]);
}

    }


