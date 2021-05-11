@extends('app')

@section('titulo', "Formulario para Teste API POST")

@section('conteudo')
    <h1 class="text-center mt-3">Teste API via Formulario</h1>
    <form action="{{ route('api.creditoDisponivel') }}" method="POST" class="border border-dark p-3 mt-4">
        @csrf
        <div class="mb-3">
            <label for="valor_emprestimo" class="form-label">Valor do emprestimo</label>
            <input type="number" step="0.01" class="form-control" id="valor_emprestimo" name="valor_emprestimo">
        </div><hr>
        <div class="mb-3">
            <p>Instituições</p>
            <input type="checkbox" id="bmg" name="instituicoes[]" value="BMG">
            <label for="bmg" class="form-label">BMG</label><br>
            <input type="checkbox" id="pan" name="instituicoes[]" value="PAN">
            <label for="pan" class="form-label">PAN</label><br>
            <input type="checkbox" id="ole" name="instituicoes[]" value="OLE">
            <label for="ole" class="form-label">OLE</label><br>
        </div><hr>
        <div class="mb-3">
            <p>Convênios</p>
            <input type="checkbox" id="inss" name="convenios[]" value="INSS">
            <label for="inss" class="form-label">INSS</label><br>
            <input type="checkbox" id="federal" name="convenios[]" value="FEDERAL">
            <label for="federal" class="form-label">FEDERAL</label><br>
        </div><hr>
        <div class="mb-3">
            <label for="parcelas" class="form-label">Parcelas</label>
            <input type="number" class="form-control" id="parcelas" name="parcelas">
        </div>
        <button type="submit" class="btn btn-primary">Simular Crédito</button>
    </form>
@endsection