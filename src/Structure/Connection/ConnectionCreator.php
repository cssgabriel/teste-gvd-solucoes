<?php

namespace Teste\GvdSolucoes\Structure\Connection;

use PDO;

class ConnectionCreator
{
  public static function connect(): PDO
  {
    try {
      $pdo = new PDO("sqlite:" . __DIR__ . "/../../../database.sqlite");
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
      throw new $th;
    }
    return $pdo;
  }
}
