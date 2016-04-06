# Webdia 0.2 (Tremblay)

A web based database modeling and command line tools (dia, sql)

Copyright © 2010-2016 Sylvain Lévesque

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

Webdia is a command line tools that transform database schema from multiple sources to multiple destinations format. Supported sources are: Dia (UML), Mysql, Mssql. Supported destination are: Dia (UML), Sql, Wiki (Dokuwiki).

You can read MILESTONES section down there to see what's next ! Contributions are welcome. Any suggestions ?

Sylvain Lévesque <slevesque@gezere.com>


## Requirements

    * Linux Operating System (i'm using Ubuntu)
    * PHP 5.x
    * PHP CLI (Command line interpreter)
    * MySQL (for the web interface)


## MILESTONES

### 0.x (Tremblay)

  * Deliver initial release.
  * Complete basic CLI tools.
  * Complete basic CLI readers and writers.
  * Add custom settings file to defined the way we should render the output.
  * Package the application the right way.

### 1.x (Gagnon)

  * Have a start of a web modeling tools
  * Being able to convert from the GUI.
  * Open and save Dia schema files.
  * Manage a list of schema project.

### 2.x (Roy)

  * Manager user access.
  * Have some collaboration in the webapp.
  * Use dia stencils.

### 3.x (Côté)

  * Manage schema versioning.
  * Generate scaffold application base on a schema and CakePHP.


## VERSIONS HISTORY

### 0.2.0 (Tremblay)

* Implement a custom settings file to defined the way we should render the output.

### 0.1.0 (Tremblay)

* Initial version
