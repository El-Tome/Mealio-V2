<?php
require_once __DIR__ . '/config.php';
/**
 * Class database
 *
 * @const DB_HOST
 * @const DB_NAME
 * @const DB_USER
 * @const DB_PASSWORD
 *
 * This class is used to manage the database connection and the SQL requests
 */
class database
{
    protected static ?database $instance = null;
    public $pdo;
    
    public function __construct()
    {
        $this->connect();
    }
    
    /**
     * @return Database
     *
     * function to create new instance of Database if it does not exist
     */
    public static function getInstance():Database
    {
        if (!self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * @return void
     *
     * function for connect to database
     */
    private function connect():void
    {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die("Erreur lors de la connection à la base de données . ". $e->getMessage());
        }
    }
    
    /**
     * @param string $request
     * @param array $parameters
     * @param string $pdoOptions
     * @return array
     *
     * function to select SQL request
     */
    public function select(
        string $request,
        array $parameters = [],
        string $pdoOptions = PDO::FETCH_ASSOC
    ):array
    {
        try
        {
            $query = $this->pdo->prepare($request);
            $query->execute($parameters);
            return $query->fetchAll($pdoOptions);
        } catch (PDOException $e) {
            die("La requête SQL a échoué : ". $e->getMessage());
        }
    }
    
    /**
     * @param string $request
     * @param array $parameters
     * @return void
     *
     * function to insert, update or delete SQL request
     */
    public function modifyData(
        string $request,
        array $parameters = []
    ):void
    {
        try
        {
            $query = $this->pdo->prepare($request);
            $query->execute($parameters);
        } catch (PDOException $e) {
            die("La requête SQL a échoué : ". $e->getMessage());
        }
    }
    
    /**
     * @return int
     *
     * function to get last insert id
     */
    public function lastInsertId():int
    {
        return $this->pdo->lastInsertId();
    }
}