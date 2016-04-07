<?php

abstract class Webdia_Writer {
    protected $getopt;
    protected $reader;
    protected $settings = [];

    public function __construct( \Zend\Console\Getopt $getopt, Webdia_Reader $reader, $settings = null) { 
        $this->getopt = $getopt;
        $this->reader = $reader;
        if(!is_null($settings)) {
            $this->settings = $settings;
        }
    }
}
