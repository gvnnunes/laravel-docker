@extends('templates.master')

@section('conteudo-view')   
    
    <section id="conteudo-users">
        <div class="container">
            <div class="row">
                </script>              

                <h3>Cadastro de Usuários</h3>
                <hr>
                {!! Form::open(['route' => 'user.store', 'method' => 'post']) !!}
                    @include('templates.formularios.text', ['name' => 'name', 'attributes' => ['placeholder' => 'Nome completo', 'class' => 'form-control', 'maxlength' => '100', 'required']])
                    @include('templates.formularios.text', ['name' => 'cpf', 'attributes' => ['placeholder' => 'CPF', 'class' => 'form-control', 'maxlength' => '11', 'pattern' => '[0-9]{11}', 'required']])
                    @include('templates.formularios.text', ['name' => 'phone', 'attributes' => ['placeholder' => 'Telefone', 'class' => 'form-control', 'maxlength' => '11', 'pattern' => '[0-9]{10,11}']])
                    @include('templates.formularios.text', ['name' => 'birth', 'attributes' => ['placeholder' => 'Data de Nascimento', 'class' => 'form-control', 'required']])                    
                    @include('templates.formularios.email', ['name' => 'email', 'attributes' => ['placeholder' => 'E-mail', 'class' => 'form-control', 'maxlength' => '100', 'required']])
                    @include('templates.formularios.password', ['name' => 'password', 'attributes' => ['placeholder' => 'Senha', 'class' => 'form-control', 'maxlength' => '50', 'required']])
                    @include('templates.formularios.password', ['name' => 'password_retyped', 'attributes' => ['placeholder' => 'Confirme a senha', 'class' => 'form-control', 'maxlength' => '50', 'required']])
                    @include('templates.formularios.submit', ['value' => 'Cadastrar', 'attributes' => ['class' => 'form-control btn', 'id' => 'btn']])
                {!! Form::close() !!}    
                
                <table id="user-table" class="cell-border display hover w-100">
                    <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Cpf</th>
                        <th>Telefone</th>
                        <th>Data de Nascimento</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Permissão</th>
                        <th>Ação</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->cpf }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->birth }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->permission }}</td>
                                <td>
                                    {!! Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT']) !!}                                    
                                        @include('templates.formularios.submit', ['value' => 'Editar', 'attributes' => ['class' => 'edit btn']])
                                    {!! Form::close() !!}
                                    
                                    {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE']) !!}                                    
                                        @include('templates.formularios.submit', ['value' => 'Excluir', 'attributes' => ['class' => 'delete btn']])
                                    {!! Form::close() !!}
                                </td>
                            </tr>                  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection