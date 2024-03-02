<?php
use App\Core\Router;
use App\Core\Request;
use App\Controllers\TaskController;
require '_init.php';



//$url = trim($_SERVER['REQUEST_URI'], '/');




    Router::make()->get('', [TaskController::class, 'index'])
        ->get('about', 'app/Controllers/about.php')
        ->get('task/delete', [TaskController::class, 'delete'])
        ->get('task/update', [TaskController::class, 'update'])

        ->post('task/create', [TaskController::class, 'create'])->resolve(Request::uri(), Request::method());



//if(array_key_exists($url, $routes)) {
//    require $routes[$url];
//} else {
//    throw new Exception('Page Not Found');
//}

//QueryBuilder::update('tasks', 11, [
//    'description' => 'updated two',
//    'completed' => 1
//]);
//QueryBuilder::insert('tasks',[
//    'description' => 'task 9' ,
//    'completed' => 0
//]
//);
//
