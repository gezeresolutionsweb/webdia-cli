<?php

class Webdia_Field
{
    private $name = '';
    private $type = '';
    private $isPrimary = false;
    private $default = '';

    public function __construct( $params ) {
        $this->name = '';
        $this->type = '';
        $this->isPrimary = false;
        $this->default = '';


        if( is_array( $params ) ) {
            if( isset( $params[ 'name' ] ) && !empty( $params[ 'name' ] ) ) {
                $this->name = $params[ 'name' ];
            }

            if( isset( $params[ 'type' ] ) && !empty( $params[ 'type' ] ) ) {
                $this->type = $params[ 'type' ];
            }

            if( isset( $params[ 'isPrimary' ] ) && !empty( $params[ 'isPrimary' ] ) ) {
                $this->isPrimary = $params[ 'isPrimary' ];
            }

            if( isset( $params[ 'default' ] ) && !empty( $params[ 'default' ] ) ) {
                $this->default = $params[ 'default' ];
            }
        } else {
            $this->name = $params;
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function getIsPrimary() {
        return $this->isPrimary;
    }

    public function getDefault() {
        return $this->default;
    }
}
