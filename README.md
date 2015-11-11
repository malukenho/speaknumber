# Speak Number

[![Build Status](https://travis-ci.org/malukenho/speaknumber.svg?branch=master)](https://travis-ci.org/malukenho/speaknumber)
[![Latest Stable Version](https://poser.pugx.org/malukenho/speaknumber/v/stable.png)](https://packagist.org/packages/malukenho/speaknumber) [![Total Downloads](https://poser.pugx.org/malukenho/speaknumber/downloads.png)](https://packagist.org/packages/malukenho/speaknumber) [![Latest Unstable Version](https://poser.pugx.org/malukenho/speaknumber/v/unstable.png)](https://packagist.org/packages/malukenho/speaknumber) [![License](https://poser.pugx.org/malukenho/speaknumber/license.png)](https://packagist.org/packages/malukenho/speaknumber)

### Por que?

Você já se deu conta de como *cegos* navegam hoje na internet? Já precisou adaptar algo em seu sistema para algum deficiente?
Creio que não.

Isso porque ninguém se importa muito com acessibilidade. Os cegos de hoje usam um leitor de tela, que é simplesmente um programa que lê tudo o que se passa na tela do usuário (que por sinal é uma área que ainda tem muito a evoluir).

O objetivo principal do *Speak Number* é facilitar a compreensão de números para cegos.

Veja a leitura dessa imagem sem o Speak Number:

```HTML
<img src="numer.png" alt="9856 pessoas" />
<!-- nove, oito, cinco, seis pessoas -->
```

O programa lê cada número separadamente o que dificulta a compreensão. Agora, imagine a leitura de um número como `100.000.000`. Você se perderia na contagem dos **zeros**, certo? Usando o *Speak Number*, teremos:

```HTML
<img src="numer.png" alt="nove mil oitocentos e cinquenta e seis pessoas" />
```

*NOTE:* Esse é o principal objetivo. Mas, pode/deve ser usado como você quiser.

#### Exemplo `Speak\Number#speak($number)`

```PHP
<?php

require 'vendor/autoload.php';

$number = (new \Speak\Number())->speak(8926);
var_dump($number); // oito mil novecentos e vinte e seis.
```
