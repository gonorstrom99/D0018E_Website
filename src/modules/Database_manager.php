<?php

require_once "Config.php";

/**
 * Class used for maintaining database connections.
 *
 * @author Fredrik Falk
 * @see https://stackoverflow.com/questions/1580738/how-do-you-manage-database-connections-in-php
 */
class Database_manager {
  private static bool $initialized = false;
  private static bool | \mysqli $connection = false;

  protected function __construct() {}

  /**
   * Launches a mysql connection.
   *
   * @return void
   */
  private static function connect(): void
  {
    self::$connection = mysqli_connect(
      Config::get('Database', 'Host'),
      Config::get('Database', 'Username'),
      Config::get('Database', 'Password'),
      Config::get('Database', 'Database'),
      Config::get('Database', 'Port')
    );
  }

  /**
   * Retrieves the current open connection,
   * or initializes it if not open
   *
   * @return bool|mysqli
   */
  public static function get_connection(): bool|\mysqli
  {
    if (!self::$initialized)
      self::connect();
    else
      mysqli_ping(self::$connection);

    return self::$connection;
  }
}
