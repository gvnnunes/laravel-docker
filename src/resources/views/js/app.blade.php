<script>

    /* JS Usuários */

    $(document).ready(function(){
        $('#user-table').DataTable({
            paging: false,
            info: false,
            oLanguage: {
                sSearch: "Pesquisar: "
            },
            /*ajax: "{{ route('user.index') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'cpf' },
                { data: 'phone' },
                { data: 'birth' },
                { data: 'email' },
                { data: 'status' },s
                { data: 'permission' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]*/
        });
    });

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