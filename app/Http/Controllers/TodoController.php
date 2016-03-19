<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TodoRepositories;

class TodoController extends Controller {

    protected $todos;

    public function __construct(TodoRepositories $todos) {
        $this->todos = $todos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $todos = $this->todos->getAll();

        return view('todo.index', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        try {

            if ($this->todos->insert($request)):
                return 'Insert Success';
            endif;
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $todos = $this->todos->getAll();
            $result = $this->todos->findByID($id);

            return view('todo.show', ['result' => $result,
                'todos' => $todos,
            ]);
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            if ($this->todos->update($request, $id)):
                return 'Update Success';
            endif;
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {            
            if($this->todos->deleteID($id)):
                return redirect('todo');
            endif;            
        } catch (Exception $exc) {
            abort(404, $exc->getMessage());
        }
    }

}
