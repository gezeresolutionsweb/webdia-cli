<?php
/**
 * Gezere Framework
 *
 * Copyright (C) 2006-2012 Gezere Solutions Web
 *
 * PHP Version 5
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Gezere
 * @package   Gezere_Database
 * @author    Sylvain Lévesque <slevesque@gezere.com>
 * @copyright 2006-2012 Gezere Solutions Web (www.gezere.com)
 * @license   http://www.gnu.org/licenses/ GPLv3 license
 * @version   SVN: $Id: Database.php 119 2012-10-21 03:00:05Z slevesque $
 * @link      http://www.gezere.com/
 */

class Gezere_Database {
    private $dsn;
    private $selectedDb;
    private $link;

    public function __construct($dsn) {
        $this->dsn = self::parseDsn($dsn);
        $this->link = $this->connect($this->dsn['server'], $this->dsn['user'], $this->dsn['password']);
        $this->selectDb($this->dsn['database'], $this->link);
        $this->query('SET NAMES "UTF8"', $this->link);
    }

    public function getSelectedDb() {
        return $this->selectedDb;
    }

    private static function parseDsn( $dsn ) {	
        $arrayDsn = array();

        list(
            $arrayDsn[ 'engine' ],
            $arrayDsn[ 'user' ],
            $arrayDsn[ 'password' ],
            $arrayDsn[ 'server' ],
            $arrayDsn[ 'database' ]
        ) = preg_split(
            '~(.*)://(.*):(.*)@(.*)/(.*)~',
            $dsn,
            -1,
            PREG_SPLIT_DELIM_CAPTURE + PREG_SPLIT_NO_EMPTY
        );

        return $arrayDsn;
    }

    public function close( $link = '' ) {
        if($link != '') {
            return mysqli_close($link);
        } else {
            return mysqli_close();
        }
    }

    public function connect( $server = 'localhost', $user = '', $password = '', $newLink = false, $clientFlags = 0 ) {
        return mysqli_connect($server, $user, $password, $newLink, $clientFlags);
    }

    public function error( $link = '' ) {
        if($link != '') {
            return mysqli_error($link);
        } else {
            return mysqli_error();
        }
    }

    public function fetchArray( $result, $resultType = '' )
    {
        if( $resultType != '' ) {
            return mysqli_fetch_array($result, $resultType);
        } else {
            return mysqli_fetch_array($result);
        }
    }

    public function fetchObject( $result ) {
        return mysqli_fetch_object($result);
    }

    public function fetchRow( $result ) {
        return mysqli_fetch_row( $result );
    }

    public function insertId($link = '') {
        if($link != '') {
            return mysqli_insert_id($link);
        } else {
            return mysqli_insert_id();
        }
    }

    public function numRows($result) {
        return mysqli_num_rows($result);
    }

    public function query($query, $link = null) {  
        $alink = $this->link;
        if(!is_null($link)) {
            $alink = $link;
        }

        return mysqli_query($alink, $query);
    }

    public function selectDb($database, $link) {
        $this->selectedDb = $database;
        return mysqli_select_db($link, $database);
    }

    public function dataSeek( $result, $rowNumber ) {
        return mysqli_data_seek( $result, $rowNumber );
    }

    public function fetchAssoc( $result ) {
        return mysqli_fetch_assoc( $result );
    }

    public function numFields( $result ) {
        return mysqli_num_fields( $result );
    }

    public function fetchField( $result, $i ) {
        return mysqli_fetch_field( $result, $i );
    }

    public function queryAssoc( $query, $link = null) {
        $alink = $this->link;
        if(!is_null($link)) {
            $alink = $link;
        }

        $elements = mysqli_query($alink, $query);

        $results = array();
        while( $element = $this->fetchAssoc( $elements ) ) {
            array_push( $results, $element );
        }

        return $results;
    }

    public function queryOne( $query, $link = null) {
        $alink = $this->link;
        if(!is_null($link)) {
            $alink = $link;
        }

        $elements = mysqli_query($alink, $query);

        return $this->fetchAssoc( $elements );
    }

    public function queryObject($query, $link = null)
    {
        $alink = $this->link;
        if(!is_null($link)) {
            $alink = $link;
        }

        $elements = mysqli_query($alink, $query);

        $results = array();
        while( $element = $this->fetchObject( $elements ) )
        {
            array_push( $results, $element );
        }

        return $results;
    }

    public function queryPairs( $query, $link = null)
    {
        $alink = $this->link;
        if(!is_null($link)) {
            $alink = $link;
        }

        $elements = mysqli_query($alink, $query);

        $results = array();
        while( $element = $this->fetchArray( $elements ) ) {
            $results[ $element[ 0 ] ] = $element[ 1 ];
        }

        return $results;
    }

    public function fetchMeta($query, $link = null) {
        $alink = $this->link;
        if(!is_null($link)) {
            $alink = $link;
        }

        $results = mysqli_query($alink, $query);
        $fields = mysqli_fetch_assoc( $results );

        $items = array();
        foreach( $fields as $field => $value ) {
            $items[ $field ][ 'name' ] = $field;
            $items[ $field ][ 'value' ] = $value;
        }

        return $items;
    }

    public function realEscapeString($string, $link = null) {
        $alink = $this->link;
        if(!is_null($link)) {
            $alink = $link;
        }

        return mysqli_real_escape_string($alink, $string);
    }
}
