<?php

class Webdia_Writer_Dia extends Webdia_Writer implements Webdia_Writer_Interface
{
    private $tables = null;
    private $nbTables = 0;
    private $references = [];

    protected function getHeader() {
        $header = '<?xml version="1.0" encoding="UTF-8"?>
            <dia:diagram xmlns:dia="http://www.lysator.liu.se/~alla/dia/">
                <dia:diagramdata>
                    <dia:attribute name="background">
                        <dia:color val="#ffffff"/>
                    </dia:attribute>
                    <dia:attribute name="pagebreak">
                        <dia:color val="#000099"/>
                    </dia:attribute>
                    <dia:attribute name="paper">
                        <dia:composite type="paper">
                            <dia:attribute name="name">
                                <dia:string>#Letter#</dia:string>
                            </dia:attribute>
                            <dia:attribute name="tmargin">
                                <dia:real val="2.5399999618530273"/>
                            </dia:attribute>
                            <dia:attribute name="bmargin">
                                <dia:real val="2.5399999618530273"/>
                            </dia:attribute>
                            <dia:attribute name="lmargin">
                                <dia:real val="2.5399999618530273"/>
                            </dia:attribute>
                            <dia:attribute name="rmargin">
                                <dia:real val="2.5399999618530273"/>
                            </dia:attribute>
                            <dia:attribute name="is_portrait">
                                <dia:boolean val="false"/>
                            </dia:attribute>
                            <dia:attribute name="scaling">
                                <dia:real val="0.62845361232757568"/>
                            </dia:attribute>
                            <dia:attribute name="fitto">
                                <dia:boolean val="true"/>
                            </dia:attribute>
                            <dia:attribute name="fitwidth">
                                <dia:int val="1"/>
                            </dia:attribute>
                            <dia:attribute name="fitheight">
                                <dia:int val="1"/>
                            </dia:attribute>
                        </dia:composite>
                </dia:attribute>
                <dia:attribute name="grid">
                    <dia:composite type="grid">
                        <dia:attribute name="width_x">
                            <dia:real val="1"/>
                        </dia:attribute>
                        <dia:attribute name="width_y">
                            <dia:real val="1"/>
                        </dia:attribute>
                        <dia:attribute name="visible_x">
                            <dia:int val="1"/>
                        </dia:attribute>
                        <dia:attribute name="visible_y">
                            <dia:int val="1"/>
                        </dia:attribute>
                        <dia:composite type="color"/>
                    </dia:composite>
                </dia:attribute>
                <dia:attribute name="color">
                    <dia:color val="#d8e5e5"/>
                </dia:attribute>
                <dia:attribute name="guides">
                    <dia:composite type="guides">
                        <dia:attribute name="hguides"/>
                        <dia:attribute name="vguides"/>
                    </dia:composite>
                </dia:attribute>
            </dia:diagramdata>
            <dia:layer name="Arrière-plan" visible="true" active="true">
            ';

        return $header;
    }

    protected function getFooter() {
        $footer = '</dia:layer>
            </dia:diagram>';

        return $footer;
    }

