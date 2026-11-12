<?php
class Controller
{
    // Memanggil file tampilan (view)
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    // Memanggil model lalu membuat objeknya
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
}
