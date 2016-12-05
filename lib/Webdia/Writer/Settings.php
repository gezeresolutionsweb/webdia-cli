<?php

class Webdia_Writer_Settings extends Webdia_Writer implements Webdia_Writer_Interface
{
    private $tables = null;

    /**
     * Generate YAML string.
     *
     * @access protected
     * @author Sylvain Lévesque <slevesque@gezere.com>
     * @return string
     */
    protected function genYaml()
    {
        $yaml = 'relations: ' . PHP_EOL;

        $this->tables = $this->reader->getTables();
        foreach($this->tables as $table) {
            $yaml .= '    ' . $table['name'] . ':' . PHP_EOL;
        }

        return $yaml;
    }

    /**
     * Write YAML settings file.
     *
     * @access public
     * @author Sylvain Lévesque <slevesque@gezere.com>
     * @return void
     */
    public function write() {
        $yaml = $this->genYaml();

        $filename = 'settings.yaml';
        if(!empty($this->getopt->of)) {
            $filename = $this->getopt->of;
        }

        $fp = fopen($filename, 'w');
        fwrite($fp, $yaml);
    }
}
