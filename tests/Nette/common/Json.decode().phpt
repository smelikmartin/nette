<?php

/**
 * Test: Nette\Json::decode()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */

use Nette\Json;



require __DIR__ . '/../bootstrap.php';



Assert::same( "ok", Json::decode('"ok"') );
Assert::null( Json::decode('') );
Assert::null( Json::decode('null') );
Assert::null( Json::decode('NULL') );


Assert::equal( (object) array('a' => 1), Json::decode('{"a":1}') );
Assert::same( array('a' => 1), Json::decode('{"a":1}', Json::FORCE_ARRAY) );



Assert::throws(function() {
	Json::decode('{');
}, 'Nette\JsonException', 'Syntax error, malformed JSON');



Assert::throws(function() {
	Json::decode('{}}');
}, 'Nette\JsonException', 'Syntax error, malformed JSON');



Assert::throws(function() {
	Json::decode("\x00");
}, 'Nette\JsonException', 'Unexpected control character found');



if (PHP_VERSION_ID >= 50400) {
	// default JSON_BIGINT_AS_STRING
	Assert::same( array('12345678901234567890'), Json::decode('[12345678901234567890]') );
}
