<?php
class Home extends Controller
{
    public function index()
    {
        $motor = $this->model('Motor_model');

        $data['judul'] = 'Dashboard';
        $data['total'] = count($motor->getAll());
        $data['tersedia'] = count($motor->getTersedia());
        $data['disewa'] = $data['total'] - $data['tersedia'];
        $data['motor_tersedia'] = $motor->getTersedia();

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }
}
