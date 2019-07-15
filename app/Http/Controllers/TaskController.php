<?php

namespace App\Http\Controllers;


//Shahril //
use App\Task;
use Faker\Generator; //This for to use $faker generator
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; //This for to use response::


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return 'ITS Working';
	//Shahril //
	//Task::all() will show all data
	return response(Task::all()->jsonSerialize(), Response::HTTP_OK); //HTTP_OK will pass response 200

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //http://10.124.12.131/api/tasks/create
    public function create(Generator $faker)
    {
        //Shahril //
        $task = new Task();
        $task->title = $faker->sentence(2);
        $task->priority = $faker->boolean ? 'low' : 'high' ;
        $task->save();

	//return jsonSerialize to pull out data as json format
	//use response:: to show the data that successful
        return response($task->jsonSerialize(), Response::HTTP_CREATED ); //HTTP_CREATED = 201
        //return response($task->jsonSerialize() );


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //Shahril //
        $task = new Task();
        $task->title = $request->title;
        $task->priority = $request->priority;
        $task->save();

        //return jsonSerialize to pull out data as json format
        //use response:: to show the data that successful
        return response($task->jsonSerialize(), Response::HTTP_CREATED ); //HTTP_CREATED = 201
        //return response($task->jsonSerialize() );


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //Shahril //
        Task::destroy($id) ;
	return response( null, Response::HTTP_OK ) ;
    }
}



