# Speak Number

### Porque?

Você já se deu conta de como *cegos* navegam hoje na internet?
Você já precisou adaptar algo em seu sistema para algum deficiente?
Creio que não.

Isso, porque ninguém se importa muito com acessibilidade.
Os cegos de hoje, usam um leitor de tela. Que é simplesmente um programa que lê
tudo o que se passa na tela do usuário (Por sinal é uma área que ainda tem muito
o que evoluir).

O objetivo principal do *Speak Number* é facilitar a compreenção de números para cegos.

Veja a leitura dessa imagem sem o Speak Number:

```html
<img src="numer.png" alt="9856 pessoas" />
<!-- nove, oito, cinco, seis pessoas -->
```
O programa lê cada número separadamente o que dificulta a compreenção.
Agora, imagine a leitura de um número como `100.000.000`. Você se perderia na contagem
dos **zeros**, não?

Agora vejamos com o uso do *Speak Number*:

```html
<img src="numer.png" alt="nove mil oiticentos e cinquenta e seis pessoas" />
```
*Note:* Esse é o principal objetivo. Mas, pode/deve ser usado como você quiser.


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