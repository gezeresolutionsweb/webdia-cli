<?php

class Webdia_Writer_Wiki implements Webdia_Writer_Interface
{
    private $getopt;

    public function __construct( \Zend\Console\Getopt $getopt ) { 
        $this->getopt = $getopt;
    }

    public function write( Webdia_Database $database ) {
        $fp = fopen( $this->getopt->of, 'w' );

        fwrite( $fp, '====== Dictionnaire de données ======' . PHP_EOL . PHP_EOL );

        foreach( $database->getTables() as $table ) {
            fwrite( $fp, '=====' . $table->getName() . '=====' . PHP_EOL . PHP_EOL );
            //        fwrite( $fp, $table->comment . PHP_EOL . PHP_EOL );

            $isFirst = true;

            foreach( $table->getFields() as $field ) {
                fwrite( $fp, '**' . $field->getName() . '**' . PHP_EOL . PHP_EOL );
                //                fwrite( $fp, $field[ 'comment' ] . PHP_EOL . PHP_EOL );
                fwrite( $fp, '^ Type | ' . $field->getType() . ' |' . PHP_EOL );

                if( /*$field[ 'visibility' ] == 2*/ true === $isFirst ) {
                    fwrite( $fp, '^ Clé primaire | Oui |' . PHP_EOL );
                } else {
                    fwrite( $fp, '^ Clé primaire | |' . PHP_EOL );
                }
                /*
                if( $field[ 'visibility' ] == 0 ) {
                    fwrite( $fp, '^ Clé externe | Oui |' . PHP_EOL );
                } else {
                    fwrite( $fp, '^ Clé externe | |' . PHP_EOL );
                }
                 */
                //                fwrite( $fp, '^ Valeur nulle | |' . PHP_EOL );
                fwrite( $fp, '^ Valeur par défaut | ' . $field->getDefault() . ' |' . PHP_EOL );

                if( /*field[ 'visibility' ] == 2*/ true === $isFirst ) {
                    fwrite( $fp, '^ Auto-incrément | Oui |' . PHP_EOL . PHP_EOL );
                } else {
                    fwrite( $fp, '^ Auto-incrément | |' . PHP_EOL . PHP_EOL );
                }

                if( true === $isFirst ) {
                    $isFirst = false;
                }
            }
        }

        fclose( $fp );
    }
}

