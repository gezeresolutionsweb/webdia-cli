<?php

abstract class Webdia_Reader {
    protected $getopt;

    public function __construct( \Zend\Console\GetOpt $getopt ) {
        $this->getopt = $getopt;
    }
}
