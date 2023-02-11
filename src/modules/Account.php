<?php

require_once "Database_manager.php";
require_once "notification.php";

class Account {
  static ?Account $logged_in = null;
  private int $id;
  private string $username;
  private bool $admin;
  public function __construct($id, $username)
  {
    $this->id = $id;
    $this->username = $username;
    $this->admin = self::check_admin($id);
  }

  public static function logout() : void{
    self::$logged_in = null;

    if (isset($_COOKIE['login_token'])) {
      $link = Database_manager::get_connection();
      $sql = "DELETE FROM cookies WHERE cookie = ?";
      $stmt = $link->prepare($sql);
      $stmt->bind_param("s", $_COOKIE['login_token']);
      $stmt->execute();

      unset($_COOKIE['login_token']);
      setcookie('login_token', '', time() - 3600, '/'); // empty value and old timestamp
    }

    add_notification("Logged out", "success");
  }

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getUsername(): string
  {
    return $this->username;
  }

  /**
   * @return bool
   */
  public function isAdmin(): bool
  {
    return $this->admin;
  }

  function create_cookie(): void {
    $h = hash("sha256", $this->id * rand());

    setcookie('login_token', $h, 0, "/");
    $link = Database_manager::get_connection();

    $sql = "INSERT INTO cookies (Account_id, Cookie)
          VALUES (?,?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("is", $this->id, $h);
    $stmt->execute();
  }

  static function login($username, $password): Account | null {
    $link = Database_manager::get_connection();
    $sql = "SELECT ID FROM account WHERE Username = ? and Password = ? LIMIT 1";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $r = $stmt->get_result();

    if ($r->num_rows > 0) {
      $r = $r->fetch_row();

      $a = new account($r[0], $username);
      $a->create_cookie();
      self::$logged_in = $a;
      return $a;
    }
    return null;
  }

  private static function check_admin($id) : bool{
    $link = Database_manager::get_connection();
    $sql = "SELECT Account_Id FROM admin WHERE Account_Id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
  }

  static function check_login(): Account | null {
    if (self::$logged_in != null)
      return self::$logged_in;

    if (isset($_COOKIE['login_token'])) {
      $link = Database_manager::get_connection();
      $sql = "SELECT id, Username FROM cookies JOIN account ON Account_id = account.ID WHERE Cookie = ? LIMIT 1";
      $stmt = $link->prepare($sql);
      $stmt->bind_param("s", $_COOKIE['login_token']);
      $stmt->execute();
      $r = $stmt->get_result()->fetch_row();

      $a = new Account($r[0], $r[1]);
      self::$logged_in = $a;
      return $a;
    }
    return null;
  }

  static function create_account($Username, $Password): Account {
    $link = Database_manager::get_connection();

    $sql = "INSERT INTO Account (Username, Password)
          VALUES (?,?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ss", $Username, $Password);
    $stmt->execute();

    $sql = "SELECT ID FROM Account WHERE Username = ? AND Password = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ss", $Username, $Password);
    $stmt->execute();
    $r = $stmt->get_result();

    // TODO: Get ID
    $a = new Account($r->fetch_row()[0], $Username);
    $a->create_cookie();
    return $a;
  }
}
