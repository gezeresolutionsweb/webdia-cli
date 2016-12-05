<?php

class Webdia_App {
    protected $version = '0.2.0 (Tremblay)';
    protected $copyright = 'Copyright © 2010-2016 Sylvain Lévesque';
    protected $argv;
    protected $getopt;

    // Getopt options
    protected $options = array(
        'i=w' => 'Input format',
        'o=w' => 'Output format',
        't=s' => 'Tables limitation',
        's=s' => 'Yaml settings file',
        'help|h' => 'Help',
        'version|v' => 'Version',
        'if=s' => 'Input filename',
        'of=s' => 'Output filename',
        'idsn=s' => 'Input DSN',
        'odsn=s' => 'Output DSN'
    );

    // Input format list
    const INPUT_SQL = 'sql';
    const INPUT_DIA = 'dia';
    const INPUT_WIKI = 'wiki';
    const INPUT_MYSQL = 'mysql';
    const INPUT_MSSQL = 'mssql';

    // output format list
    const OUTPUT_SQL = 'sql';
    const OUTPUT_DIA = 'dia';
    const OUTPUT_WIKI = 'wiki';
    const OUTPUT_MYSQL = 'mysql';
    const OUTPUT_REFERENCES = 'references';

    // Member variable to hold CLI color class instance.
    protected $c;

    public function __construct( $argv ) {
        $this->argv = $argv;
    }

    public function run() {
        $this->c = new Gezere_Cli_Colors();
        $this->getopt = new \Zend\Console\Getopt( $this->options, $this->argv );

        if( $this->isShowHelp() || 1 === count( $this->argv ) ) {
            $this->showHelp();
            return;
        }

        if( $this->isShowVersion() ) {
            $this->showVersion();
            return;
        }

        // Input format
        if( !isset( $this->getopt->i ) ) {
            $inputFormat = self::INPUT_SQL;
        } else {
            $inputFormat = $this->getopt->i;
        }

        // Output format
        if( !isset( $this->getopt->o ) ) {
            $outputFormat = self::OUTPUT_DIA;
        } else {
            $outputFormat = $this->getopt->o;
        }

        // Output format
        $settings = null;
        if( isset( $this->getopt->s ) && is_file($this->getopt->s) ) {
            try {
                $settings = Spyc::YAMLLoad($this->getopt->s);
            } catch(Exception $e) {
                $this->echoc('Yaml error: ' . $e->getMessage() . PHP_EOL, 'light_red');
                die();
            }
        }

        // Determine adequate reader
        $classname = 'Webdia_Reader_' . ucfirst( $inputFormat );
        $reader = new $classname( $this->getopt );

        // Determine adequate writer
        $classname = 'Webdia_Writer_' . ucfirst( $outputFormat );
        $writer = new $classname($this->getopt, $reader, $settings);
        $writer->write();
    }

    private function echoc( $string, $fgcolor = null, $bgcolor = null ) {
        echo $this->c->getColoredString( $string, $fgcolor, $bgcolor );
    }

    private function isShowHelp() {
        if( isset( $this->getopt->help ) || isset( $this->getopt->h ) ) {
            return true;
        }

        return false;
    }

    private function isShowVersion() {
        if( isset( $this->getopt->version ) || isset( $this->getopt->v ) ) {
            return true;
        }

        return false;
    }

