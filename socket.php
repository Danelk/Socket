Socket Class

//定义服务端IP、端口
public $address = '127.0.0.1';
public $port = '10023';

protected function Socket($data){
//创建socket连接
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
\Yii::error("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n", 'sockect');
}
//socket进行连接
$result = socket_connect($socket, $this->address, $this->port);
if ($result === false) {
\Yii::error("socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error()) . "\n", 'sockect');
}
//发送
socket_write($socket, $data, strlen($data));
$out = '';
while ($out == '') {
//接收
$out = socket_read($socket, 2048);
}
//关闭socket连接
socket_close($socket);
//返回接收的数据
return $out;
}
