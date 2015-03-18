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

class Gezere_Database
{
    public function __construct( $dsn ) {
        $dsn = self::parseDsn( $dsn );
        $this->connect( $dsn[ 'server' ], $dsn[ 'user' ], $dsn[ 'password' ] );
        $this->selectDb( $dsn[ 'database' ] );
        $this->query( 'SET NAMES "UTF8"' );
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
            return mysql_close($link);
        } else {
            return mysql_close();
        }
    }

    public function connect( $server = 'localhost', $user = '', $password = '', $newLink = false, $clientFlags = 0 ) {
        return mysql_connect($server, $user, $password, $newLink, $clientFlags);
    }

    public function error( $link = '' ) {
        if($link != '') {
            return mysql_error($link);
        } else {
            return mysql_error();
        }
    }

    public function fetchArray( $result, $resultType = '' )
    {
        if( $resultType != '' ) {
            return mysql_fetch_array($result, $resultType);
        } else {
            return mysql_fetch_array($result);
        }
    }

    public function fetchObject( $result ) {
        return mysql_fetch_object($result);
    }

    public function fetchRow( $result ) {
        return mysql_fetch_row( $result );
    }

    public function insertId($link = '') {
        if($link != '') {
            return mysql_insert_id($link);
        } else {
            return mysql_insert_id();
        }
    }

    public function numRows($result) {
        return mysql_num_rows($result);
    }

    public function query($query, $link = '') {  
        if( $link != '' ) {
            return mysql_query($query, $link);
        } else {
            return mysql_query($query);
        }
    }

    public function selectDb( $database, $link = '' )
    {
        if( $link != '' ) {
            return mysql_select_db($database, $link);
        } else {
            return mysql_select_db($database);
        }
    }

    public function dataSeek( $result, $rowNumber ) {
        return mysql_data_seek( $result, $rowNumber );
    }

    public function fetchAssoc( $result ) {
        return mysql_fetch_assoc( $result );
    }

    public function numFields( $result ) {
        return mysql_num_fields( $result );
    }

    public function fetchField( $result, $i ) {
        return mysql_fetch_field( $result, $i );
    }

    public function queryAssoc( $query, $link = '' ) {
        if($link != '') {
            $elements = mysql_query($query, $link);
        } else {
            $elements = mysql_query( $query );
        }

        $results = array();
        while( $element = $this->fetchAssoc( $elements ) ) {
            array_push( $results, $element );
        }

        return $results;
    }

    public function queryOne( $query, $link = '' ) {
        if($link != '') {
            $elements = mysql_query($query, $link);
        } else {
            $elements = mysql_query( $query );
        }

        return $this->fetchAssoc( $elements );
    }

    public function queryObject( $query, $link = '' )
    {
        if($link != '') {
            $elements = mysql_query($query, $link);
        } else {
            $elements = mysql_query( $query );
        }

        $results = array();
        while( $element = $this->fetchObject( $elements ) )
        {
            array_push( $results, $element );
        }

        return $results;
    }

    public function queryPairs( $query, $link = '' ) {
        if($link != '') {
            $elements = mysql_query($query, $link);
        } else {
            $elements = mysql_query( $query );
        }

        $results = array();
        while( $element = $this->fetchArray( $elements ) ) {
            $results[ $element[ 0 ] ] = $element[ 1 ];
        }

        return $results;
    }

    public function fetchMeta( $query, $link = '' ) {
        if($link != '') {
            $results = mysql_query($query, $link);
            $fields = mysql_fetch_assoc( $results );
        } else {
            $results = mysql_query( $query );
            $fields = mysql_fetch_assoc( $results );
        }

        $items = array();
        foreach( $fields as $field => $value ) {
            $items[ $field ][ 'name' ] = $field;
            $items[ $field ][ 'value' ] = $value;
        }

        return $items;
    }

}
