<?php

class Webdia_Writer_Sql extends Webdia_Writer implements Webdia_Writer_Interface {
    public function write() {
        $fp = fopen( $this->getopt->of, 'w' );

        foreach( $this->reader->getTables() as $table ) {
            fwrite( $fp, 'CREATE TABLE IF NOT EXISTS `' . $table[ 'name' ] . '` (' . PHP_EOL );

            $primarykey = '';
            $isFirst = true;

            foreach( $this->reader->getFields( $table[ 'name' ] ) as $field ) {
                $isPrimaryKey = false;
                $isExternalKey = false;

                if( true === $isFirst ) {
                    $isFirst = false;
                    $primaryKey = $field[ 'name' ];
                    $isPrimaryKey = true;
                }

                $fieldLine = '`' . $field[ 'name' ] . '` ';
                $fieldLine .= $field[ 'type' ];

                if( $field[ 'type' ] === 'int(10)' ) {
                    $fieldLine .= ' unsigned ';
                }
                if( $isPrimaryKey ) {
                    $fieldLine .= ' auto_increment';
                }
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
