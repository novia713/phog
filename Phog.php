<?php

/*
 * This file is part of Phog.
 *
 * (c) 2015 Leandro Vázquez
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Tool for printing PHP variables
 * in navigator javascript console.
 *
 * @author leandro <leandro@leandro.org>
 */

error_reporting(E_ALL);
class Phog
{

  //@TODO: add console support

  /**
    auxiliary closure for printing in console
  */
  var $_print;
  function __construct() {
    $this->_print = function($msg, $mode){
      echo "<script>console." . $mode . "(" . $msg . ");</script>";
    };
  }

  /**
    prints console.log
    @param txt (string)
  */
  public function log($txt){
    $this->printjson($txt, "log");
  }

  /**
    prints console.info
    @param txt (string)
  */
  public function info($txt){
    $this->printjson($txt, "info");
  }

  /**
    prints console.warn
    @param txt (string)
  */
  public function warn($txt){
    $this->printjson($txt, "warn");
  }

  /**
    prints console.table
    @param txt (object/array)
  */
  public function table($txt){
    $this->printobj($txt, "table");
  }


  /**
    private functions
  */

  // log, info & warn → quoted text
  private function printjson($txt, $mode){
    $txt = json_encode( json_encode($txt) );
    $this->_print->__invoke($txt, $mode);
  }

  // table → unquoted object
  private function printobj($txt, $mode){
    $txt = json_encode($txt);
    $this->_print->__invoke($txt, $mode);
  }



}




/*
$languages = [
     ["name"=> "JavaScript", "fileExtension"=> ".js"] ,
     ["name"=> "TypeScript", "fileExtension"=> ".ts"] ,
     ["name"=> "CoffeeScript", "fileExtension"=> ".coffee"]
];

$phog = new Phog;
$phog->table(new StdClass);
$phog->info("lorem ipsum");
$phog->table($languages);
$phog->warn([1,"anda",3,4,5]);

*/
