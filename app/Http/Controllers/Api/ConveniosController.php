<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConveniosController extends Controller
{
    public function index(string $chave = '')
    {
        // Simulando como se estivesse vindo um array com os valores do banco.
        $convenios = array(
            array("chave" => "PAN", "valor" => "Pan"), 
            array("chave" => "OLE", "valor" => "Ole"), 
            array("chave" => "BMG", "valor" => "Bmg")
        );

        $return = array();
        
        if (!empty($chave)) {
            foreach ($convenios as $value) {
                if ($value['chave'] === strtoupper($chave)) {
                    array_push($return, $value);
                }
            }
        } else {
            $return = $convenios;
        }

        return json_encode($return);
    }
}