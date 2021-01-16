<?php

namespace App\Services;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Entities\User;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function store($data){

        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
        
            if($data['password'] == $data['password_retyped']){
                $data['password'] = bcrypt($data['password']);
            }
            else{
                return [
                    'success' => false,
                    'message' => 'As senhas não conferem.'
                ];
            }
        }
        catch(Exception $ex){
            return [
                'success' => false,
                'message' => 'Campos obrigatórios não foram preenchidos!'
            ];
        }

        try{
            $this->repository->create($data);
            return [
                'success'   => true,
                'message'   => 'Usuário cadastrado com sucesso!'
            ];
        }
        catch(Exception $ex){
            try{
                $id = DB::table('users')->where('email', $data['email'])->value('id');
                if($id == null){
                    $id = DB::table('users')->where('cpf', $data['cpf'])->value('id');
                }
                
                if(DB::table('users')->where('email', $data['email'])->where('deleted_at', null)->value('id') != null){
                    if(DB::table('users')->where('cpf', $data['cpf'])->where('deleted_at', null)->value('id') != null){
                        return [
                            'success'   => false,
                            'message'   => 'Usuário já cadastrado!'
                        ];
                    }
                                        
                    return [
                        'success'   => false,
                        'message'   => 'E-mail já cadastrado!'
                    ];
                }
                else if(DB::table('users')->where('cpf', $data['cpf'])->where('deleted_at', null)->value('id') != null){
                    return [
                        'success'   => false,
                        'message'   => 'Cpf já cadastrado!'
                    ];
                }
                else if(User::withTrashed()->find($id)->restore()){
                    return [
                        'success'   => true,
                        'message'   => 'Usuário restaurado!'
                    ];
                }             
            }
            catch(Exception $ex){
                return [
                    'success'   => false,
                    'message'   => 'Usuário não cadastrado!'
                ];
            }
        }      
    } 

    public function update(){

    }

    public function destroy($id){
        try{

            $this->repository->delete($id);

            return [
                'success'   => true,
                'message'   => 'Usuário excluído!'
            ];
        }
        catch(Exception $ex){

            return [
                'success'   => false,
                'message'   => 'Falha ao excluir usuário.'
            ];
        }
    }

}