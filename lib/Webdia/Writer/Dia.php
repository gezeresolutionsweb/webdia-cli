<?php

class Webdia_Writer_Dia extends Webdia_Writer implements Webdia_Writer_Interface {
    protected function getHeader() {
        $header = '<?xml version="1.0" encoding="UTF-8"?>
            <dia:diagram xmlns:dia="http://www.lysator.liu.se/~alla/dia/">
            <dia:diagramdata>
            <dia:attribute name="background">
            <dia:color val="#ffffff"/>
            </dia:attribute>
            <dia:attribute name="paper">
            <dia:composite type="paper">
            <dia:attribute name="name">
            <dia:string>#Letter#</dia:string>
            </dia:attribute>
            <dia:attribute name="tmargin">
            <dia:real val="2.8222"/>
            </dia:attribute>
            <dia:attribute name="bmargin">
            <dia:real val="2.8222"/>
            </dia:attribute>
            <dia:attribute name="lmargin">
            <dia:real val="2.8222"/>
            </dia:attribute>
            <dia:attribute name="rmargin">
            <dia:real val="2.8222"/>
            </dia:attribute>
            <dia:attribute name="is_portrait">
            <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="scaling">
            <dia:real val="1"/>
            </dia:attribute>
            <dia:attribute name="fitto">
            <dia:boolean val="false"/>
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
            </dia:composite>
            </dia:attribute>
            <dia:attribute name="guides">
            <dia:composite type="guides">
            <dia:attribute name="hguides"/>
            <dia:attribute name="vguides"/>
            </dia:composite>
            </dia:attribute>
            </dia:diagramdata>
            <dia:layer name="Segundo Plano" visible="true">';

        return $header;
    }

    protected function getFooter() {
        $footer = '</dia:layer>
            </dia:diagram>';

        return $footer;
    }

    protected function getObjectHeader( $x1, $y1, $x2, $y2, $x3, $y3, $width, $height, $name ) {
        $objectHeader = '<dia:object type="UML - Class" version="0" id="O0">
            <dia:attribute name="obj_pos">
            <dia:point val="' . $x1 . ',' . $y1 . '"/>
            </dia:attribute>
            <dia:attribute name="obj_bb">
            <dia:rectangle val="' . $x2 . ',' . $y2 . ';' . $x3 . ',' . $y3 . '"/>
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
            <dia:attribute name="name">
            <dia:string>#' . $name . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="stereotype">
            <dia:string/>
            </dia:attribute>
            <dia:attribute name="abstract">
            <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="suppress_attributes">
            <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="suppress_operations">
            <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="visible_attributes">
            <dia:boolean val="true"/>
            </dia:attribute>
            <dia:attribute name="visible_operations">
            <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="foreground_color">
            <dia:color val="#000000"/>
            </dia:attribute>
            <dia:attribute name="background_color">
            <dia:color val="#ffffff"/>
            </dia:attribute>
            <dia:attribute name="normal_font">
            <dia:font name="Courier"/>
            </dia:attribute>
            <dia:attribute name="abstract_font">
            <dia:font name="Courier-Oblique"/>
            </dia:attribute>
            <dia:attribute name="classname_font">
            <dia:font name="Helvetica-Bold"/>
            </dia:attribute>
            <dia:attribute name="abstract_classname_font">
            <dia:font name="Helvetica-BoldOblique"/>
            </dia:attribute>
            <dia:attribute name="font_height">
            <dia:real val="0.8"/>
            </dia:attribute>
            <dia:attribute name="abstract_font_height">
            <dia:real val="0.8"/>
            </dia:attribute>
            <dia:attribute name="classname_font_height">
            <dia:real val="1"/>
            </dia:attribute>
            <dia:attribute name="abstract_classname_font_height">
            <dia:real val="1"/>
            </dia:attribute>
            <dia:attribute name="attributes">';

        return $objectHeader;
    }

    protected function getObjectFooter() {
        $objectFooter = '</dia:attribute>
            <dia:attribute name="operations"/>
            <dia:attribute name="template">
            <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="templates"/>
            </dia:object>';

        return $objectFooter;
    }

    protected function getAttribute( $name, $type, $default ) {
        $attribute = '<dia:composite type="umlattribute">
            <dia:attribute name="name">
            <dia:string>#' . $name . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="type">
            <dia:string>#' . $type . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="value">
            <dia:string>#' . $default . '#</dia:string>
            </dia:attribute>
            <dia:attribute name="visibility">
            <dia:enum val="1"/>
            </dia:attribute>
            <dia:attribute name="abstract">
            <dia:boolean val="false"/>
            </dia:attribute>
            <dia:attribute name="class_scope">
            <dia:boolean val="false"/>
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

        foreach( $this->reader->getTables() as $table ) {
            // Calculate position.
            $x1 += $xinc;
            $x2 += $xinc;
            $x3 += $xinc;
            if ($x1 > ($left+(10*$xinc))) {
                $x1 = $left;
                $x2 = $x1 - 0.05;
                $x3 = $x2 + $width + 0.1;
                $y1 += $yinc;
                $y2 += $yinc;
                $y3 += $yinc;
            }

            $xml .= $this->getObjectHeader( $x1, $y1, $x2, $y2, $x3, $y3, $width, $height, $table[ 'name' ] );

            foreach( $this->reader->getFields( $table[ 'name' ] ) as $field ) {
                $xml .= $this->getAttribute( $field[ 'name' ], $field[ 'type' ], $field[ 'default' ] );
            }

            $xml .= $this->getObjectFooter();
        }

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
