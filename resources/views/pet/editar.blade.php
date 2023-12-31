@php
$isMenu = false;
$navbarHideToggle = false;
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', 'Formulario')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
@if(Session::get('usuario'))
<div class="space"></div>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
    <h2 class="ui center aligned header center" style="margin-top: 30px;"> Formulário </h2>
      <hr class="my-0">
      <div class="card-body">
        <form action="{{ route('pet.atualizar', $pet->id) }}" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="row">
            <div style="display:flex; flex-direction: column; align-items:center;">        
                @if($pet->imagem)
                    <div class="mb-3 col-md-6">
                        <h4 class="ui center aligned header"> Imagem Atual </h4>
                        <img class="center d-block rounded" style="width: 250px;" src="{{asset('storage/'.$pet->imagem)}}"  id="imagem-preview">
                    </div>
                @endif

                <div class="mb-3 col-md-6">
                    <label for="imagem">Nova Imagem</label>
                    <input type="file" name="imagem" class="form-control" id="imagem" onchange="previewImage()">
                    <img class="center d-block rounded" style="width: 250px; display: none;" id="nova-imagem-preview">
                </div>

                @error('imagem')
                <div class="alert alert-danger">Erro ao atualizar a Imagem</div>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome" value="{{ old('nome', $pet->nome) }}" required>
            </div>
            @error('nome')
            <div class="alert alert-danger">Erro ao atualizar o Nome</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="tipo">Selecione o tipo do animal</label>
                <select class="form-control" name="tipo" id="tipo" required>
                    <option value="">Selecione...</option>
                    <option value="1" @if ($pet->tipo == 1) selected @endif>Cachorro</option>
                    <option value="2" @if ($pet->tipo == 2) selected @endif>Gato</option>
                    <option value="3" @if ($pet->tipo == 3) selected @endif>Roedor</option>
                    <option value="4" @if ($pet->tipo == 4) selected @endif>Outro</option>
                </select>
            </div>
            @error('castrado')
            <div class="alert alert-danger">Erro ao atualizar o dado</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="castrado">Castrado?</label>
                <select class="form-control" name="castrado" id="castrado" required>
                    <option value="">Selecione...</option>
                    <option value="1" @if ($pet->castrado == 1) selected @endif>Sim</option>
                    <option value="0" @if ($pet->castrado == 0) selected @endif>Não</option>
                </select>
            </div>
            @error('castrado')
            <div class="alert alert-danger">Erro ao atualizar o dado</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="vacinado">Vacinado?</label>
                <select class="form-control" name="vacinado" id="vacinado" required>
                    <option value="">Selecione...</option>
                    <option value="1" @if ($pet->castrado == 1) selected @endif>Sim</option>
                    <option value="0" @if ($pet->castrado == 0) selected @endif>Não</option>
                </select>
            </div>
            @error('vacinado')
            <div class="alert alert-danger">Erro ao atualizar o dado</div>
            @enderror


            <div class="mb-3 col-md-6">
                <label for="cor">Cor</label>
                <input type="text" name="cor" class="form-control" id="cor" placeholder="Digite a cor" value="{{ old('cor', $pet->cor) }}" required>
            </div>
            @error('cor')
            <div class="alert alert-danger">Erro ao atualizar a cor</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="idade">Idade</label>
                <input type="number" name="idade" class="form-control" id="idade" placeholder="Digite a Idade" value="{{ old('idade', $pet->idade) }}" required>
            </div>
            @error('idade')
            <div class="alert alert-danger">Erro ao atualizar a Idade</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="tamanho">Tamanho</label>
                <select class="form-control" name="tamanho" id="tamanho" required>
                    <option value="">Selecione...</option>
                    <option value="PP" @if ($pet->tamanho == 'PP') selected @endif>PP</option>
                    <option value="P" @if ($pet->tamanho == 'P') selected @endif>P</option>
                    <option value="M" @if ($pet->tamanho == 'M') selected @endif>M</option>
                    <option value="G" @if ($pet->tamanho == 'G') selected @endif>G</option>
                    <option value="GG" @if ($pet->tamanho == 'GG') selected @endif>GG</option>
                </select>
            </div>
            @error('tamanho')
            <div class="alert alert-danger">Erro ao atualizar o dado</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="genero">Gênero</label>
                <select class="form-control" name="genero" id="genero" required>
                    <option value="">Selecione...</option>
                    <option value="Fêmea" @if ($pet->genero == 'Fêmea') selected @endif>Fêmea</option>
                    <option value="Macho" @if ($pet->genero == 'Macho') selected @endif>Macho</option>
                </select>
            </div>
            @error('genero')
            <div class="alert alert-danger">Erro ao atualizar o dado</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="peso">Peso</label>
                <input type="number" name="peso" class="form-control" id="peso" placeholder="Digite o Peso" value="{{ old('peso', $pet->peso) }}" required>
            </div>
            @error('peso')
            <div class="alert alert-danger">Erro ao atualizar o Peso</div>
            @enderror

            <div class="mb-3 col-md-6">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Digite a Descrição" value="{{ old('descricao', $pet->descricao) }}" required>
            </div>
            @error('descricao')
            <div class="alert alert-danger">Erro ao atualizar a Descrição</div>
            @enderror

            <div class="center margin-form">
                <button type="submit" class="btn center aligned btn-primary ui button">Enviar</button>
            </div>
        </form>
    </div>
</div>
@else
<div class="space">
    <div class="ui container huge">
        <h1 class="ui center aligned header"> Você precisa ser um usuário administrador par acessar essa página.</h1>
    </div>
</div>
@endif
@endsection
<script>
   function previewImage() {
        var input = document.getElementById('imagem');
        var existingImage = document.getElementById('imagem-preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                existingImage.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            existingImage.src = '';
        }
    }
</script>