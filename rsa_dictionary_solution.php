<?php

/** 
 * PHP version ^7.0
 * @author Gabriel Portes <gabriel-portes@hotmail.com>
 */

$n = 3386871005523622783;
$e = 65537;

$msgCifrada = [
    '3273204705651769058',
    '646988929665855640',
    '414039851588460319',
    '1564884230541949829',
    '2061518062454276150',
    '531123879758565307',
    '577351741551993872',
    '2354366801187868444',
    '531123879758565307',
    '1045758354504410760',
    '114322492855077014',
    '2087794601428009825',
    '3233175618851774368',
    '531123879758565307',
    '2877578967909742608',
    '1445428592792218022'
];

// montando meu dicionário de dados com os 255 chars da tabela ASCII
foreach (range(0, 255) as $m) {
    $dicionario[$m] = bcpowmod($m, $e, $n);
}

// procurando as cifras da mensagem no meu dicionário de dados
$msgDecifrada = '';
foreach ($msgCifrada as $cifraMensagem) {
    foreach ($dicionario as $asciiDecimal => $cifraDicionario) {
        if ($cifraMensagem == $cifraDicionario) {
            $msgDecifrada .= chr($asciiDecimal);
            break;
        }
    }
}

echo $msgDecifrada;
die("\n");
