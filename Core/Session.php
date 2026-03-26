<?php


class Session
{
  // starts a new session
  public static function start()
  {
    session_start();
    self::check_timeout();
    return true;
  }

  public static function stop()
  {
    (new self)::start();
    return session_destroy();
  }

  public static function delete(string $session_name)
  {
    unset($_SESSION[$session_name]);
  }

  // Check for session timeout (30 minutes of inactivity by default)
  public static function check_timeout($timeout_seconds = 1800)
  {
    if (isset($_SESSION['last_activity'])) {
      $inactive_time = time() - $_SESSION['last_activity'];

      if ($inactive_time > $timeout_seconds) {
        session_destroy();
        header("Location: login.php?timeout=1");
        exit();
      }
    }
    // Update last activity time
    $_SESSION['last_activity'] = time();
  }
}
