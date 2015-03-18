<?php

class Webdia_Reader_Mysql implements Webdia_Reader_Interface
{
    private $getopt;
    private $database;
    private $xml;

    public function __construct( \Zend\Console\GetOpt $getopt ) {
        $this->getopt = $getopt;
        $this->database = new Webdia_Database( 'default' );
    }

    public function validateOptions() {
        // @todo Verify that required options are there.
    }

    public function read() {
        // Parse DSN
        $dsn = Webdia_Database::parseDsn( $this->getopt->idsn );
        var_dump( $dsn );
        die();

        // Get connexion
        $link = mysql_connect( $dsn[ 'server' ], $dsn[ 'user' ], $dsn[ 'password' ] ) or die( 'Can\'t get mysql connexion !' . PHP_EOL );
        var_dump( $dsn );
        die( 'end' );

        // Select database
        $ret = mysql_select_db( $dsn[ 'database' ], $link ) or die( 'Can\'t select database !' . PHP_EOL );

        // Get tables
        $sql = 'SHOW TABLES';
        $tables = mysql_query( $sql, $link );

        $arrTables = array();

        while( $table = mysql_fetch_array( $tables ) ) {
            $objTable = new Webdia_Table( $table[ 0 ] );

            // Get table's fields.
            $sql = 'SHOW COLUMNS FROM `' . $dsn[ 'database' ] . '`' . '.`' . $table[ 0 ] . '`';

            $fields = mysql_query( $sql ) or die( mysql_error());

            while( $field = mysql_fetch_array( $fields ) ) {
                $objTable->addField( new Webdia_Field( array(
                    'name' => $field[ 'Field' ],
                    'type' => $field[ 'Type' ],
                    'default' => $field[ 'Default' ]
                ) ) );
            }

            // Added to database
            $this->database->addTable( $objTable );
        }

        return $this->database;
    }
}
