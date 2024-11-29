<?php

namespace Teste\GvdSolucoes\Entity;

class User
{
  public function __construct(private int $id, private string $name, private string $email, private int $age) {}

  public function __get(string $name)
  {
    if (!isset($this->$name)) return;

    return $this->$name;
  }
}
