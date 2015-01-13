<?php

require "vendor/autoload.php";

$phog =  new \Novia713\Phog\Phog();

$faker = Faker\Factory::create("es_ES");



$o = new StdClass;
$o->foo  = $faker->company;
$o->bar  = [3,14,16,125,14,2,3,6,5,4];
$o->baz  = $phog;
$o->quux = $faker->city;

for ($i=0; $i<5; $i++){
  $direcciones[]=$faker->streetAddress;
}

$phog->warn($faker->name);
$phog->info($faker->words(4));
$phog->log($faker->sentences(2), ["background-color"=>$faker->rgbCssColor]);
$phog->error($direcciones);
$phog->debug(array("Neo", "Morpheus", "Trinity", "Cypher", "Tank"),
                ["color"=>$faker->rgbCssColor,"background-color"=>$faker->rgbCssColor]);
$phog->table($o);
$phog->info(rand (-1, 3333), ["color"=>$faker->rgbCssColor,"background-color"=>$faker->rgbCssColor]);



