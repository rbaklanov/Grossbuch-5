<?php

namespace App\Http\Controllers;

use App\User;
use App\Position;
use App\Department;
use App\AccessPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $users = User::where('client_id', $request->user()->client_id)->get()->all();

        $page = Input::get('page', 1);
        $paginate = 10;

        $offset = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($users, $offset, $paginate, true);
        $users = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($users), $paginate, $page);
        $users->setPath('users');

        return view('users.index', compact('user', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        $roles = Role::all()->get()->pluck('name', 'role_id');
//        $clients = Client::all()->get()->pluck('name', 'client_id');
//        $departments = Department::all()->get()->pluck('name', 'department_id');
//        $positions = Position::all()->get()->pluck('name', 'position_id');

        $roles = [5,6];
        $clients = [7,8];
        $positions = Position::orderBy('position_name')->pluck('position_name', 'position_id');
        $departments = Department::orderBy('department_name')->pluck('department_name', 'department_id');

        return view('users.create', compact('roles', 'clients', 'departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessLevel = $request->user()->hasAccessTo('user', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator =  Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
                'role_id' => 'required',
                'client_id' => 'required',
                'department_id' => 'required',
                'position_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
//            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('users.create')->withErrors($validator)->withInput();
        } else {
            $user = new User;

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role_id = $request->input('role_id');
            $user->client_id = $request->input('client_id');
            $user->department_id = $request->input('department_id');
            $user->position_id = $request->input('position_id');
            $user->birthday = date_create($request->input('birthday') . '00:00');
            date_format($user->birthday, 'U = d-m-Y H:i:s');
            $user->description = $request->input('description');
            if (null !== $request->file('avatar')) {
                $imageName = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->move(public_path('img'), $imageName);
                $user->avatar_image_name = $imageName;
            } else {
                $user->avatar_image_name = null;
            }

            try {
                $user->save();
            } catch ( \Illuminate\Database\QueryException $e) {
                return redirect()->route('users.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('users.user_added'));

            return redirect()->route('users.show', $user->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $department = Department::where('department_id', $user->department_id)->get()->first();

        return view('users.show', compact('user', 'department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $user_birthday = date_create($user->birthday);
        $user_birthday = date_format($user_birthday, 'd-m-Y');

        $roles = [5,6];
        $clients = [7,8];
        $positions = Position::orderBy('position_name')->pluck('position_name', 'position_id');
        $departments = Department::orderBy('department_name')->pluck('department_name', 'department_id');

        return view('users.edit', compact('user', 'user_birthday', 'roles', 'clients', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accessLevel = $request->user()->hasAccessTo('user', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator =  Validator::make(
            $request->except('old_password', 'new_password', 'password_confirmation'),
            [
                'name' => 'required',
                'email' => 'required|email',
                'role_id' => 'required',
                'client_id' => 'required',
                'department_id' => 'required',
                'position_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
//            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        } else {
            $user = User::find($id);

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role_id');
            $user->client_id = $request->input('client_id');
            $user->department_id = $request->input('department_id');
            $user->position_id = $request->input('position_id');
            $user->birthday = date_create_from_format('d-m-Y', $request->input('birthday'));
//            $user->birthday = date_format($user->birthday, 'd-m-Y');
            $user->description = $request->input('description');
            if (null !== $request->file('avatar')) {
                $imageName = time().'.'.$request->file('avatar')->getClientOriginalExtension();
                $request->file('avatar')->move(public_path('img'), $imageName);
                $user->avatar_image_name = $imageName;
            }

            try {
                $user->save();
            } catch ( \Illuminate\Database\QueryException $e) {
                return redirect()->route('users.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('users.user_updated'));

            return redirect()->route('users.show', $user->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->delete();
            Session::flash('success', Lang::get('users.user_deleted'));
        } else {
            Session::flash('error',  Lang::get('users.user_not_found'));
        }

        return redirect()->route('users.index');
    }

    public function updatePassword(Request $request)  {
        $passwords =  $request->only('old_password', 'new_password', 'new_password_confirmation');
        $user = User::find($request->input('user_id'));

        $validator =  Validator::make(
            $passwords,
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6|confirmed|different:old_password',
                'new_password_confirmation' => 'required|different:old_password',
            ]
        );

        if ($validator->fails()) {
            $errors = '';
            $mbErrors = $validator->errors();
            foreach ($mbErrors->all() as $message) {
                $errors .= $message.'<br>';
            }
        }
        if (isset($errors)) {
            return json_encode([
                'success' => false,
                'error'   => substr($errors, 0, -4)
            ]);
        }

        // проверка правильности ввода старого пароля
        if (! Auth::guard()->attempt(['email' => $user->email, 'password' => $passwords['old_password']])) {
            return json_encode([
                'success' => false,
                'error' =>  Lang::get('validation.wrong_old_password')
            ]);
        }

        $user->password = bcrypt($passwords['new_password']);
        $user->save();

        return json_encode([
            'success' => true,
            'error'   => ''
        ]);
    }
}