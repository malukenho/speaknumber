# Speak Number

[![Build Status](https://travis-ci.org/malukenho/speaknumber.svg?branch=master)](https://travis-ci.org/malukenho/speaknumber)

### Porque?

Você já se deu conta de como *cegos* navegam hoje na internet? já precisou adaptar algo em seu sistema para algum deficiente?
Creio que não.

Isso porque ninguém se importa muito com acessibilidade.
Os cegos de hoje usam um leitor de tela, que é simplesmente um programa que lê
tudo o que se passa na tela do usuário (que por sinal é uma área que ainda tem muito à evoluir).

O objetivo principal do *Speak Number* é facilitar a compreenção de números para cegos.

Veja a leitura dessa imagem sem o Speak Number:

```html
<img src="numer.png" alt="9856 pessoas" />
<!-- nove, oito, cinco, seis pessoas -->
```
O programa lê cada número separadamente o que dificulta a compreenção.
Agora, imagine a leitura de um número como `100.000.000`. Você se perderia na contagem
dos **zeros**, certo?

Agora vejamos com o uso do *Speak Number*:

```HTML
<img src="numer.png" alt="nove mil oitocentos e cinquenta e seis pessoas" />
```

*Note:* Esse é o principal objetivo. Mas, pode/deve ser usado como você quiser.

### Simples Exemplo

Exemplo simples pra uso:

```PHP
<?php

require 'vendor/autoload.php';

$number = (new \Speak\Number())->speak(8926);
var_dump($number); // oito mil novecentos e vinte e seis.
```
