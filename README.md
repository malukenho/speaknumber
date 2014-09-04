# Speak Number

### Simples Exemplo

Exemplo simples pra uso:

**Por enquanto, a classe só consegue falar números com 4 digitos :'(**

```php
<?php
require 'Speak.php';

$number = new \Speak\Number(8926);
echo $number->speak();

// oito mil novecentos e vinte e seis
```