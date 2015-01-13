<?php
namespace Novia713\Phog;
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
  private $_print;
  public function __construct()
  {
    $this->_print = function ($msg, $mode, $css=null)
    {
      if ($css){
        $str_css="";
        foreach ($css as $k => $v) { $str_css .= "$k:$v;"; }
        $msg ='"%c' . str_replace('"', "", $msg) . '", "'.$str_css.'"';
      }
      echo "<script>console." . $mode . "(" . $msg . ");</script>";
    };
  }

  public function log($txt, $css=null)
  {
    $this->printjson($txt, "log", $css);
  }

  public function info($txt, $css=null)
  {
    $this->printjson($txt, "info", $css);
  }

  public function warn($txt, $css=null)
  {
    $this->printjson($txt, "warn", $css);
  }

  public function debug($txt, $css=null)
  {
    $this->printjson($txt, "debug", $css);
  }

  public function error($txt, $css=null)
  {
    $this->printjson($txt, "error", $css);
  }

  public function table($txt)
  {
    $this->printobj($txt, "table");
  }

  // log, info & warn
  private function printjson($txt, $mode, $css=null)
  {
    $txt = json_encode($txt);
    $this->_print->__invoke($txt, $mode, $css);
  }

  // table → unquoted object, without CSS
  private function printobj($txt, $mode)
  {
    $txt =  json_encode($txt);
    $this->_print->__invoke($txt, $mode);
  }
}
