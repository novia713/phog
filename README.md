# phog
Tool for printing PHP variables in navigator javascript console.


```php
require "vendor/autoload.php";
$phog = new \Novia713\Phog\Phog();
$phog->log($value);
$phog->info($arr);
$phog->warn("¡¡autodidacta en la sala!!");
$phog->table($obj);

$phog->log(array("Neo", "Morpheus", "Trinity"),  ["color"=>"yellow","background-color"=>"navy"]);
$phog->info(rand (-1, 3333), ["color"=>"yellow","background-color"=>"purple"]);
```


![alt tag](http://pix.toile-libre.org/upload/original/1421064314.png)
![alt tag](http://pix.toile-libre.org/upload/original/1421077792.png)

