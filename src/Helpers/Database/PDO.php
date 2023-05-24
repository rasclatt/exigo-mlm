<?php
namespace Exigo\Helpers\Database;

class PDO extends \Exigo\Helpers\Database
{
    protected static $con;
    protected string $sql;
    protected ?array $bind = null;
    /**
     *	@description	
     *	@param	
     */
    public function __construct($connection = null)
    {
        if(!(self::$con instanceof \PDO)) {
            try {
                self::$con = new \PDO("sqlsrv:Server=" . EXIGO_DB_HOST . ";Database=" . EXIGO_DB_NAME, EXIGO_DB_USER, EXIGO_DB_PASS);
                self::$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$con->setAttribute(\PDO::SQLSRV_ATTR_ENCODING, \PDO::SQLSRV_ENCODING_UTF8);
            } catch (\PDOException $e) {
                throw new \Exception('Connection error: ' . $e->getMessage(), (int) $e->getCode());
            }
        }
    }
    /**
     *	@description	
     */
    public function query(string $sql, array $bind = null): self
    {
        $this->sql = $sql;
        $this->bind = $bind;
        return $this;
    }
    /**
     *	@description	
     */
    public function getResults(bool $returnSingle = false): array
    {
        $query = self::$con->prepare($this->sql);
        $query->execute($this->bind);
        $data = [];
        
        if(!$query) {
            throw new \Exception('Invalid connection response', 500);
            return $data;
        }
        
        while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = array_map(
                function($v) {
                    if($v === null)
                        return $v;
                    $enc = mb_detect_encoding($v);
                    return (empty($enc))? null : mb_convert_encoding($v, 'UTF-8', $enc);
                },
                $row
            );
        }
        return !$returnSingle? $data : ($data[0]?? $data);
    }
}