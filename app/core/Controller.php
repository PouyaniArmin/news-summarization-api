<?php 

namespace App\Core;

class Controller{

    public function renderView(string $view,array $data=[]){
        $view=new View($view,$data);
        return $view->render();
    }
}