<?php
namespace YesWiki;

use \Exception;

class Database
{
    private $dblink;
    public $prefix;

    // TODO Utiliser un objet configuration quand il sera créé.
    public function __construct($host, $user, $password, $database, $prefix)
    {
        $this->dblink = @mysqli_connect($host, $user, $password);
        $this->prefix = $prefix;

        if ($this->dblink) {
            if (! @mysqli_select_db($this->dblink, $database)) {
                @mysqli_close($this->dblink);
                $this->dblink = false;
            }
            // necessaire pour les versions de mysql qui sont en utf8 par defaut
            mysqli_set_charset($this->dblink, "latin1");
        }
    }

    public function query($query)
    {
        if (! $result = mysqli_query($this->dblink, $query)) {
            ob_end_clean();
            throw new Exception(
                "Query failed: $query (" . mysqli_error($this->dblink) . ')',
                1
            );
        }

        return $result;
    }

    public function loadSingle($query)
    {
        if ($data = $this->loadAll($query)) {
            return $data[0];
        }

        return null;
    }

    public function loadAll($query)
    {
        $data = array();
        if ($results = $this->query($query)) {
            while ($row = mysqli_fetch_assoc($results)) {
                $data[] = $row;
            }
            mysqli_free_result($results);
        }
        return $data;
    }

    public function escapeString($string)
    {
        return mysqli_real_escape_string($this->dblink, $string);
    }
}