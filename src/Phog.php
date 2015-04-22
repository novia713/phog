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
  private $_build_print;

  private $txt;
  private $css;

  public function __construct()
  {
    $this->_setup_vars = function ($txt, $css)
    {
      $this->txt = ($txt)? $txt : null;
      $this->css = ($css)? $css : null;
    };

    $this->_print = function ($msg, $mode, $css=null)
    {
      if ($css)
      {
        $str_css="";
        array_walk($css,
            function($v, $k) use (&$str_css) {
                $str_css .= "$k:$v;";
            });
        $msg ='"%c' . str_replace('"', "", $msg) . '", "'.$str_css.'"';
      }
      echo "<script>console." . $mode . "(" . $msg . ");</script>";
    };

    $this->_build_print = function ($mode)
    {
      $this->printjson($this->txt, $mode, $this->css);
    };
  }

  public function log($txt, $css=null)
  {
    $this->_setup_vars->__invoke($txt, $css);
    $this->_build_print->__invoke("log");
  }

  public function info($txt, $css=null)
  {
    $this->_setup_vars->__invoke($txt, $css);
    $this->_build_print->__invoke("info");
  }

  public function warn($txt, $css=null)
  {
    $this->_setup_vars->__invoke($txt, $css);
    $this->_build_print->__invoke("warn");
  }

  public function debug($txt, $css=null)
  {
    $this->_setup_vars->__invoke($txt, $css);
    $this->_build_print->__invoke("debug");
  }

  public function error($txt, $css=null)
  {
    $this->_setup_vars->__invoke($txt, $css);
    $this->_build_print->__invoke("error");
  }

  public function table($txt)
  {
    $this->printobj($txt, "table");
  }

  // log, info & warn
  private function printjson($txt, $mode, $css)
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

/*
$phog = new \Novia713\Phog\Phog();
$phog->log("hola amigos log", ["color"=>"yellow","background-color"=>"purple"]);
$phog->info("info", ["color"=>"yellow","background-color"=>"navy"]);
$phog->warn("warn", ["color"=>"yellow","background-color"=>"purple"]);
$phog->debug("debug", ["color"=>"yellow","background-color"=>"navy"]);
$phog->error("error", ["color"=>"yellow","background-color"=>"purple"]);
*/
