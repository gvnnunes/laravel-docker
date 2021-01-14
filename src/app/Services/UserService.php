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

        try{

            $this->repository->create($data);
            return [
                'success'   => true,
                'message'   => 'Usuário cadastrado com sucesso!'
            ];
        }
        catch(Exception $ex){
            return [
                'success'   => false,
                'message'   => 'Falha ao cadastrar usuário!'
            ];
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