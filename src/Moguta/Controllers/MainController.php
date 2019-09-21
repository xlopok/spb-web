<?php

namespace Moguta\Controllers;

use Moguta\Models\Users\User;
use Moguta\View\View;

class MainController
{
    private $view;

    public function main()
    {
        $this->view = New View(__DIR__ . '/../../templates');
        $this->view->renderHtml('main/main.php');
    }

    public function json($email)
    {
        $users = User::getUserByEmail($email);
        echo json_encode($users);
    }
    public function jsonlike($email)
    {
        $users = User::getUserByEmailPattern($email);
        echo json_encode($users);
    }

}
