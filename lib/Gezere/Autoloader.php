<?php

class Gezere_Autoloader 
{
    protected $paths = array();
    protected static $pathsSetted = false;

    public function addPath( $path ) {
        $this->paths[] = $path;
    }

    public function setPaths() {
        if( !empty( $this->paths ) ) {
            set_include_path(  implode( PS, $this->paths ) . PS . get_include_path() );
            $this->pathSetted = true;
        }
    }

    public function register() {
        spl_autoload_register( array( $this, 'autoload' ) );
    }

    public function autoload( $classname ) {
        if( false === self::$pathsSetted ) {
            $this->setPaths();
        }

        $classname = ltrim($classname, '\\');
        $filename  = '';
        $namespace = '';
        if ($lastNsPos = strripos($classname, '\\')) {
            $namespace = substr($classname, 0, $lastNsPos);
            $classname = substr($classname, $lastNsPos + 1);
            $filename  = str_replace('\\', DS, $namespace) . DS;
        }
        $filename .= str_replace('_', DS, $classname) . '.php';

        require $filename;
    }
}
