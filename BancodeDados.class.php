<?php

class BancodeDados extends PDO {

        private $dsn = 'mysql:dbname=reciclaelixo;host=localhost';
        private $user =	'root';
        private $password =	'';
        private $handle;


	function __construct( ) {
		try	{
			$dbh = parent::__construct( $this->dsn , $this->user , $this->password,
                                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->handle = $dbh;
			return $this->handle;
		}
		catch ( PDOException $e ) {
			echo 'Connection failed: ' . $e->getMessage( );
			return false;
		}
	}

        function __destruct() {
            $this->handle = null;
        }
 
 }