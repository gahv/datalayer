<?php

namespace CoffeeCode\DataLayer;

use PDO;
use PDOException;

/**
 * Class Connect
 * @package CoffeeCode\DataLayer
 */
class Connect
{
    /** @var PDO */
    private static $instance;

    /** @var PDOException */
    private static $error;

    /**
     * @return PDO
     */
    public static function getInstance(): ?PDO
    {
        if (empty(self::$instance)) {
            try {
                if (DATA_LAYER_CONFIG["driver"] == "sqlsrv") {
                    self::$instance = new PDO(
                        DATA_LAYER_CONFIG["driver"] . ":Server=" . DATA_LAYER_CONFIG["host"] . "," . DATA_LAYER_CONFIG["port"] . ";Database=" . DATA_LAYER_CONFIG["dbname"] . ";",
                        DATA_LAYER_CONFIG["username"],
                        DATA_LAYER_CONFIG["passwd"],
                        DATA_LAYER_CONFIG["options"]
                    );
                } else {
                    self::$instance = new PDO(
                        DATA_LAYER_CONFIG["driver"] . ":host=" . DATA_LAYER_CONFIG["host"] . ";dbname=" . DATA_LAYER_CONFIG["dbname"] . ";port=" . DATA_LAYER_CONFIG["port"],
                        DATA_LAYER_CONFIG["username"],
                        DATA_LAYER_CONFIG["passwd"],
                        DATA_LAYER_CONFIG["options"]
                    );
                }
            } catch (PDOException $exception) {
                self::$error = $exception;
            }
        }
        return self::$instance;
    }


    /**
     * @return PDOException|null
     */
    public static function getError(): ?PDOException
    {
        return self::$error;
    }

    /**
     * Connect constructor.
     */
    final private function __construct()
    {
    }

    /**
     * Connect clone.
     */
    final private function __clone()
    {
    }
}