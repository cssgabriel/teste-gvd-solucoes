<?php

namespace Teste\GvdSolucoes\Services;

use Teste\GvdSolucoes\Session\SessionHandler;

class FlashMessage
{
  public static function setMessage(
    string $message,
    array $cssClass = ["alert", "alert-info"]
  ): void {
    self::sessionHandler()->set("message", [
      "description" => $message,
      "css_class" => implode(" ", $cssClass)
    ]);
  }

  public static function setError(
    string $message = "Erro. Tente novamente!",
    array $cssClass = ["alert", "alert-warning"]
  ): void {
    self::sessionHandler()->set("message", [
      "description" => $message,
      "css_class" => implode(" ", $cssClass)
    ]);
  }

  public static function getMessage(): string
  {
    $message = self::hasMessage();
    if (!$message) return "";

    return $message["description"];
  }

  public static function showFlashMessage(): void
  {
    $message = self::hasMessage();
    if (!$message) return;

    component("flash-message", $message);
    self::sessionHandler()->unset("message");
  }

  public static function hasMessage(): mixed
  {
    return self::sessionHandler()->get("message");
  }

  private static function sessionHandler()
  {
    $session = new SessionHandler;
    return $session;
  }
}
