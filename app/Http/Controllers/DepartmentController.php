<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $departments = Department::where('client_id', $user->client_id)->get()->all();

        $page = Input::get('page', 1);
        $paginate = 10;

        $offset = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($departments, $offset, $paginate, true);
        $departments = new \Illuminate\Pagination\LengthAwarePaginator(
            $itemsForCurrentPage,
            count($departments),
            $paginate,
            $page);
        $departments->setPath('departments');

        return view('departments.index', compact('user', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessLevel = $request->user()->hasAccessTo('department', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'department_name' => 'required',
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
            // $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('departments.create')->withErrors($validator)->withInput();
        } else {
            $department = new Department;

            $department->department_name = $request->input('department_name');
            $department->client_id = $request->user()->client_id;
            $department->description = $request->input('description');

            try {
                $department->save();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('departments.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('departments.department_updated'));

            return redirect()->route('departments.show', $department->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);

        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);

        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accessLevel = $request->user()->hasAccessTo('department', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'department_name' => 'required',
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
            // $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('departments.edit', $id)->withErrors($validator)->withInput();
        } else {
            $department = Department::find($id);

            $department->department_name = $request->input('department_name');
            $department->client_id = $request->user()->client_id;
            $department->description = $request->input('description');

            try {
                $department->save();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('departments.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('departments.department_updated'));

            return redirect()->route('departments.show', $department->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::where('department_id', $id)->first();

        if ($department) {
            $department->delete();
            Session::flash('success', Lang::get('departments.department_deleted'));
        } else {
            Session::flash('error',  Lang::get('departments.department_not_found'));
        }

        return redirect()->route('departments.index');
    }
}
