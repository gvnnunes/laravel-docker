<?php

namespace App\Services;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
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

        try
        {
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

            $this->repository->create($data);
            
            return [
                'success'   => true,
                'message'   => 'Usuário cadastrado com sucesso!'
            ];
        }
        catch(Exception $ex)
        {
            return [
                'success'   => false,
                'message'   => 'Usuário não cadastrado, tente novamente.'
            ];
        }

    }

    public function update(){

    }

    public function destroy(){

    }

}