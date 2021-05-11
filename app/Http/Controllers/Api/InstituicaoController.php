<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function index(string $chave = '')
    {
        // Simulando como se estivesse vindo um array com os valores do banco.
        $instituicoes = array(
            array("chave" => "INSS", "valor" => "INSS"), 
            array("chave" => "FEDERAL", "valor" => "Federal"), 
            array("chave" => "SIAPE", "valor" => "Siape")
        );

        $return = array();
        
        if (!empty($chave)) {
            foreach ($instituicoes as $value) {
                if ($value['chave'] === strtoupper($chave)) {
                    array_push($return, $value);
                }
            }
        } else {
            $return = $instituicoes;
        }

        return json_encode($return);
    }
}
