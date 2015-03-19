<?php

abstract class Webdia_Writer {
    protected $getopt;
    protected $reader;

    public function __construct( \Zend\Console\Getopt $getopt, Webdia_Reader $reader ) { 
        $this->getopt = $getopt;
        $this->reader = $reader;
    }
}
