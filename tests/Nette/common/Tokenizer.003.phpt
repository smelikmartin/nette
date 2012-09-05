<?php

/**
 * Test: Nette\Tokenizer::fetch()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */

use Nette\Tokenizer;



require __DIR__ . '/../bootstrap.php';



$tokenizer = new Tokenizer(array(
	'\d+',
	'\s+',
	'\w+',
));
$tokenizer->tokenize('say 123');
Assert::false( $tokenizer->fetch('s') );
Assert::same( 'say', $tokenizer->fetch('say') );
Assert::same( ' ', $tokenizer->fetch() );



$tokenizer = new Tokenizer(array(
	T_DNUMBER => '\d+',
	T_WHITESPACE => '\s+',
	T_STRING => '\w+',
));
$tokenizer->tokenize("say 123");
Assert::same( Tokenizer::createToken('say', T_STRING, 1), $tokenizer->fetchToken('say') );
Assert::same( ' ', $tokenizer->fetch() );
