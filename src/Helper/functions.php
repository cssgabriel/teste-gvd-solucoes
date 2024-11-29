<?php

function view(string $view, array $context = [])
{
  $pathView = __DIR__ . "/../../views/{$view}.php";

  if (!file_exists($pathView)) return;

  ob_start();
  extract($context);
  require __DIR__ . "/../../views/template.php";
  $html = ob_get_clean();
  echo ($html);
}

function component(string $component, array $context = [])
{
  if (str_contains($component, ".")) $component = str_replace(".", "/", $component);

  $pathComponent = __DIR__ . "/../../views/components/{$component}.php";
  if (!file_exists($pathComponent)) return;

  ob_start();
  extract($context);

  $html = <<<FLASH
    <div class="{$css_class} position-absolute" style='top: 1rem; right: 1rem;'>
      {$description}
    </div>
  FLASH;
  echo $html;

  $a = ob_get_clean();
  echo ($a);
}

function dd(mixed ...$args)
{
  if (count($args) === 0) return;
  echo "<pre>";
  var_dump(...$args);
  echo "</pre>";
  die;
}

function getCsfrToken()
{
  return $_SESSION["csfr_token"]  ?? "";
}

function setCsfrToken()
{
  $_SESSION["csfr_token"] = bin2hex(random_bytes(35));
}

function verifyCsfrToken()
{
  $token = filter_input(INPUT_POST, "csfr_token", FILTER_SANITIZE_SPECIAL_CHARS);

  if (!$token || $token !== getCsfrToken()) {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
    exit;
  }
}

function csfr()
{
  setCsfrToken();
  return getCsfrToken();
}

function redirect($path, $status = 302)
{
  header("Location: {$path}", false, $status);
  exit;
}
