# webdia
An online database modeling and command line tools (dia, sql)

# webdia 0.3.0

Copyright © 2010-2015 Sylvain Lévesque

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.


## Notice

This software is inspired by:

sql2dia software originaly written in Perl by Itamar Almeida de Carvalho
and can be found here: http://sql2dia.sf.net

Dia an open source general-purpose diagramming software, developed
originally by Alexander Larsson and can be found here: https://live.gnome.org/Dia

We are not affiliated in any ways with thoses projects.


## What's this ?

Webdia is a command line tools that transform database schema from multiple source to multiple destination format. Supported sources are: Dia (UML), Mysql, Mssql. Supported destination are: Dia (UML), Sql, Wiki (Dokuwiki).  Each tables are represented as UML class and each fields are reprenseted as UML class attributes.

You can read MILESTONES section down ther to see what's next ! Contributions are welcome. Any suggestions ?

Sylvain Lévesque <slevesque@gezere.com>


## Requirements

    * Linux Operating System (i'm using Ubuntu)
    * PHP 5.x
    * PHP CLI (Command line interpreter)
    * MySQL and existing databases (with access to it)


## MILESTONES

### Version 0.4

  * Complete Writer::Mysql.
  * Complete Reader::Sql
  * Have a start of a web modeling tools
  * Being able to convert from the GUI.
  * Open and save Dia schema files.

### Version later

  * Manager user access.
  * Export schema in PDF from GUI.
  * Export schema in DIA from GUI.
  * Export schema in WIKI from GUI.
  * Export schema in SQL from GUI.
  * Manager primary (protected), secondary (public) keys and standard (private) fields.
  * Use dia stencils.

### Version after later

  * Manage schema versioning.
  * Generate scaffold application base on a schema and CakePHP.
