<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreditoDisponivelController extends Controller
{
    public function index(Request $request)
    {
        $return = [];
        $valorEmprestimo = is_numeric($request->valor_emprestimo) ? (float) $request->valor_emprestimo : '';
        $instituicoes = $request->instituicoes;
        $convenios = $request->convenios;
        $parcelas = is_numeric($request->parcelas) ? (int) $request->parcelas : false;
        
        if (!isset($valorEmprestimo) || empty($valorEmprestimo)) {
            $return['error'] = 1;
            $return['msg'] = 'O parâmetro valor do emprestimo é obrigatorio!';
            return print_r(json_encode($return));
        }
        
        // Simulando como se estivesse vindo um array com os valores do banco.
        $creditoDisponivel = array(
            'BMG' => array(["taxa" => 2.05, "parcelas" => 72, "valor_parcela" => 0.02604, "convenio" => "INSS"],
                           ["taxa" => 2.05, "parcelas" => 60, "valor_parcela" => 0.03015, "convenio" => "INSS"],
                           ["taxa" => 2.05, "parcelas" => 48, "valor_parcela" => 0.03529, "convenio" => "INSS"],
                           ["taxa" => 2.05, "parcelas" => 36, "valor_parcela" => 0.04719, "convenio" => "INSS"],
                           ["taxa" => 1.90, "parcelas" => 84, "valor_parcela" => 0.024384, "convenio" => "INSS"]),
            'PAN' => array(["taxa" => 2.05, "parcelas" => 48, "valor_parcela" => 0.03429, "convenio" => "INSS"],
                           ["taxa" => 2.08, "parcelas" => 72, "valor_parcela" => 0.02843, "convenio" => "INSS"],
                           ["taxa" => 2.10, "parcelas" => 36, "valor_parcela" => 0.03125, "convenio" => "FEDERAL"]),
            'OLE' => array(["taxa" => 2.05, "parcelas" => 60, "valor_parcela" => 0.03035, "convenio" => "INSS"],
                           ["taxa" => 2.08, "parcelas" => 72, "valor_parcela" => 0.02843, "convenio" => "INSS"])
        );
        
        $return = array(
            'BMG' => array(),
            'PAN' => array(),
            'OLE' => array()
        );

        // Validação para filtrar as intituições solicitadas, caso nenhuma tenha sido solicitada todas vão ser consideras.
        if (is_array($instituicoes) && !empty($instituicoes)) {

            foreach ($creditoDisponivel as $key => $value) {
                if (!in_array($key, $instituicoes)) {
                    unset($creditoDisponivel[$key]);
                }
            }
        }

        // Validação para filtrar as convênios e parcelas solicitadas, caso nenhuma tenha sido solicitada todas vão ser consideras.
        if (is_array($convenios) && !empty($convenios)) {

            foreach ($creditoDisponivel as $key => $value) {
                foreach ($value as $chave => $valor) {
                    if (!in_array($valor["convenio"], $convenios)) {
                        unset($creditoDisponivel[$key][$chave]);
                    }
                    if ($parcelas !== false) {
                        if ($valor["parcelas"] !== $parcelas) {
                            unset($creditoDisponivel[$key][$chave]);
                        }
                    }
                }
            }
        }

        foreach ($creditoDisponivel as $key => $value) {
            foreach ($value as $chave => $valor) {
                $creditoDisponivel[$key][$chave]["valor_parcela"] = round($valor["valor_parcela"] * $valorEmprestimo);
                array_push($return[$key], $creditoDisponivel[$key][$chave]);
            }
        }

        return json_encode($return);
    }

}
