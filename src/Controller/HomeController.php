<?php

namespace Teste\GvdSolucoes\Controller;

use Teste\GvdSolucoes\Repository\UserRepository;

class HomeController implements Controller
{
  public function index(\PDO $pdo)
  {
    $userRepo = new UserRepository($pdo);
    $users = $userRepo->getAll();

    return view("home", [
      'users' => $users
    ]);
  }
}
