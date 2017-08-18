<?php

namespace App\Http\Controllers;

use App\Position;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $positions = Position::where('client_id', $user->client_id)->get()->all();
        $departments = Department::orderBy('department_name')->pluck('department_name', 'department_id');

        $page = Input::get('page', 1);
        $paginate = 10;

        $offset = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($positions, $offset, $paginate, true);
        $positions = new \Illuminate\Pagination\LengthAwarePaginator(
            $itemsForCurrentPage,
            count($positions),
            $paginate,
            $page);
        $positions->setPath('positions');

        return view('positions.index', compact('user', 'positions', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('department_name')->pluck('department_name', 'department_id');

        return view('positions.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessLevel = $request->user()->hasAccessTo('position', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'position_name' => 'required',
                'department_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
            // $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('positions.create')->withErrors($validator)->withInput();
        } else {
            $position = new Position;

            $position->position_name = $request->input('position_name');
            $position->department_id = $request->input('department_id');
            $position->client_id = $request->user()->client_id;
            $position->description = $request->input('description');

            try {
                $position->save();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('positions.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('positions.position_updated'));

            return redirect()->route('positions.show', $position->position_id);
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
        $position = Position::find($id);
        $department = Department::where('department_id', $position->department_id)->get()->first();

        return view('positions.show', compact('position', 'department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::find($id);
        $departments = Department::orderBy('department_name')->pluck('department_name', 'department_id');

        return view('positions.edit', compact('position', 'departments'));
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
        $accessLevel = $request->user()->hasAccessTo('position', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'position_name' => 'required',
                'department_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
            // $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('positions.edit', $id)->withErrors($validator)->withInput();
        } else {
            $position = Position::find($id);

            $position->position_name = $request->input('position_name');
            $position->department_id = $request->input('department_id');
            $position->client_id = $request->user()->client_id;
            $position->description = $request->input('description');

            try {
                $position->save();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('positions.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('positions.position_updated'));

            return redirect()->route('positions.show', $position->position_id);
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
        $position = Position::where('position_id', $id)->first();

        if ($position) {
            $position->delete();
            Session::flash('success', Lang::get('positions.position_deleted'));
        } else {
            Session::flash('error',  Lang::get('positions.position_not_found'));
        }

        return redirect()->route('positions.index');
    }
}
