
<?php
/** 
 * PHP version ^7.0
 * Bibliotecas: GMP e BCMath
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

$q = gmp_nextprime(bcsqrt($n));
$p = gmp_div_qr($n, $q);

while (!gmp_prob_prime(gmp_intval($p[0])) || bccomp(bcmul(gmp_intval($p[0]), $q), $n) != 0) {
    $q = gmp_nextprime($q);
    $p = gmp_div_qr($n, $q);
};

$p = gmp_intval($p[0]);
$qq = bcmul(bcsub($p, 1), bcsub($q, 1));

$d = euclidesExt($e, $qq, 1);
echo "p=$p\nq=$q\nqq=$qq\nd=$d\n\n";

$msgDecifrada = '';
foreach ($msgCifrada as $cifraMensagem) {
    $asciiDecimal = bcpowmod($cifraMensagem, $d, $n);
    $msgDecifrada .= chr($asciiDecimal);
}

echo $msgDecifrada;
die("\n");

function euclidesExt($a, $b, $c)
{
    $r = bcmod($b, $a);

    if ($r == 0) {
        return bcmod(bcdiv($c, $a), bcdiv($b, $a));
    }

    return bcdiv(bcadd(bcmul(euclidesExt($r, $a, -$c), $b), $c), bcmod($a, $b));
}
