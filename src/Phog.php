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

/*
 * Tool for printing PHP variables
 * in navigator javascript console.
 *
 * @author leandro <leandro@leandro.org>
 */

error_reporting(E_ALL);
class Phog
{
  private $_build_print;

    public function __construct()
    {
      $this->_build_print = function ($txt, $mode, $css = null) {
          $txt = json_encode($txt);
          if ($css) {
              $str_css = '';
              array_walk($css,
                function ($v, $k) use (&$str_css) {
                    $str_css .= "$k:$v;";
                });
              $txt = '"%c'.str_replace('"', '', $txt).'", "'.$str_css.'"';
          }
          echo "\n<script>console.".$mode.'('.$txt.");</script>\n";
      };
    }

    public function log($txt, $css = null)
    {
        $this->_build_print->__invoke($txt, 'log', $css);
    }

    public function info($txt, $css = null)
    {
        $this->_build_print->__invoke($txt, 'info', $css);
    }

    public function warn($txt, $css = null)
    {
        $this->_build_print->__invoke($txt, 'warn', $css);
    }

    public function debug($txt, $css = null)
    {
        $this->_build_print->__invoke($txt, 'debug', $css);
    }

    public function error($txt, $css = null)
    {
        $this->_build_print->__invoke($txt, 'error', $css);
    }

    public function table($txt)
    {
        $this->_build_print->__invoke($txt, 'table');
    }
}

/*
$phog = new \Novia713\Phog\Phog();
$phog->log('hola amigos log', ['color' => 'yellow', 'background-color' => 'purple']);
$phog->info('info', ['color' => 'yellow', 'background-color' => 'navy']);
$phog->warn('warn', ['color' => 'yellow', 'background-color' => 'purple']);
$phog->debug('debug', ['color' => 'yellow', 'background-color' => 'navy']);
$phog->error('error', ['color' => 'yellow', 'background-color' => 'purple']);
$phog->table([1 => 'abc', 2 => 'abcd', 3 => 'abcf', 4 => 'abcss', 5, 6, 7, 8, 9]);
*/
