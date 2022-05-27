<?php

namespace app\controllers;

class UsuariosController extends \yii\rest\ActiveController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
