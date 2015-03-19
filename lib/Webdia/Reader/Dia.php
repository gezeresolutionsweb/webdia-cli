<?php

// @todo Need to refactorized and return the right array values.

class Webdia_Reader_Dia extends Webdia_Reader implements Webdia_Reader_Interface {
    private $xml;

    public function __construct( \Zend\Console\GetOpt $getopt ) {
        parent::__construct( $getopt );
        $this->xml = $this->loadFile( $this->getopt->if );
    }

    public function loadFile( $filename ) {
        $this->xml = simplexml_load_file( $filename );
        $this->cleanXml();
    }

    public function cleanXml() {
        // Clean the XML file to avoid Namespace and tag prefix with SimpleXML.
        $this->xml = $this->xml->asXml();
        $this->xml = str_replace( 'dia:', '', $this->xml );
        $this->xml = str_replace( ' xmlns:dia="http://www.lysator.liu.se/~alla/dia/"', '', $this->xml );
    }

    public function getTables() {
        $this->xml = simplexml_load_string( $this->xml );
        $tables = $this->xml->xpath( '/diagram/layer/object[@type="UML - Class"]' );
        $arrTables = array();
        foreach( $tables as $table ) {
            $arrTables[ $this->getTableName( $table ) ] = $this->getTableFields( $table );
        }
        return $arrTables;
    }

    public function getViews() {
        die( 'Not implemented !' );
    }
    protected function getTableName( $table ) {
        $xml = @simplexml_load_string( $table->asXml() );
        $name = $xml->xpath( '/object/attribute[@name="name"]' );
        $name = $name[ 0 ];
        return str_replace( '#', '', $name->string );
    }

    public function getFields( $table ) {
        // Get all fields.
        $xml = @simplexml_load_string( $table->asXml() );
        $fields = $xml->xpath( '/object[@type="UML - Class"]/attribute[@name="attributes"]/*' );

        $arrFields = Array();

        foreach( $fields as $field ) {
            $xml = @simplexml_load_string( $field->asXml() );

            // Get field's name.
            $name = $xml->xpath( '/composite/attribute[@name="name"]' );
            $name = str_replace( '#', '', $name[ 0 ]->string );

            // Get field's type.
            $type = $xml->xpath( '/composite/attribute[@name="type"]' );
            $type = str_replace( '#', '', $type[0]->string );

            $arrFields[] = array(
                'name' => $name,
                'type' => $type
            );
        }

        return $arrFields;
    }
}
