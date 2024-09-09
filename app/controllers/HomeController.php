<?php 

namespace App\Controllers;

use App\Core\Request;

class HomeController{
    public function index(Request $request){
        return "Test";
    }
    public function test($id){
        echo $id;
    }
}