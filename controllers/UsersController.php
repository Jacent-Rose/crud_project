<?php

namespace app\controllers;
use app\models\User;
use app\models\Users;
use Yii;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionUsers()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->password = $hash;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Thank you for signing up. Please Sign In.');

            return $this->redirect('../site/login');
        }
        return $this->render('users_form', ['model' => $model]);
    }



    public function actionReadUsers($id)
    {
        // Fetch posts by the specified user (userId)
        $model = Users::find()
        ->where(['id' => $id])
        ->orderBy(['created_at' => SORT_DESC])
        ->all();
    
        // If no posts are found, redirect or show a message
        if (empty($model)) {
            Yii::$app->session->setFlash('error', '.');
            return $this->redirect(['site/index']);  // Redirect to a relevant page if no posts are found
        }
    
        // Render the view for individual user posts
        return $this->render('users_info', ['model' => $model]);
    }
    

    /*public function actionUpdate($id)
        {
            $model = Users::findOne($id);
            if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
                Yii::$app->session->setFlash('success', 'Data saved successfully');
                return $this->redirect(['users_info']);
            }
            return $this->render('users_info', ['model' => $model]);
        }

        public function actionDelete($id)
        {
            $model = Users::findOne($id);
            $model->delete();
            return $this->redirect(['read']);
        }*/
    public function actionUpdate($id)
    {
        $model = Users::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('success', 'Your information has been updated successfully');
            return $this->redirect(['read-users' , 'id' => Yii::$app->user->id]);
        }

        return $this->render('uptdel', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Users::findOne($id);
        $model->delete();
        Yii::$app->session->setFlash('danger', 'Your account has been deleted');
        return $this->redirect(['site/index']);
        
}
}
