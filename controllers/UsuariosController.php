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

     // listar usuarios filtrado por dni
    public function actionListadoFiltrado() 
    {
        $request = Yii::$app->request;
        $usuario_dni = $request->get('dni');
        $usuario_filtrado = Usuario::findOne(['dni'=>$usuario_dni]);
        if(empty($usuario_filtrado)){
            $message = "Usuario no encontrado.";
            $this->sendResponse("error", $message);
        }else{
            $this->sendResponse("exito", $usuario_filtrado);
        }
    }

    // funcion para enviar resultado
    private function sendResponse($type,$message) {
        if($type == "error"){
            Yii::$app->response->statusCode = 400;
            return $this->asJson(['error' => $message]);
        }elseif($type == "exito"){
            Yii::$app->response->statusCode = 200;
            return $this->asJson(['exito' => $message]);
        }

    }
}
