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
            $data['password'] = bcrypt($data['password']);
            $user = $this->repository->create($data);

            return [
                'success'   => true,
                'message'   => 'Usuário cadastrado.',
                'data'      => $user
            ];
        }
        catch(Exception $ex)
        {
            return [
                'success'   => false,
                'message'   => $ex
            ];
        }

    }

    public function update(){

    }

    public function destroy(){

    }

}