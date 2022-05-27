<?php

namespace app\controllers;
use app\models\Usuario;
use Yii;


class UsuariosController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Usuario';
    public $enableCsrfValidation = false;

     // listar usuarios
     public function actionListado() 
     {
         $listado = Usuario::find()->all();
         return $this->asJson($listado);
     }
}
