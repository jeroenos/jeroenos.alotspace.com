<?php

/**

  Database Abstraction interface definition
  
  mySQL Abstraction Layer

  Copyright (C) 2009, Bianka Martinovic
  Contact me: blackbird(at)webbird.de, http://www.webbird.de/

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or (at
  your option) any later version.

  This program is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
  General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, see <http://www.gnu.org/licenses/>.

**/

include_once dirname(__FILE__).'/class.wbDBBase.php';
include_once dirname(__FILE__).'/interface.wbDBDriver.php';

// decorator class

class wbMySQL extends wbDBBase implements wbDBDriver {

    // ----- Debugging -----
    #protected        $debugLevel      = KLogger::DEBUG;
    protected        $debugLevel      = KLogger::OFF;

    /**
     * set some defaults specific to this driver class
     * Overwrites defaults set by wbDBBase
     **/
    public function defaults () {
        $this->port       = 3306;
        $this->pdo_driver = 'mysql';
    }   // end function defaults ()
    
    /**
     *
     **/
    public function getDriverOptions() {
        #return array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" );
    }
    
}


?>
