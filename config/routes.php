<?php

use Teste\GvdSolucoes\Controller\{
  HomeController,
  RegisterController,
  UserController,
};

return [
  "GET|/" => [HomeController::class, "index"],
  "GET|/register" => [RegisterController::class, "create"],
  "POST|/register" => [RegisterController::class, "store"],
  "GET|/users" => [UserController::class, "index"],
];
