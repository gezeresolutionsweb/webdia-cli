<?php

class Webdia_Table
{
    public $name;
    public $fields;

    public function __construct( $params ) {
        $this->name = '';
        $this->fields = array();

        if( is_array( $params ) ) {
            if( isset( $params[ 'name' ] ) && !empty( $params[ 'name' ] ) ) {
                $this->name = $params[ 'name' ];
            }

            if( isset( $params[ 'fields' ] ) && !empty( $params[ 'fields' ] ) ) {
                $this->fields = $fields;
            }
        } else {
            $this->name = $params;
        }
    }

    public function addField( Webdia_Field $field ) {
        array_push( $this->fields, $field );
    }

    public function getName() {
        return $this->name;
    }
    public function getFields() {
        return $this->fields;
    }
}
