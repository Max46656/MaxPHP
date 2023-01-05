<?
require_once "config.php";

// require_once "config.php";
// $config = new config;
// $connDB = new connDB($config);
// echo var_export($connDB->ConnDB());
class connDB extends config
{
    // private static $dbName;
    // private static $dbms;
    // private static $host;
    // private static $user;
    // private static $pass;
    // public function __construct(config $config)
    // {
    //     config::$dbName = $config->dbName;
    //     config::$dbms = $config->dbms;
    //     config::$host = $config->host;
    //     config::$user = $config->user;
    //     config::$pass = $config->pass;
    // }

    public function ConnDB()
    {
        $dsn = config::$dbms . ":host=" . config::$host . ";dbname=" . config::$dbName;
        try {
            $conn = new PDO($dsn, config::$user, config::$pass);
        } catch (PDOException $e) {
            die("ヽ(´;ω;`)ﾉ!: " . $e->getMessage() . "<br/>");
        }
        return $conn;
    }

    public function tblName()
    {
        $conn = $this->ConnDB();
        $Sql = "SHOW TABLES FROM`" . config::$dbName . "`";
        $DBMeta = $conn->prepare($Sql);
        $DBMeta->execute();
        foreach ($DBMeta as $key => $tableMeta) {
            $tblName[] = $tableMeta["Tables_in_" . config::$dbName];
        }
        $DBMeta = null;
        $conn = null;
        return $tblName;
    }
    public function fieldMeta()
    {
        if (!isset($_GET['DBSelect'])) {
            exit;
        }
        $conn = $this->ConnDB();
        $Sql = "SHOW COLUMNS FROM" . "`{$_GET['DBSelect']}`" . "FROM`" . config::$dbName . "`";
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
    public function fieldDetail()
    {
        $conn = $this->ConnDB();
        $Sql = "SHOW COLUMNS FROM" . "`{$_GET['DBSelect']}`" . "FROM`" . config::$dbName . "`";
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
