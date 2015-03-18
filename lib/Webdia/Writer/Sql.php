<?php

class Webdia_Writer_Sql implements Webdia_Writer_Interface
{
    private $getopt;

    public function __construct( \Zend\Console\Getopt $getopt ) { 
        $this->getopt = $getopt;
    }

    public function write( Webdia_Database $database ) {
        $fp = fopen( $this->getopt->of, 'w' );

        foreach( $database->getTables() as $table ) {
            fwrite( $fp, 'CREATE TABLE IF NOT EXISTS `' . $table->getName() . '` (' . PHP_EOL );

            $primarykey = '';
            $isFirst = true;

            foreach( $table->getFields() as $field ) {
                $isPrimaryKey = false;
                $isExternalKey = false;

                if( true === $isFirst ) {
                    $isFirst = false;
                    $primaryKey = $field->getName();
                    $isPrimaryKey = true;
                }

/*
                switch( $field[ 'visibility' ] ) {
                case 0:
                    $isExternalKey = true;
                    break;
                case 2:
                    $isPrimaryKey = true;
                    $primaryKey = $field[ 'name' ];
                    break;
                }
 */

                $fieldLine = '`' . $field->getName() . '` ';
                $fieldLine .= $field->getType();

                if( /*$isPrimaryKey || $isExternalKey || */ $field->getType() === 'int(10)' ) {
                    $fieldLine .= ' unsigned ';
                }
                /*
                if( $field[ 'value' ] !== '' ) {
                    $fieldLine .= ' NOT NULL DEFAULT \'' . $field[ 'value' ] . '\'';
                } else {
                    $fieldLine .= ' NOT NULL';
                }
                 */
                if( $isPrimaryKey ) {
                    $fieldLine .= ' auto_increment';
                }
                /*
                if( !empty( $field->comment ) ) {
                    $fieldLine .= ' COMMENT \'' . mysql_real_escape_string( $field['comment'] ) . '\'';
                }
                 */
                $fieldLine .= ',';
                $fieldLine .= PHP_EOL;

                fwrite( $fp, '    ' . $fieldLine );
            }

            fwrite( $fp, '    ' . 'PRIMARY KEY  (`' . $primaryKey . '`)' . PHP_EOL );

            fwrite( $fp, ') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=0;' . PHP_EOL . PHP_EOL );
        }

        fclose( $fp );
    }
}
