<?php

namespace App\Controllers;

use Core\Controller;

class ExampleController extends Controller
{
    public function index()
    {
        return $this->twig->render('index.html', ['name' => 'MVC']);
    }
}
