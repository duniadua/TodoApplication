<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;

/**
 * Description of TodoRepositories
 *
 * @author sahid
 * @link www.terastekno.net
 * 
 */
use App\Todos;

class TodoRepositories {

    public $todos;

    public function __construct(Todos $todos) {
        $this->todos = $todos;
    }

    public function insert($request) {
        $svcReturn = FALSE;

        $this->todos->title = $request->title;
        $this->todos->description = $request->description;

        if ($this->todos->save()):
            $svcReturn = TRUE;
        else:
            throw new Exception("Couldnt Save The Record");
        endif;

        return $svcReturn;
    }
    
    public function update($request, $id) {
        $svcReturn = FALSE;
        $this->todos = Todos::find($id);
        
        $this->todos->title = $request->title;
        $this->todos->description = $request->description;
                
        if ($this->todos->save()):
            $svcReturn = TRUE;
        else:
            throw new Exception("Update Record Fail");
        endif;

        return $svcReturn;
    }

    public function getAll() {
        return \App\Todos::all();
    }

    public function deleteID($id) {
        $result = FALSE;
        
        if(isset($id)):
            $result = $this->findByID($id);
            if($result):
                Todos::destroy($id);
            else:
                throw new \Exception("Record ".$id." Not Found, Cannot Delete");
            endif;
        endif;
        
        return $result;
    }

    public function findByID($id) {
        $result = FALSE;

        if (isset($id)):
            $result = Todos::find($id);
            if (!$result):                  
                throw new \Exception("Record ".$id." Not Found");
            endif;        
        endif;
        
        return $result;
    }

}