    protected function getObjectHeader( $x1, $y1, $x2, $y2, $x3, $y3, $width, $height, $name, $comment ) {
        // Push id and table name in the reference array.
        $this->references[$name] = 'O' . $this->nbTables;

        $fillColor = '#FFFFFF';
        if(!empty($this->settings['colors'])) {
            foreach($this->settings['colors'] as $k => $v) {
                if(preg_match($k, $name)) {
                    $fillColor = $v;
                    break;
                }
            }
        }

//        $objectHeader = '<dia:object type="Database - Table" version="0" id="O0' . uniqid() . '">
//        $objectHeader = '<dia:object type="Database - Table" version="0" id="' . $name . '">
        $objectHeader = '<dia:object type="Database - Table" version="0" id="O' . $this->nbTables . '">
            <dia:attribute name="obj_pos">
                <dia:point val="' . $x1 . ',' . $y1 . '"/>
            </dia:attribute>
            <dia:attribute name="obj_bb">
                <dia:rectangle val="' . $x2 . ',' . $y2 . ';' . $x3 . ',' . $y3 . '"/>
            </dia:attribute>
            <dia:attribute name="meta">
                <dia:composite type="dict"/>
            </dia:attribute>
            <dia:attribute name="elem_corner">
                <dia:point val="' . $x1 . ',' . $y1 . '"/>
            </dia:attribute>
            <dia:attribute name="elem_width">
                <dia:real val="' . $width . '"/>
            </dia:attribute>
            <dia:attribute name="elem_height">
                <dia:real val="' . $height . '"/>
            </dia:attribute>
            <dia:attribute name="text_colour">
                <dia:color val="#000000"/>
            </dia:attribute>
            <dia:attribute name="line_colour">
                <dia:color val="#000000"/>
            </dia:attribute>
            <dia:attribute name="fill_colour">
                <dia:color val="' . $fillColor . '"/>
            </dia:attribute>
            <dia:attribute name="line_width">
                <dia:real val="0.10000000000000001"/>
            </dia:attribute>
            <dia:attribute name="name">
                <dia:string>#' . $name . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="comment">
                <dia:string>#' . htmlspecialchars( $comment ) . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="visible_comment">
                <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="tagging_comment">
                <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="underline_primary_key">
                <dia:boolean val="true"/>
            </dia:attribute>
            <dia:attribute name="bold_primary_keys">
                <dia:boolean val="true"/>
            </dia:attribute>
            <dia:attribute name="normal_font">
                <dia:font family="monospace" style="0" name="courier"/>
            </dia:attribute>
            <dia:attribute name="name_font">
                <dia:font family="sans" style="80" name="helvetica-bold"/>
            </dia:attribute>
            <dia:attribute name="comment_font">
                <dia:font family="sans" style="8" name="helvetica-oblique"/>
            </dia:attribute>
            <dia:attribute name="normal_font_height">
                <dia:real val="0.80000000000000004"/>
            </dia:attribute>
            <dia:attribute name="name_font_height">
                <dia:real val="0.69999999999999996"/>
            </dia:attribute>
            <dia:attribute name="comment_font_height">
                <dia:real val="0.69999999999999996"/>
            </dia:attribute>
            <dia:attribute name="attributes">';

        // Increment nbTables variables.
        $this->nbTables++;

        return $objectHeader;
    }

    protected function getObjectFooter() {
        $objectFooter = '</dia:attribute>
            </dia:object>';

        return $objectFooter;
    }


    /* TO BE INTEGRATE LATER.
    public function getConnectionHeader() {
        return '<dia:connections>';
    }
    public function getConnectionFooter() {
        return '</dia:connections>';
    }
    public function addConnection() {
      $connection = '<dia:connection handle="0" to="O0" connection="15"/>';
    }
     */

    public function getReferences()
    {
        $xml = '';
        if(!empty($this->settings['relations'])) {
            foreach($this->settings['relations'] as $from => $v) {
                if(!empty($v['has_one'])) {
                    foreach($v['has_one'] as $to) {
                        $xml .= $this->getDatabaseReferenceObject('has_one', $from, $to);
                    }
                }

                if(!empty($v['has_many'])) {
                    foreach($v['has_many'] as $to) {
                        $xml .= $this->getDatabaseReferenceObject('has_many', $from, $to);
                    }
                }

                if(!empty($v['belongs_to'])) {
                    foreach($v['belongs_to'] as $to) {
                        $xml .= $this->getDatabaseReferenceObject('belongs_to', $from, $to);
                    }
                }

                if(!empty($v['has_and_belongs_to_many'])) {
                    foreach($v['has_and_belongs_to_many'] as $to) {
                        $xml .= $this->getDatabaseReferenceObject('has_and_belongs_to_many', $from, $to);
                    }
                }
            }
        }

        return $xml;
    }

