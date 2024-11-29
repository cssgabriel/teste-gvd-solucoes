<?php

namespace Teste\GvdSolucoes\Controller;

class Error404Controller implements Controller
{
  public function index(\PDO $pdo)
  {
    http_response_code(404);
  }
}
