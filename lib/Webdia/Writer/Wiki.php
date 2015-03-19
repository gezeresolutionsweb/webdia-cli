<?php

class Webdia_Writer_Wiki extends Webdia_Writer implements Webdia_Writer_Interface {
    public function write() {
        $fp = fopen( $this->getopt->of, 'w' );

        fwrite( $fp, '====== Dictionnaire de données ======' . PHP_EOL . PHP_EOL );

        foreach( $this->reader->getTables() as $table ) {
            fwrite( $fp, '=====' . $table[ 'name' ] . '=====' . PHP_EOL . PHP_EOL );

            $isFirst = true;

            foreach( $table->getFields( $table[ 'name' ] ) as $field ) {
                fwrite( $fp, '**' . $field[ 'name' ] . '**' . PHP_EOL . PHP_EOL );
                fwrite( $fp, '^ Type | ' . $field[ 'type' ] . ' |' . PHP_EOL );

                if( true === $isFirst ) {
                    fwrite( $fp, '^ Clé primaire | Oui |' . PHP_EOL );
                } else {
                    fwrite( $fp, '^ Clé primaire | |' . PHP_EOL );
                }
                fwrite( $fp, '^ Valeur par défaut | ' . $field[ 'default' ] . ' |' . PHP_EOL );

                if( true === $isFirst ) {
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

