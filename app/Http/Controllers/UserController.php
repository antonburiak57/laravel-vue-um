<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\CustomException;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $users = User::where('first_name', 'like', '%'.$filter.'%')
                        ->orWhere('last_name', 'like', '%'.$filter.'%')
                        ->orWhere('email', 'like', '%'.$filter.'%')
                        ->paginate($request->query('perPage'), ['*'], 'page', $request->query('currentPage'));
        } else {
            $users = User::paginate($request->query('perPage'), ['*'], 'page', $request->query('currentPage'));
        }
        
        return response()->send('Users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $this->validator($request->all())->validate();
        User::create($request->all());
        return response()->send('User Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->send('Data', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, User $user)
    {
        $user->update($request->all());
        return response()->send('User Successfully Updated', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->send('User Deleted Successfully');
    }

    public function changePassword(ChangePassword $request)
    {
        throw_if(!$this->validatePassword($request->old_password), new CustomException('Old Password is Invalid'));

        $request->user()->update($request->only('password'));
        return response()->send('Password Successfully Changed', []);
    }

    public function updateProfile(UpdateProfile $request)
    {
        $request->user()->update($request->only('name'));
        return response()->send('Profile Successfully Updated', $request->user());
    }

    private function validatePassword($password)
    {
        $current_password = request()->user()->password;
        return Hash::check($password, $current_password);
    }
}
