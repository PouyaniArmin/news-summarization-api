<?php 

namespace App\Core;

class Controller{

    public function renderView(string $view,array $data=[]):void{
        $view=new View($view,$data);
        $view->render();
    }
}