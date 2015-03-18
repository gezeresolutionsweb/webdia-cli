<?php

class Webdia_Reader_Mssql implements Webdia_Reader_Interface
{
    private $getopt;
    private $database;

    public function __construct( \Zend\Console\GetOpt $getopt ) {
        $this->getopt = $getopt;
        $this->database = new Webdia_Database( 'default' );
    }

    public function validateOptions() {
        // @todo Verify that required options are there.
         /*
            if( !isset( $options[ 't' ] ) ) {
                $oTables = array();
            } else {
                $oTables = explode( ',', $options[ 't' ] );
            }
          */
    }


    public function read() {
        $dsn = Database::parseDsn( $this->getopt->idsn );
        $dsnString = 'dblib:dbname=' . $dsn[ 'database' ] . ';host=' . $dsn[ 'server' ];

        try {
            $pdo = new PDO( $dsnString, $dsn[ 'user' ], $dsn[ 'password' ] );

            $sql = 'SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = "BASE TABLE"';

            $tables = $pdo->query( $sql, PDO::FETCH_ASSOC );

            $arrTableNames = array();

            foreach( $tables as $table ) {
                array_push( $arrTableNames, $table[ 'TABLE_NAME' ] );
            }
        } catch( Exception $e ) {
            echo $e->getMessage();
            echo $e->getCode();
            exit();
        }

        foreach( $arrTableNames as $table ) {
            if( isset( $oTables ) && !empty( $oTables) && !in_array( $table, $oTables ) ) {
                continue;
            }

            $objTable = new Webdia_Table( $table );

            $sql = 'SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME="' . $table . '" ORDER BY ORDINAL_POSITION';

            $fields = $pdo->query( $sql, PDO::FETCH_ASSOC );

            foreach( $fields as $field ) {
                $objTable->addField( array(
                    'name' => $field[ 'COLUMN_NAME' ],
                    'type' => $field[ 'DATA_TYPE' ],
                    'default' => $field[ 'COLUMN_DEFAULT' ]
                ) );
            }

            $this->database->addTable( $objTable );
        }

        return $this->database;
    }
}
