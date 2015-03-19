<?php

class Webdia_Reader_Mysql extends Webdia_Reader implements Webdia_Reader_Interface {
    private $db;

    public function __construct( \Zend\Console\GetOpt $getopt ) {
        parent::__construct( $getopt );
        $this->db = new Gezere_Database( $this->getopt->idsn ) or die( 'Can\'t get mysql connexion !' . PHP_EOL );
    }

    public function getTables() {
        $sql = 'SELECT `TABLE_NAME` as `name`';
        $sql .= ', `TABLE_COMMENT` as `comment`';
        $sql .= ' FROM `information_schema`.`TABLES`';
        $sql .= ' WHERE `TABLE_TYPE` = "BASE TABLE"';
        $sql .= ' AND `TABLE_SCHEMA` = "'. $this->db->getSelectedDb() . '";';

        return $this->db->queryAssoc( $sql );
    }

    public function getViews() {
        $sql = 'SELECT `TABLE_NAME` as `name`';
        $sql .= ', `TABLE_COMMENT` as `comment`';
        $sql .= ' FROM `information_schema`.`TABLES`';
        $sql .= ' WHERE `TABLE_TYPE` = "VIEW"';
        $sql .= ' AND `TABLE_SCHEMA` = "'. $this->db->getSelectedDb() . '";';

        return $this->db->queryAssoc( $sql );
    }

    public function getFields( $table ) {
        $sql = 'SELECT `COLUMN_NAME` AS "name"';
        $sql .= ', `COLUMN_TYPE` AS "type"';
        $sql .= ', `COLUMN_COMMENT` AS "comment"';
        $sql .= ', `IS_NULLABLE` AS "nullable"';
        $sql .= ', if( `COLUMN_KEY` = "PRI", 1, 0 ) as "primary_key"';
        $sql .= ', `COLUMN_DEFAULT` AS "default"';
        $sql .= ', `EXTRA` AS "extra"';
        $sql .= ', if( `COLUMN_KEY` = "UNI", 1, 0 ) AS "unique"';
        $sql .= ' FROM `information_schema`.`COLUMNS`';
        $sql .= ' WHERE `TABLE_SCHEMA` = "'. $this->db->getSelectedDb() . '"';
        $sql .= ' AND `TABLE_NAME` = "' . $this->db->realEscapeString( $table ) . '"';
        $sql .= ' ORDER BY `ORDINAL_POSITION`;';

        return $this->db->queryAssoc( $sql );
    }
}
