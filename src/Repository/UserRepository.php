<?php

namespace Teste\GvdSolucoes\Repository;

use Teste\GvdSolucoes\Entity\User;

class UserRepository
{
  public function __construct(private \PDO $pdo) {}

  public function create(array $args): bool
  {
    extract($args);
    try {
      $stmt = $this->pdo->prepare("INSERT INTO 'users' (name, email, age) VALUES (:name, :email, :age)");
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":age", $age);
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao criar usuário");
    }

    return true;
  }

  public function delete(string $id): bool
  {
    try {
      $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = :user_id;");
      $stmt->bindValue(":user_id", $id);
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao deletar usuário");
    }

    return true;
  }

  public function find(string $key, mixed $value)
  {
    try {
      $stmt = $this->pdo->query("SELECT * FROM users WHERE {$key} = :{$key}");
      $stmt->bindValue(":{$key}", $value);
      $stmt->execute();
      $res = $stmt->fetch();
    } catch (\DomainException $e) {
      throw new $e("Erro ao consultar se o produto [{$key} => {$value}] existe.");
    }
    return $res ? $this->hydrate($res) : null;
  }

  public function update(array $args, array $needle): bool
  {
    $sql = $this->updateStatmentConstruct($args, $needle);
    try {
      $stmt = $this->pdo->prepare($sql);
      foreach ($args as $k => $v) {
        $stmt->bindValue(":{$k}", $v);
      }
      foreach ($needle as $k => $v) {
        $stmt->bindValue(":{$k}", $v);
      }
      $stmt->execute();
    } catch (\DomainException $e) {
      throw new $e("Erro ao atualizar usuário");
    }

    return true;
  }

  public function hydrate(array $args)
  {
    extract($args);
    if (!isset($user_id) || !isset($name) || !isset($email) || !isset($age)) return null;

    $user = new User($user_id, $name, $email, $age);
    return $user ?? null;
  }

  public function getAll(): array
  {
    try {
      $stmt = $this->pdo->query("SELECT * FROM users");
      $stmt->execute();
      $res = $stmt->fetchAll();

      return array_map(fn($data) => $this->hydrate($data), $res);
    } catch (\Throwable $th) {
      throw new $th("Erro ao criar usuário");
    }
  }

  private function updateStatmentConstruct(array $args, array $needle): string
  {
    $sql = "UPDATE users SET ";
    foreach ($args as $key => $_) {
      $sql .= "{$key} = :{$key}, ";
    }

    $sql = substr($sql, 0, -2) . " WHERE ";

    foreach ($needle as $key => $_) {
      $sql .= "{$key} = :{$key}, ";
    }

    $sql = substr($sql, 0, -2) . ";";
    return $sql;
  }
}
