<?php

namespace Teste\GvdSolucoes\Session;

class SessionHandler
{
  public function set(string $key, mixed $value): void
  {
    $_SESSION[$key] = $value;
  }

  public function unset(string ...$keys): void
  {
    foreach ($keys as $key) unset($_SESSION[$key]);
  }

  public function get(string $key): mixed
  {
    return $this->hasKeys($key) ? $_SESSION[$key] : null;
  }

  public function hasKeys(string ...$keys): bool
  {
    $sessionKeys = array_keys($_SESSION);
    foreach ($keys as $key) {
      if (!in_array($key, $sessionKeys)) return false;
    }

    return true;
  }

  public function getAll(): array
  {
    return $_SESSION;
  }

  public function setObj(string $key, string $prop): mixed
  {
    return $_SESSION[$key]->{$prop};
    // $_SESSION[$key]->{$prop}
  }
}
