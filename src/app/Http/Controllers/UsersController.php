<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Services\UserService;
use Auth;
use DataTables;

class UsersController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository   = $repository;        
        $this->service      = $service;    
    }

    public function index(Request $request)
    {
        if(Auth::check()){            
            
            /*
            if($request->ajax()){
                $data = $this->repository->all();
                return Datatables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn">Editar</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'" class="delete btn">Excluir</button>';
                    $button = "<a href=\"{{ route('user.destroy', [$data->id]) }}\" class='edit btn'>Editar</a>";
                    $button .= "&nbsp;&nbsp;&nbsp;<a href=\"{{ route('user.destroy', [$data->id]) }}\" class='delete btn'>Excluir</a>";
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            */ 
            $users = $this->repository->all();

            return view('user.index', ['users' => $users]);            
        }

        return redirect()->route('user.login.page');
    }


    public function store(UserCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        
        /*
        session()->flash('success', [
            'success' => $request['success'],
            'message' => $request['message']      
        ]);        
        */
        
        if($request['success']){
            toastr()->success($request['message'], 'Sistema');
            return redirect()->back();
        }    
        toastr()->error($request['message'], 'Sistema');
        return redirect()->back()->withInput();
    }

    
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    
    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    
    public function update(UserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        $request = $this->service->destroy($id);
        
        if($request['success']){
            toastr()->success($request['message'], 'Sistema');
            return redirect()->back();
        }
        else{
            toastr()->error($request['message'], 'Sistema');
            return redirect()->back();
        }        
    }
}
