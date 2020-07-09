<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Allow from any origin
//if (isset($_SERVER['HTTP_ORIGIN'])) {
//    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//    header('Access-Control-Allow-Credentials: true');
//    header('Access-Control-Max-Age: 86400');    // cache for 1 day
//}
//// Access-Control headers are received during OPTIONS requests
//if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//    exit(0);
//}

class Read extends CI_Controller {

    public function __construct() {
        //
        parent::__construct();
        //
        $this->load->model('Visualizador');
    }

    //
    function fechaHora() {
        //
        date_default_timezone_set('America/Bogota');
        $fecha = date('d-m-Y');
        $numerodia = (int) date('w');
        $hora12 = date('g:i');
        $horat = date('A');
        //
        $dia = '';
        //
        if ($numerodia === 0) {
            //
            $dia = 'Domingo';
        } else if ($numerodia === 1) {
            //
            $dia = 'Lunes';
        } else if ($numerodia === 2) {
            //
            $dia = 'Martes';
        } else if ($numerodia === 3) {
            //
            $dia = 'Miercoles';
        } else if ($numerodia === 4) {
            //
            $dia = 'Jueves';
        } else if ($numerodia === 5) {
            //
            $dia = 'Viernes';
        } else if ($numerodia === 6) {
            //
            $dia = 'Sabado';
        }
        //
        echo json_encode(array(
            'fecha' => $dia . ' ' . $fecha,
            'hora' => $hora12 . ' ' . $horat
        ));
    }
    
    //
    function login(){
        //
        $rsp = $this->Visualizador->login();
        //
        echo json_encode($rsp);
    }
    
    //
    function cargarLlamados(){
        //
        $rsp = $this->Visualizador->cargarLlamados(1);
        //
        echo json_encode($rsp);
    }
    
    //
    function cargarLlamadosV(){
        //
        $rsp = $this->Visualizador->cargarLlamados(2);
        //
        echo json_encode($rsp);
    }
    
    //
    function cargarCodigoAzules(){
        //
        $rsp = $this->Visualizador->cargarCodigoAzules();
        //
        echo json_encode($rsp);
    }
    
}
