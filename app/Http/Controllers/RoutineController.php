<?php

namespace App\Http\Controllers;

use App\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $routines = Routine::where('client_id', $user->client_id)->get()->all();

        $page = Input::get('page', 1);
        $paginate = 10;

        $offset = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($routines, $offset, $paginate, true);
        $routines = new \Illuminate\Pagination\LengthAwarePaginator(
            $itemsForCurrentPage,
            count($routines),
            $paginate,
            $page);
        $routines->setPath('routines');

        return view('routines.index', compact('user', 'routines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('routines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessLevel = $request->user()->hasAccessTo('routine', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'routine_name' => 'required',
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
            // $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('routines.create')->withErrors($validator)->withInput();
        } else {
            $routine = new Routine;

            $routine->routine_name = $request->input('routine_name');
            $routine->client_id = $request->user()->client_id;
            $routine->description = $request->input('description');

            try {
                $routine->save();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('routines.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('routines.routine_updated'));

            return redirect()->route('routines.show', $routine->routine_id);
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
        $routine = Routine::find($id);

        return view('routines.show', compact('routine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routine = Routine::find($id);

        return view('routines.edit', compact('routine'));
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
        $accessLevel = $request->user()->hasAccessTo('routine', 'edit', 0);
        if ($accessLevel < 1) {
            throw new AccessDeniedHttpException('You don\'t have permission to access this page');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'routine_name' => 'required',
            ]
        );

        if ($validator->fails()) {
            // get the error messages from the validator
            // $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return redirect()->route('routines.edit', $id)->withErrors($validator)->withInput();
        } else {
            $routine = Routine::find($id);

            $routine->routine_name = $request->input('routine_name');
            $routine->client_id = $request->user()->client_id;
            $routine->description = $request->input('description');

            try {
                $routine->save();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('routines.create')->with('error', $e->errorInfo[2]);
            }

            Session::flash('success', Lang::get('routines.routine_updated'));

            return redirect()->route('routines.show', $routine->routine_id);
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
        $routine = Routine::where('routine_id', $id)->first();

        if ($routine) {
            $routine->delete();
            Session::flash('success', Lang::get('routines.routine_deleted'));
        } else {
            Session::flash('error',  Lang::get('routines.routine_not_found'));
        }

        return redirect()->route('routines.index');
    }
}
