<?php

Swoole\Runtime::enableCoroutine();
// $serv = new \swoole_websocket_server("0.0.0.0", 9503);

$server = new Swoole\WebSocket\Server("0.0.0.0", 9503);


$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    echo "握手已经建立 fd{$request->fd}\n";
	
	$server->push($request->fd,'欢迎进入直播间，禁止不文明发言以及不合法言论!');
	
	//$close_resu = $server->disconnect($request->fd,1000,'测试一下，看能不能关闭!');
	// echo '关闭结果:'.$close_resu;
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
	
	$msg = '返回消息';
	
	// go(function(){
		
		// echo "协成输出\n";
		// $msg = '携程内更改';
		
		// $server->push($frame->fd, $msg);
	// });
	
	$client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
    $client->connect("0.0.0.0", 8888, 0.5);
    //调用connect将触发协程切换
    $client->send("hello world from swoole");
	
	echo "协成输出\n";
	$msg = '携程内更改';
	
    //调用recv将触发协程切换
    $ret = $client->recv();
    $response->header("Content-Type", "text/plain");
    $response->end($ret);
    $client->close();
	
	$server->push($frame->fd, $msg);
	
    
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});


 
/* 
//执行链接前的校验，不符合规则，定义为链接失败
$server->on('handshake', function (\swoole_http_request $request, \swoole_http_response $response) {
    // print_r( $request->header );
    // if (如果不满足我某些自定义的需求条件，那么返回end输出，返回false，握手失败) {
    //    $response->end();
    //     return false;
    // }
	 
		// 1/onHandShake事件回调是可选的
		// 2/设置onHandShake回调函数后不会再触发onOpen事件，需要应用代码自行处理
		// 3/onHandShake中必须调用response->status设置状态码为101并调用end响应, 否则会握手失败.
		// 4/内置的握手协议为Sec-WebSocket-Version: 13，低版本浏览器需要自行实现握手
	
    // websocket握手连接算法验证
    $secWebSocketKey = $request->header['sec-websocket-key'];
    $patten = '#^[+/0-9A-Za-z]{21}[AQgw]==$#';
    if (0 === preg_match($patten, $secWebSocketKey) || 16 !== strlen(base64_decode($secWebSocketKey))) {
        $response->end();
        return false;
    }
    echo $request->header['sec-websocket-key'];
    $key = base64_encode(sha1(
        $request->header['sec-websocket-key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11',
        true
    ));
    $headers = [
        'Upgrade' => 'websocket',
        'Connection' => 'Upgrade',
        'Sec-WebSocket-Accept' => $key,
        'Sec-WebSocket-Version' => '13',
    ];
    // WebSocket connection to 'ws://127.0.0.1:9502/'
    // failed: Error during WebSocket handshake:
    // Response must not include 'Sec-WebSocket-Protocol' header if not present in request: websocket
    if (isset($request->header['sec-websocket-protocol'])) {
        $headers['Sec-WebSocket-Protocol'] = $request->header['sec-websocket-protocol'];
    }
    foreach ($headers as $key => $val) {
        $response->header($key, $val);
    }
    // $response->status(101);
    $response->status(100);
    $response->end();
});
 */


$server->start();

go(function()
{
	
	
});


 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 