    private function showHelp() {
        $this->showHeader();
        $this->echoc( 'USAGE' . PHP_EOL, 'white' );
        $this->echoc( 'webdia', 'yellow' );
        $this->echoc( ' [-i INPUT_FORMAT] [-o OUTPUT_FORMAT] [--if INPUT_FILENAME] [--of OUTPUT_FILENAME] [--isdn INPUT_DSN] [--odsn OUTPUT_DSN] [-h] [-v] [--help] [--version]' . PHP_EOL . PHP_EOL, 'light_gray' );
        $this->echoc( 'VALUES' . PHP_EOL, 'white' );
        $this->echoc( 'INPUT_FORMAT     Input format. Default: sql' . PHP_EOL, 'light_gray' );
        $this->echoc( 'OUTPUT_FORMAT    Input format. Default: dia' . PHP_EOL, 'light_gray' );
        $this->echoc( 'INPUT_FILENAME   Input filename. Default: input.sql' . PHP_EOL, 'light_gray' );
        $this->echoc( 'OUTPUT_FILENAME  Output filename. Default: output.dia' . PHP_EOL, 'light_gray' );
        $this->echoc( 'INPUT_DSN        Input DSN. Format: engine://user:password@host/database' . PHP_EOL, 'light_gray' );
        $this->echoc( 'OUTPUT_DSN       Output DSN. Format: engine://user:password@host/database' . PHP_EOL . PHP_EOL, 'light_gray' );
        $this->echoc( 'PARAMETERS' . PHP_EOL, 'white' );
        $this->echoc( '-i               Input format. Default: sql' . PHP_EOL, 'light_gray' );
        $this->echoc( '-o               Output format. Default: dia' . PHP_EOL, 'light_gray' );
//        $this->echoc( '-t               Output DSN.' . PHP_EOL, 'light_gray' );
        $this->echoc( '-h               Show help.' . PHP_EOL, 'light_gray' );
        $this->echoc( '-v               Show version.' . PHP_EOL, 'light_gray' );
        $this->echoc( '--if             Input filename. Default: input.sql' . PHP_EOL, 'light_gray' );
        $this->echoc( '--of             Output filename. Default: output.dia.' . PHP_EOL, 'light_gray' );
        $this->echoc( '--idsn           Input DSN.' . PHP_EOL, 'light_gray' );
        $this->echoc( '--odsn           Output DSN.' . PHP_EOL, 'light_gray' );
        $this->echoc( '--help           Show help.' . PHP_EOL, 'light_gray' );
        $this->echoc( '--version        Show version.' . PHP_EOL . PHP_EOL, 'light_gray' );
        $this->echoc( 'INPUT FORMAT LIST' . PHP_EOL, 'white' );
//        $this->echoc( 'sql              SQL file. This is the default input format.' . PHP_EOL, 'light_gray' );
        $this->echoc( 'dia              DIA file. ' . PHP_EOL, 'light_gray' );
//        $this->echoc( 'wiki             Dokuwiki formated text file. ' . PHP_EOL, 'light_gray' );
        $this->echoc( 'mysql            Mysql database. ' . PHP_EOL, 'light_gray' );
        $this->echoc( 'mssql            MSSQL database. ' . PHP_EOL . PHP_EOL, 'light_gray' );
        $this->echoc( 'OUTPUT FORMAT LIST' . PHP_EOL, 'white' );
        $this->echoc( 'sql              SQL file. ' . PHP_EOL, 'light_gray' );
        $this->echoc( 'dia              DIA file. This is the default output format.' . PHP_EOL, 'light_gray' );
        $this->echoc( 'wiki             Dokuwiki formated text file. ' . PHP_EOL, 'light_gray' );
//        $this->echoc( 'mysql            Mysql database. ' . PHP_EOL . PHP_EOL, 'light_gray' );
        $this->echoc( 'settings         Yaml settings files. ' . PHP_EOL, 'light_gray' );
    }

    private function showHeader() {
        $this->echoc( 'Webdia ' . $this->version . PHP_EOL, 'yellow' );
        echo $this->copyright . PHP_EOL . PHP_EOL;
    }

    private function showVersion() {
        $this->showHeader();

        $this->echoc( 'DESCRIPTION' . PHP_EOL, 'white' );
        $this->echoc( 'Webdia is a web based diagram modeling tool that comes with a bunch of command line tools.' . PHP_EOL, 'light_gray' );
        $this->echoc( 'It can convert Dia (UML) to MySql or to DokuWiki syntax. It can also create a Dia (UML) file' . PHP_EOL, 'light_gray' );
        $this->echoc( 'from a database. MySQL and MSSQL are the only supported database for now. Each tables are' . PHP_EOL, 'light_gray' );
        $this->echoc( 'represented as UML class and each fields are represented as UML class attributes.' . PHP_EOL . PHP_EOL, 'light_gray' );
        
        $this->echoc( 'CONTACT US' . PHP_EOL, 'white' );
        $this->echoc( 'Author: ', 'light_gray' );
        $this->echoc( 'Sylvain Lévesque <slevesque@gezere.com>.' . PHP_EOL, 'light_red' );
        $this->echoc( 'Website: ' . PHP_EOL . PHP_EOL, 'lignt_gray' );
        //$this->echoc( 'http://webdia.gezere.com' . PHP_EOL . PHP_EOL, 'light_red' );

        $this->echoc( 'LICENSE' . PHP_EOL, 'white' );
        $this->echoc( 'This program is free software: you can redistribute it and/or modify' . PHP_EOL, 'light_gray' );
        $this->echoc( 'it under the terms of the GNU General Public License as published by' . PHP_EOL, 'light_gray' );
        $this->echoc( 'the Free Software Foundation, either version 3 of the License, or' . PHP_EOL, 'light_gray' );
        $this->echoc( '(at your option) any later version.' . PHP_EOL . PHP_EOL, 'light_gray' );

        $this->echoc( 'This program is distributed in the hope that it will be useful,' . PHP_EOL, 'light_gray' );
        $this->echoc( 'but WITHOUT ANY WARRANTY; without even the implied warranty of' . PHP_EOL, 'light_gray' );
        $this->echoc( 'MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the' . PHP_EOL, 'light_gray' );
        $this->echoc( 'GNU General Public License for more details.' . PHP_EOL . PHP_EOL, 'light_gray' );

        $this->echoc( 'You should have received a copy of the GNU General Public License' . PHP_EOL, 'light_gray' );
        $this->echoc( 'along with this program.  If not, see <http://www.gnu.org/licenses/>.' . PHP_EOL . PHP_EOL, 'light_gray' );

    }
}
