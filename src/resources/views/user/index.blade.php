@extends('templates.master')

@section('conteudo-view')   
    
    <section id="conteudo-users">
        <div class="container">
            <div class="row">
                </script>

                <h3>Cadastro de Usuários</h3>
                <hr>
                {!! Form::open(['route' => 'user.store', 'method' => 'post', 'id' => 'userstore']) !!}
                    @include('templates.formularios.text', ['name' => 'name', 'attributes' => ['placeholder' => 'Nome completo', 'class' => 'form-control', 'maxlength' => '100', 'required']])
                    @include('templates.formularios.text', ['name' => 'cpf', 'attributes' => ['placeholder' => 'CPF', 'class' => 'form-control', 'maxlength' => '11', 'pattern' => '[0-9]{11}', 'required']])
                    @include('templates.formularios.text', ['name' => 'phone', 'attributes' => ['placeholder' => 'Telefone', 'class' => 'form-control', 'maxlength' => '11', 'pattern' => '[0-9]{10-11}']])
                    @include('templates.formularios.text', ['name' => 'birth', 'attributes' => ['placeholder' => 'Data de Nascimento', 'class' => 'form-control', 'required']])                    
                    @include('templates.formularios.email', ['name' => 'email', 'attributes' => ['placeholder' => 'E-mail', 'class' => 'form-control', 'maxlength' => '100', 'required']])
                    @include('templates.formularios.password', ['name' => 'password', 'attributes' => ['placeholder' => 'Senha', 'class' => 'form-control', 'maxlength' => '50', 'required']])
                    @include('templates.formularios.password', ['name' => 'password_retyped', 'attributes' => ['placeholder' => 'Confirme a senha', 'class' => 'form-control', 'maxlength' => '50', 'required']])
                    @include('templates.formularios.submit', ['value' => 'Cadastrar', 'attributes' => ['class' => 'form-control btn']])
                {!! Form::close() !!}    
                
                <table id="user-table" class="table table-bordered w-100">
                    <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Cpf</th>
                        <th>Telefone</th>
                        <th>Data de Nascimento</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Permissão</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('js-view')
   <script>

    $(document).ready(function(){
        $('#user-table').DataTable({
            serverSide: true,
            paging: false,
            info: false,
            ajax: "{{ route('user.index') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'cpf' },
                { data: 'phone' },
                { data: 'birth' },
                { data: 'email' },
                { data: 'status' },
                { data: 'permission' },
            ]
        });
    });

    //

    $('input[name="birth"]').focus(function(){        
        if($('input[name="birth"]').val() == ""){
            $('input[name="birth"]').attr('type', 'date');    
            $('input[name="birth"]').val(getDate()); 
        }
    });

    $('input[name="birth"]').focusout(function(){        
        if($('input[name="birth"]').val() == ""){
            $('input[name="birth"]').attr('type', 'date');    
            $('input[name="birth"]').val(getDate()); 
        }
    });

    /*
    $('input[name="password_retyped"]').keyup(function(){
        if ($('input[name="password_retyped"]').val() != $('input[name="password"]').val() )
            console.log('As senhas não conferem!');
    });
    */
   
    function getDate(){
        
        return moment().format('yyyy-MM-DD');
    }

   </script>
@endsection