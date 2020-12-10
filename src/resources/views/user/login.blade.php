<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login | Gestão de Estoque</title>
</head>
<body>
    <section id="conteudo-view">
        <div class="container">
            <div class="row mx-2">
                <div id="content" class="col-lg-6 shadow-lg my-5 mx-auto pb-3">
                    <h1 class="py-3">Gestão de Estoque</h1>
                    <h4>Acesse o sistema</h4>
                    {!! Form::open(['route' => 'user.login', 'method' => 'post']) !!}

                        @if($errors->all())    
                            @foreach($errors->all() as $error)
                                <div class="alert alert-warning mt-3 mb-1" role="alert">
                                    {{ $error }}
                                </div>                            
                            @endforeach
                        @endif

                        <div class="form-group">
                            {!! Form::text('username', null, ['placeholder' => 'Usuário', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::password('password', ['placeholder' => 'Senha', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Entrar', ['placeholder' => 'Usuário', 'class' => 'form-control btn']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section> 
</body>
</html>