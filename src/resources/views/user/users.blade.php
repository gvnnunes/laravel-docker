@extends('templates.master')

@section('conteudo-view')
    <section id="conteudo-users">
        <div class="container">
            <div class="row">
                <h3>Cadastro de Usuários</h3>
                <hr>
                {!! Form::open(['method' => 'post']) !!}
                    @include('templates.formularios.text', ['name' => 'nome', 'attributes' => ['placeholder' => 'Nome completo', 'class' => 'form-control', 'required']])
                    @include('templates.formularios.text', ['name' => 'cpf', 'attributes' => ['placeholder' => 'CPF', 'class' => 'form-control', 'required']])
                    @include('templates.formularios.text', ['name' => 'phone', 'attributes' => ['placeholder' => 'Telefone', 'class' => 'form-control']])
                    @include('templates.formularios.date', ['name' => 'date', 'value' => \Carbon\Carbon::now() ,'attributes' => ['class' => 'form-control']])
                    @include('templates.formularios.text', ['name' => 'email', 'attributes' => ['placeholder' => 'E-mail', 'class' => 'form-control', 'required']])
                    @include('templates.formularios.password', ['name' => 'password', 'attributes' => ['placeholder' => 'Senha', 'class' => 'form-control', 'required']])
                    @include('templates.formularios.password', ['name' => 'password_retyped', 'attributes' => ['placeholder' => 'Confirme a senha', 'class' => 'form-control', 'required']])
                    @include('templates.formularios.submit', ['value' => 'Cadastrar', 'attributes' => ['class' => 'form-control btn']])
                {!! Form::close() !!}                
            </div>
        </div>
    </section>
@endsection

@section('js-view')
    
@endsection