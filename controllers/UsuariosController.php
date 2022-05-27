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
    // eliminar usuario por dni
    public function actionEliminar() 
    {
        $request = Yii::$app->request;
        $usuario_dni = $request->get('dni');
        $usuario_filtrado = Usuario::findOne(['dni'=>$usuario_dni]);
        if(empty($usuario_filtrado)){
            $message = "Usuario no encontrado.";
            $this->sendResponse("error", $message);
        }else{
            $usuario_filtrado->delete();
            $message = "el usuario ha sido eliminado exitosamente.";
            $this->sendResponse("exito", $message);
        }
    }
    // actualizar usuario por dni
    public function actionActualizar() 
    {
        $request = Yii::$app->request;
        $usuario_dni = $request->get('dni');
        $usuario_filtrado = Usuario::findOne(['dni'=>$usuario_dni]);
        if(empty($usuario_filtrado)){
            $message = "Usuario no encontrado.";
            $this->sendResponse("error", $message);
        }else{
            $datos = $request->getBodyParams();
            $usuario_filtrado->nombre = $datos["nombre"];
            $usuario_filtrado->apellido = $datos["apellido"];
            $usuario_filtrado->edad = $datos["edad"];
            $usuario_filtrado->email = $datos["email"];
            $usuario_filtrado->dni = $datos["dni"];
            if($usuario_filtrado->save()){
                $message = "el usuario ha sido actualizado exitosamente.";
                $this->sendResponse("exito", $message);
            }else{
                $message = "ocurrió un error al guardar, por favor verifique los campos ingresados.";
                $this->sendResponse("error", $message);
            }
        }
    }
    // insertar usuario
    public function actionInsertar() 
    {
        $request = Yii::$app->request;
        $datos = $request->getBodyParams();
        if($datos["edad"] < 18){
            $message = "el usuario ingresado debe ser mayor de 18 años de edad.";
            $this->sendResponse("error", $message);
        }else{
            $usuario = new Usuario();
            $usuario->nombre = $datos["nombre"];
            $usuario->apellido = $datos["apellido"];
            $usuario->edad = $datos["edad"];
            $usuario->email = $datos["email"];
            $usuario->dni = $datos["dni"];
            if($usuario->save()){
                $message = "el usuario ha sido ingresado exitosamente.";
                $this->sendResponse("exito", $message);
            }else{
                $message = "ocurrió un error al guardar, por favor verifique los campos ingresados.";
                $this->sendResponse("error", $message);
            }
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
