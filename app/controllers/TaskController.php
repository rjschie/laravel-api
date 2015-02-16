<?php

use Illuminate\Support\Facades\Response;

class TaskController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Task::all(), 200, [], JSON_NUMERIC_CHECK);
	}


	/**
	 * Display one resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(Task::findOrFail($id), 200, [], JSON_NUMERIC_CHECK);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			Task::create(['text' => Input::get('text')]);
		} catch(Exception $e) {

			return Response::make("", 500);
		}

		return Response::make("", 200);
	}


	/**
	 * Update a resource with given information.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try {
			$task = Task::findOrFail($id);

			if (Input::has('completed')) {
				$input = Input::get('completed');
				$completed_time = ($input) ? DB::raw('NOW()') : null;

				$task->completed = $input;
				$task->completed_at = $completed_time;

			}

			if (Input::has('text')) {
				$task->text = Input::get('text');
			}

			$task->save();

		} catch(Exception $e) {

			return Response::make("{\"error\":\"".$e->getMessage()."\"}", 500);
		}

		return Response::make("", 200);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$task = Task::findOrFail($id);
		$task->delete();
	}


}
