<?php
/**
 *
 * @filesource   html.php
 * @created      21.12.2017
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode, QROptions};

require_once 'vendor/autoload.php';

header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>QRCode test</title>
	<style>
		body{
			margin: 5em;
			padding: 0;
		}
	</style>
</head>
<body>
	<div class="qrcode">
<?php

	$data = 'https://www.youtube.com/watch?v=DLzxrzFCyOs&t=43s';

	$options = new QROptions([
		'version'      => 10,
		'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
		'eccLevel'     => QRCode::ECC_H,
		'scale'        => 5,
		'imageBase64'  => false,
		'moduleValues' => [
			// finder
			1536 => [0, 63, 255], // dark (true)
			6    => [255, 255, 255], // light (false), white is the transparency color and is enabled by default
			5632 => [241, 28, 163], // finder dot, dark (true)
			// alignment
			2560 => [255, 0, 255],
			10   => [255, 255, 255],
			// timing
			3072 => [255, 0, 0],
			12   => [255, 255, 255],
			// format
			3584 => [67, 99, 84],
			14   => [255, 255, 255],
			// version
			4096 => [62, 174, 190],
			16   => [255, 255, 255],
			// data
			1024 => [0, 0, 0],
			4    => [255, 255, 255],
			// darkmodule
			512  => [0, 0, 0],
			// separator
			8    => [255, 255, 255],
			// quietzone
			18   => [255, 255, 255],
			// logo (requires a call to QRMatrix::setLogoSpace())
			20    => [255, 255, 255],
		],
	]);
	

	echo '<img src="'.(new QRCode)->render("hello world").'" />';

?>
	</div>
</body>
</html>