    public function getDatabaseReferenceObject($type, $from, $to)
    {
        // @todo Do something with the type.
        // @todo Verify if there is a reference in the $references array else return nothing.

        $databaseReference = '<dia:object type="Database - Reference" version="0" id="O' . $this->nbTables . '">
            <dia:attribute name="obj_pos">
                <dia:point val="20.96,16.25"/>
            </dia:attribute>
            <dia:attribute name="obj_bb">
                <dia:rectangle val="20.96,14.9;33.5,16.25"/>
            </dia:attribute>
            <dia:attribute name="meta">
                <dia:composite type="dict"/>
            </dia:attribute>
            <dia:attribute name="orth_points">
                <dia:point val="20.96,16.25"/>
                <dia:point val="27.23,16.25"/>
                <dia:point val="27.23,15.55"/>
                <dia:point val="33.5,15.55"/>
            </dia:attribute>
            <dia:attribute name="orth_orient">
                <dia:enum val="0"/>
                <dia:enum val="1"/>
                <dia:enum val="0"/>
            </dia:attribute>
            <dia:attribute name="orth_autoroute">
                <dia:boolean val="true"/>
            </dia:attribute>
            <dia:attribute name="text_colour">
                <dia:color val="#000000"/>
            </dia:attribute>
            <dia:attribute name="line_colour">
                <dia:color val="#000000"/>
            </dia:attribute>
            <dia:attribute name="line_width">
                <dia:real val="0.10000000000000001"/>
            </dia:attribute>
            <dia:attribute name="line_style">
                <dia:enum val="0"/>
                <dia:real val="1"/>
            </dia:attribute>
            <dia:attribute name="corner_radius">
                <dia:real val="0"/>
            </dia:attribute>
            <dia:attribute name="end_arrow">
                <dia:enum val="0"/>
            </dia:attribute>
            <dia:attribute name="start_point_desc">
                <dia:string>#0..n#</dia:string>
            </dia:attribute>
            <dia:attribute name="end_point_desc">
                <dia:string>#1#</dia:string>
            </dia:attribute>
            <dia:attribute name="normal_font">
                <dia:font family="monospace" style="0" name="Courier"/>
            </dia:attribute>
            <dia:attribute name="normal_font_height">
                <dia:real val="0.59999999999999998"/>
            </dia:attribute>
            <dia:connections>
                <dia:connection handle="0" to="' . $this->references[$from] . '" connection="13"/>
                <dia:connection handle="1" to="' . $this->references[$to] . '" connection="12"/>
            </dia:connections>
        </dia:object>';

        // @todo Find the right number for the connection for both side of the connection according to type and if we want $from table on the left or on the right.

        $this->nbTables++;

        return $databaseReference;
    }



    protected function getAttribute( $field ) {
        $primaryKey = ( (int) $field[ 'primary_key' ] === 1 ) ? 'true' : 'false';
        $nullable = ( $field[ 'nullable' ] === 'NO' ) ? 'false' : 'true';
        $unique = ( (int) $field[ 'unique' ] === 1 ) ? 'true' : 'false';

        $attribute = '<dia:composite type="table_attribute">
            <dia:attribute name="name">
            <dia:string>#' . $field[ 'name' ] . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="type">
            <dia:string>#' . $field[ 'type' ] . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="comment">
            <dia:string>#' . htmlspecialchars( $field[ 'comment' ] ) . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="primary_key">
            <dia:boolean val="' . $primaryKey . '"/>
            </dia:attribute>
            <dia:attribute name="nullable">
            <dia:boolean val="' . $nullable . '"/>
            </dia:attribute>
            <dia:attribute name="unique">
            <dia:boolean val="' . $unique . '"/>
            </dia:attribute>
            </dia:composite>';

        return $attribute;
    }

    protected function genXml() {
        $left = 1.0;
        $top = 5.0;
        $x1 = $left;
        $y1 = $top;
        $x2 = $x1 - 0.05;
        $y2 = $y1 - 0.05;
        $width = 12;
        $height = 30;
        $x3 = $x2 + $width + 0.1;
        $y3 = $y2 + $height + 0.1;
        $xinc = 5;
        $yinc = 10;

        $xml = $this->getHeader();

        $this->tables = $this->reader->getTables();
        foreach($this->tables as $table) {
            // Calculate position.
            $x1 += $xinc;
            $x2 += $xinc;
            $x3 += $xinc;
            if ($x1 > ($left+(20*$xinc))) {
                $x1 = $left;
                $x2 = $x1 - 0.05;
                $x3 = $x2 + $width + 0.1;
                $y1 += $yinc;
                $y2 += $yinc;
                $y3 += $yinc;
            }

            $xml .= $this->getObjectHeader( $x1, $y1, $x2, $y2, $x3, $y3, $width, $height, $table[ 'name' ], $table[ 'comment' ] );

            foreach( $this->reader->getFields( $table[ 'name' ] ) as $field ) {
                $xml .= $this->getAttribute( $field );
            }

            $xml .= $this->getObjectFooter();
        }

        $xml .= $this->getReferences();

        $xml .= $this->getFooter();

        return $xml;
    }

    public function write() {
        // generate xml
        $xml = $this->genXml();

        $filename = 'output.dia';
        if( !empty( $this->getopt->of ) ) {
            $filename = $this->getopt->of;
        }

        $fp = fopen( $filename, 'w' );
        fwrite( $fp, $xml );
    }
}
