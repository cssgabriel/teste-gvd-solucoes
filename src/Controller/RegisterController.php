<?php

namespace Teste\GvdSolucoes\Controller;

use Teste\GvdSolucoes\Repository\UserRepository;
use Teste\GvdSolucoes\Services\FlashMessage;

class RegisterController implements Controller
{
  public function index(\PDO $pdo) {}

  public function create(\PDO $pdo)
  {
    return view("register");
  }

  public function store(\PDO $pdo)
  {
    verifyCsfrToken();
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT, ['options' => array('min_range' => 1)]);

    foreach (["name" => $name,  "email" => $email, "age" => $age] as $fieldName => $fieldValue) {
      if (!$fieldValue) {
        FlashMessage::setError("Campo '{$fieldName}' inválido. Tente novamente!");
        return redirect("/register");
      }
    }

    $userRepo = new UserRepository($pdo);

    if ($userRepo->find('email', $email)) {
      FlashMessage::setError("Dados inválidos. Tente novamente!");
      redirect("/register");
    }

    $userRepo->create([
      "name" => $name,
      "email" => $email,
      "age" => $age,
    ]);

    FlashMessage::setMessage("Usuário cadastrado com sucesso", ['alert', 'alert-success']);
    redirect("/");
    echo 'a';
  }
}
