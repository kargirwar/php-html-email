<?php
require 'vendor/autoload.php';
main();
function main()
{
	$from = new SendGrid\Email("Example User", "xxx@xxx.xxx");
	$subject = "Sending with SendGrid is Fun";
	$to = new SendGrid\Email("Example User", "xxx@xxx.com");
	$content = new SendGrid\Content("text/html", getContent());
	$mail = new SendGrid\Mail($from, $subject, $to, $content);
	$apiKey = getenv('SENDGRID_API_KEY');
	$sg = new \SendGrid($apiKey);
	$response = $sg->client->mail()->send()->post($mail);
	echo $response->statusCode();
	print_r($response->headers());
	echo $response->body();
}

function getContent()
{
	$pug = new \Pug\Pug([
		'basedir' => __DIR__ . '/templates',
	]);
	return $pug->renderFile('mail.pug', [
		'name' => "Example User",
		'data' => [
			['c1' => 'v11', 'c2' => 'v12', 'c3' => 'v13', 'c4' => 'v14'],
			['c1' => 'v21', 'c2' => 'v22', 'c3' => 'v23', 'c4' => 'v24'],
		]
	]);
}
