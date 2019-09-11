 
<?php

Swoole\Runtime::enableCoroutine();
$serv = new swoole_http_server("0.0.0.0", 9503, SWOOLE_BASE);



$serv->on('request', function(swoole_http_request $request, swoole_http_response $response) {

	$str = $request->getData();
	$response->end($str);
	
	
	
});


$serv->start();