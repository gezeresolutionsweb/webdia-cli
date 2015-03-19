<?php

interface Webdia_Reader_Interface {

    /**
     * Must return an array with thoses keys.
     * $tables = array(
     *   'name' => 'Table name',
     *   'comment' => 'Table comments',
     * );
     */
    public function getTables();

    /**
     * Must return an array with thoses keys.
     * $views = array(
     *   'name' => 'View name',
     *   'comment' => 'View comments',
     * );
     */
    public function getViews();

    /**
     * Must return an array with thoses keys.
     *
     * $fields = array(
     *      'id' => array(
     *          'name' => 'id', // Column name
     *          'type' => 'int(10) unsigned', // Field type
     *          'comment' => 'This is the field comment', // Comment name
     *          'nullable' => true, // If the field can be null.
     *          'primary_key' => true, // If the field is primary key
     *          'default' => '0', // Default value
     *          'extra' => 'auto-increment', // If field is auto increment.
     *          'unique' => true, // If field is a unique key.
     *      ),
     *      'title' => array(
     *          'name' => 'title', // Column name
     *          'type' => 'varchar(255)', // Field type
     *          'comment' => 'This is the field comment', // Comment name
     *          'nullable' => true, // If the field can be null.
     *          'primary_key' => true, // If the field is primary key
     *          'default' => '0', // Default value
     *          'extra' => 'auto-increment', // If field is auto increment.
     *          'unique' => true, // If field is a unique key.
     *      )
     * );
     */
    public function getFields( $table );
}
