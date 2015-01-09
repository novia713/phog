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
  var $_print;
  function __construct()
  {
    $this->_print = function ($msg, $mode)
    {
      echo "<script>console." . $mode . "(" . $msg . ");</script>";
    };
  }

  public function log($txt)
  {
    $this->printjson($txt, "log");
  }

  public function info($txt)
  {
    $this->printjson($txt, "info");
  }

  public function warn($txt)
  {
    $this->printjson($txt, "warn");
  }

  public function table($txt)
  {
    $this->printobj($txt, "table");
  }

  // log, info & warn → quoted text
  private function printjson($txt, $mode)
  {
    $txt = json_encode(json_encode($txt));
    $this->_print->__invoke($txt, $mode);
  }

  // table → unquoted object
  private function printobj($txt, $mode)
  {
    $txt = json_encode($txt);
    $this->_print->__invoke($txt, $mode);
  }
}
