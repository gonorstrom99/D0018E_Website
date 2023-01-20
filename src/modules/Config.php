<?php

/**
 * Class used for parsing project config
 *
 * @author Fredrik Falk
 * @see https://www.demo2s.com/php/php-self-config-array-merge-self-config-parse-ini-file-path-t.html
 */
class Config {
  private static array|bool $config = false;

  protected function __construct() {}

  /**
   * Initially loads the project config, merging it with default config.
   *
   * @return void
   */
  private static function load(): void
  {
    self::$config = parse_ini_file(__DIR__. '/config_template.ini', true);

    if (is_file(__DIR__. '../config.ini')) {
      $user_config = parse_ini_file(__DIR__. '../config.ini', true);
      if ($user_config) {
        self::$config = array_merge(self::$config, $user_config);
      }
    }
  }

  /**
   * Retrieves a value from config
   *
   * @param $grouping
   * @param $key
   * @return false|mixed
   */
  public static function get($grouping, $key): mixed
  {
    if (!self::$config) self::load();

    return self::$config[$grouping][$key] ?? NULL;
  }
}

