<?php
namespace Novia713\Phog;
/*
 * This file is part of Phog.
 *
 * (c) 2015 Leandro Vázquez
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 *
 * Tool for printing PHP variables
 * in navigator javascript console.
 *
 * @author leandro <leandro@leandro.org> 2015
*/

error_reporting(E_ALL);

class Phog {
  
    private $_build_print;

    public function __construct() {
        $this->_build_print = function ($mode, $txt, $css = null) {
            $txt = json_encode($txt);
            if ($css) {
                $str_css = '';
                array_walk($css, function ($v, $k) use (&$str_css) {
                    $str_css.= "$k:$v;";
                });
                $txt = '"%c' . str_replace('"', '', $txt) . '", "' . $str_css . '"';
            }
            echo "\n<script>console." . $mode . '(' . $txt . ");</script>\n";
        };
    }

    public function console($mode, $txt, $css = null) {
        $this->_build_print->__invoke($mode, $txt, $css);
    }
}




/*
$phog = new \Novia713\Phog\Phog();
$phog->console("log", 'hola amigos log', ['color' => 'yellow', 'background-color' => 'purple']);
$phog->console("info", 'txt info', ['color' => 'yellow', 'background-color' => 'navy']);
$phog->console("warn", 'txt warn', ['color' => 'yellow', 'background-color' => 'purple']);
$phog->console("debug", 'txt debug', ['color' => 'yellow', 'background-color' => 'navy']);
$phog->console("error", 'txt error', ['color' => 'yellow', 'background-color' => 'purple']);
$phog->console("table", [1 => 'abc', 2 => 'abcd', 3 => 'abcf', 4 => 'abcss', 5, 6, 7, 8, 9]);
*/
