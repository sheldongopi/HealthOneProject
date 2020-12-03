<?php
namespace controller;
include_once "view/View.php";
use view\View;
include_once "model/Patient.php";
use model\Model;

class Controller
{
    private $view;
    private $model;
    public function __construct(){
        $this->model = new Model();
        $this->view = new View($this->model);
    }
    public function loginAction()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $this->model->login($username, $password);

            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                $this->view->showPatienten();
            } else {
                $this->view->showLogin();
            }
        } else {
            $this->view->showLogin();
        }
    }
    public function logoutAction()
    {
        $this->model->logout();
        $this->view->showLogin();
    }

    public function readPatientenAction(){
        $this->view->showPatienten();
    }

    public function showFormPatientAction($id=null){
        $this->view->showFormPatienten($id);
    }
    public function createPatientAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $werking = filter_input(INPUT_POST,'werking');
        $bijwerking = filter_input(INPUT_POST,'bijwerking');
        $verzekerd = filter_input(INPUT_POST,'verzekerd');
        $result = $this->model->insertPatient($naam,$werking,$bijwerking,$verzekerd);
        $this->view->showPatienten($result);
    }
    public function updatePatientAction(){
        $id = filter_input(INPUT_POST,'id');
        $naam = filter_input(INPUT_POST,'naam');
        $werking = filter_input(INPUT_POST,'werking');
        $bijwerking = filter_input(INPUT_POST,'bijwerking');
        $verzekerd = filter_input(INPUT_POST,'verzekerd');
        $result=$this->model->updatePatient($id,$naam,$werking,$bijwerking,$verzekerd);
        $this->view->showPatienten($result);
    }
    public function deletePatientAction($id){
        $result = $this->model->deletePatient($id);
        $this->view->showPatienten($result);
    }
}