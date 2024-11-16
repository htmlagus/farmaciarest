<?php
require_once './app/models/farmacia.model.php';
require_once './app/views/json.view.php';

class FarmaciaApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new FarmaciaModel();
        $this->view = new JSONView();
    }

    // /api/tareas
    public function getAll($req, $res) {
        $orderBy = false;
        $orderDirection = 'asc';  // Valor predeterminado
    
        // Verificar si existe el parámetro 'orderBy'
        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
        }
    
        // Verificar si existe el parámetro 'orderDirection' (asc o desc)
        if (isset($req->query->orderDirection)) {
            $orderDirection = strtolower($req->query->orderDirection);
        }
    
        // Llamar al modelo para obtener los datos ordenados
        $compras = $this->model->getMedicamentos($orderBy, $orderDirection);
    
        // Retornar los medicamentos en la respuesta
        return $this->view->response($compras);
    }

    public function get($req, $res) {
        // obtengo el id de la tarea desde la ruta
        $id = $req->params->id;

        // obtengo la tarea de la DB
        $compra = $this->model->getMedicamento($id);

        if(!$compra) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }

        // mando la tarea a la vista
        return $this->view->response($compra);
    }

    public function create($req, $res) {
        if (empty($req->body->cantidad) || empty($req->body->nombre_droga)) {
            return $this->view->response("Faltan completar datos.", 400);
        }

        $cantidad = $req->body->cantidad;
        $fecha_compra = $req->body->fecha_compra;
        $nombre_producto = $req->body->nombre_producto;
        $nombre_droga = $req->body->nombre_droga;
        $precio = $req->body->precio;
        $cliente_foranea_id = $req->body->cliente_foranea_id;

        $id = $this->model->addMedicamento($cantidad, $fecha_compra, $nombre_producto, $nombre_droga, $precio, $cliente_foranea_id);

        if (!$id) {
            return $this->view->response("Error al insertar tarea", 500);
        }

        // buena práctica es devolver el recurso insertado
        $compra = $this->model->getMedicamento($id);
        return $this->view->response($compra, 201);

    }

    public function update($req, $res) {
        $id = $req->params->id;

        $compra = $this->model->getMedicamento($id);
        if (!$compra) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }

         // valido los datos
         if (empty($req->body->cantidad) || empty($req->body->precio) || empty($req->body->cliente_foranea_id)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $cantidad = $req->body->cantidad;
        $fecha_compra = $req->body->fecha_compra;
        $nombre_producto = $req->body->nombre_producto;
        $nombre_droga = $req->body->nombre_droga;
        $precio = $req->body->precio;
        $cliente_foranea_id = $req->body->cliente_foranea_id;

         // actualiza la tarea
         $this->model->updateMedicamento($id, $cantidad, $fecha_compra, $nombre_producto, $nombre_droga, $precio, $cliente_foranea_id);

         // obtengo la tarea modificada y la devuelvo en la respuesta
         $compra = $this->model->getMedicamento($id);
         $this->view->response($compra, 200);
 
    }

}