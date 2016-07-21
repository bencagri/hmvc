<?php
namespace System\Core;
use System\Core;
use System\Config\Config;
use System\Database\Drivers\Txtdb_driver;
/**
 * Class Model
 *
 */
class Model extends Core {

    public $driver;

    public $hostname;

    public $username;

    public $password;

    public $database;

    public $port;

    public $encrypt;

    public $db;

    /**
     * Constructor.  Accepts one parameter containing the database
     * connection settings.
     *
     * @param array
     */

    public function __construct($options=array())
    {
        parent::__construct();

        //get database config
        $config = new Config('database');
        $db_conf = $config::get();
        $db_conf = array_merge($db_conf,$options);


        foreach ($db_conf as $key => $item) {
            $this->$key = $item;
        }

        //get database default group
        $db_group = $db_conf['default_group'];

        $driver_path = ROOT_DIR."system/database/drivers/{$this->driver}/{$this->driver}_driver.php";

        //check if driver exist
        if(file_exists($driver_path)){
            $driver_name   = ucfirst($this->driver);
            $namespace     = "System\\Database\\Drivers\\{$driver_name}\\{$driver_name}_driver";
            $this->db      = new $namespace($db_conf[$db_group]);

        }else{
            Debug::error_message("Driver {$this->driver} could not be found.");
        }


    }


}
?>
