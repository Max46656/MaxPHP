<?
require_once "config.php";

// require_once "config.php";
// $config = new config;
// $connDB = new connDB($config);
// echo var_export($connDB->ConnDB());
final class connDB
{
    protected static $dbName;
    protected static $dbms;
    protected static $host;
    protected static $user;
    protected static $pass;

    public function __construct()
    {
        $config = new config;
        self::$dbName = $config::$dbName;
        self::$dbms = $config::$dbms;
        self::$host = $config::$host;
        self::$user = $config::$user;
        self::$pass = $config::$pass;
        $config = null;
    }

    final public function ConnDB()
    {
        try {
            $dsn = self::$dbms . ":host=" . self::$host . ";dbname=" . self::$dbName;
            $user = self::$user;
            $pass = self::$pass;
            $conn = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die("<span class=errorMessage>" . "ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "</span><br/>");
        }
        return $conn;
    }

    final public function tblName()
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
    final public function fieldMeta()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $conn = $this->ConnDB();
        $Sql = "SHOW COLUMNS FROM" . "`{$_GET['DBSelect']}`" . "FROM`" . self::$dbName . "`";
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
    final public function fieldDetail()
    {
        $conn = $this->ConnDB();
        $Sql = "SHOW COLUMNS FROM" . "`{$_GET['DBSelect']}`" . "FROM`" . self::$dbName . "`";
        $tableMeta = $conn->prepare($Sql);
        $tableMeta->execute();
        foreach ($tableMeta as $key => $colMeta) {
            $fieldName[] = $colMeta['Field'];
        }
        $tableMeta = null;
        $typeSql = "SELECT `field`,`required`,`display_name` FROM `data_rows`";
        $sqlToHtml = $conn->prepare($typeSql);
        $sqlToHtml->execute();
    }
}