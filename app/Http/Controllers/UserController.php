<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Ramsey\Uuid\Uuid;


class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $users = $this->userRepository->all();

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
       // $input = $request->all();
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['password'] = bcrypt($request->password);
        $input['is_admin'] = $request->is_admin;
        
        $file = $request->file('avatar');
        $destination_path = 'uploads';
        $name_file = 'user-'.  Uuid::uuid4().'.'.$file->getClientOriginalExtension();
        $file->move($destination_path, $name_file);
        $input['avatar'] = $name_file;
        
        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

      return redirect(route('users.index'));
//        return response()->json($user);
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
  //      return response()->json($user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
        return view('users.edit')->with('user', $user);
//        return response()->json($user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
       // $user = $this->userRepository->update($request->all(), $id);
       $input['username'] = $request->username;
       $input['email'] = $request->email;
       $input['password'] = bcrypt($request->password);
       $input['is_admin'] = $request->is_admin;
       
       $file = $request->file('avatar');
       
       if($file) {
           @unlink('uploads/'. $user->avatar);
           $destination_path = 'uploads';
           $file_name = 'user-'.Uuid::uuid4().$file->getClientOriginalExtension();
           $file->move($destination_path, $file_name);
           $input['avatar'] = $file_name;
       } else {
           @unlink('uploads/'. $user->avatar);
       }
       $user = $this->userRepository->update($input, $id);
            
        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
        //return response()->json($user);
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        @unlink('uploads/'.$user->avatar);
        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');
        return redirect(route('users.index'));
        //return response()->json($user);
    }
}

