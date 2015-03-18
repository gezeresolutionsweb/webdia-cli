<?php

class Webdia_Database
{
    private $name = '';
    public $tables = array();

    public function __construct( $params ) {
        $this->name = '';
        $this->tables = array();

        if( is_array( $params ) ) {
            if( isset( $params[ 'name' ] ) && !empty( $params[ 'name' ] ) ) {
                $this->name = $params[ 'name' ];
            }

            if( isset( $params[ 'tables' ] ) && !empty( $params[ 'tables' ] ) ) {
                $this->tables = $params[ 'tables' ];
            }
        } else {
            $this->name = $params;
        }
    }

    public function addTable( Webdia_Table $table ) {
        array_push( $this->tables, $table );
    }

    public function getName() {
        return $this->name;
    }

    public function getTables() {
        return $this->tables;
    }
}
