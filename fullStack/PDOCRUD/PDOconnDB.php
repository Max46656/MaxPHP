<?
class connDB
{
    public static $dbName = 'test';
    public static $dbms = 'mysql';
    public static $host = 'localhost';
    public static $user = 'Max';
    public static $pass = 'SAYWHAT';

    public static function ConnDB()
    {
        $dsn = self::$dbms . ":host=" . self::$host . ";dbname=" . self::$dbName;
        try {
            $conn = new PDO($dsn, connDB::$user, self::$pass);
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage() . "<br/>");
        }
        return $conn;
    }

    public function tblName()
    {
        $conn = $this->ConnDB();
        $Sql = "SHOW TABLES FROM`" . self::$dbName . "`";
        $DBMeta = $conn->prepare($Sql);
        $DBMeta->execute();
        foreach ($DBMeta as $key => $tableMeta) {
            $tblName[] = $tableMeta["Tables_in_" . self::$dbName];
        }
        $DBMeta = null;
        $conn = null;
        return $tblName;
    }
    public function fieldMeta()
    {
        $conn = $this->ConnDB();
        $Sql = "SHOW  COLUMNS FROM" . "`{$_GET['DBSelect']}`" . "FROM`" . self::$dbName . "`";
        $tableMeta = $conn->prepare($Sql);
        $tableMeta->execute();
        foreach ($tableMeta as $key => $colMeta) {
            $fieldName[] = $colMeta['Field'];
        }
        $tableMeta = null;
        $typeSql = "SELECT `field`,`type` FROM `data_rows`";
        $sqlToHtml = $conn->prepare($typeSql);
        $sqlToHtml->execute();
        foreach ($sqlToHtml as $key => $colMeta) {
            $allFieldName[] = $colMeta["field"];
            $allFieldType[] = $colMeta["type"];
        }
        foreach ($fieldName as $key => $Name) {
            $sqlToHtml = array_search($Name, $allFieldName);
            $fieldType[] = $allFieldType[$sqlToHtml];
        }
        $sqlToHtml = null;
        $conn = null;
        $field = array_combine($fieldName, $fieldType);
        return $field;
    }
}