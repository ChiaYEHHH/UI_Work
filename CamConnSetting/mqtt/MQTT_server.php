<?php
require 'vendor/autoload.php';

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;

$server = '192.168.30.194';
$port = 1883;
$clientId = floor(microtime(true) * 1000);

try {
    $mqtt = new MqttClient($server, $port, $clientId);
    $mqtt->connect();

    // 要訂閱的多個主題
    $topics = [
        'AI/Server/Connected',
        'AI/Server/Update',
        'AI/Camera/Connected',
        'AI/Camera/Update',
        'AI/Alarm/Setting',
        'AI/Alarm/Update'
    ];

    echo "正在監聽以下 MQTT 主題：\n";
    foreach ($topics as $topic) {
        echo " - $topic\n";
        $mqtt->subscribe($topic, function ($topic, $message) use ($mqtt) {
            parsingMsg($mqtt, $topic, $message);
        }, 0);
    }

    $mqtt->loop(true);

    $mqtt->disconnect();
} catch (MqttClientException $e) {
    echo 'Exception caught: ',  $e->getMessage(), "\n";
}

function parsingMsg($mqtt, $topic, $message) {
    echo "[" . date("Y-m-d H:i:s") . "] 收到主題 [$topic] 的訊息: $message\n";
    $messageObj = json_decode($message);

    switch($topic){
        case "AI/Server/Connected": // WebToAI001
            $resTopic = 'Web/Server/Response'; // AIToWeb001
            $resMsg = [
                'CommandID' => $messageObj->CommandID,
                'ServerList' => [
                    ['SEQ'=> 1, 'IPAddress'=> '192.168.1.1', 'Port'=> 80, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 0],
                    ['SEQ'=> 2, 'IPAddress'=> '192.168.30.159', 'Port'=> 82, 'Account'=> 'admin', 'Password'=> '1234', 'Status'=> 1],
                    ['SEQ'=> 3, 'IPAddress'=> '192.168.30.194', 'Port'=> 8888, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 1]
                ],
            ];
            echo "回傳:\n";
            $jsonMsg = json_encode($resMsg);
            echo $jsonMsg."\n";
            $mqtt->publish($resTopic, $jsonMsg, 0);
            break;
        case "AI/Server/Update": // WebToAI002
            $resTopic = 'Web/Update/Response'; // AIToWeb004
            $resMsg = [
                'CommandID' => $messageObj->CommandID,
                'StatusCode' => 'ABC001',
                'Message' => '成功'
            ];
            echo "回傳:\n";
            $jsonMsg = json_encode($resMsg);
            echo $jsonMsg."\n";
            $mqtt->publish($resTopic, $jsonMsg, 0);
            break;
        case "AI/Camera/Connected": // WebToAI003
            $resTopic = 'Web/Camera/Response'; // AIToWeb002
            $resMsg = [
                'CommandID' => $messageObj->CommandID,
                'CameraList' => [
                    ['SEQ'=> 1, 'IPAddress'=> '192.168.1.1', 'RecordingServer'=> '192.168.30.194', 'Channel'=> 1, 'Port'=> 8888, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 1],
                    ['SEQ'=> 2, 'IPAddress'=> '192.168.1.2', 'RecordingServer'=> '192.168.30.159', 'Channel'=> 2, 'Port'=> 82, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 1],
                    ['SEQ'=> 3, 'IPAddress'=> '192.168.1.3', 'RecordingServer'=> 'NVR3', 'Channel'=> 3, 'Port'=> 82, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 0],
                    ['SEQ'=> 4, 'IPAddress'=> '192.168.1.4', 'RecordingServer'=> 'NVR4', 'Channel'=> 4, 'Port'=> 83, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 1],
                    ['SEQ'=> 5, 'IPAddress'=> '192.168.1.5', 'RecordingServer'=> 'NVR5', 'Channel'=> 5, 'Port'=> 84, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 0],
                    ['SEQ'=> 6, 'IPAddress'=> '192.168.1.6', 'RecordingServer'=> 'NVR6', 'Channel'=> 6, 'Port'=> 85, 'Account'=> 'root', 'Password'=> 'root', 'Status'=> 0],
                ],
            ];
            echo "回傳:\n";
            $jsonMsg = json_encode($resMsg);
            echo $jsonMsg."\n";
            $mqtt->publish($resTopic, $jsonMsg, 0);
            break;
        case "AI/Camera/Update": // WebToAI004
            $resTopic = 'Web/Update/Response'; // AIToWeb004
            $resMsg = [
                'CommandID' => $messageObj->CommandID,
                'StatusCode' => 'ABC001',
                'Message' => '成功'
            ];
            echo "回傳:\n";
            $jsonMsg = json_encode($resMsg);
            echo $jsonMsg."\n";
            $mqtt->publish($resTopic, $jsonMsg, 0);
            break;
        case "AI/Alarm/Setting": // WebToAI005
            $CameraList = [
                    ['SEQ'=> 1, 'Object'=> ['Mode'=> 1, 'StayTime'=> 10], 'PeopleCount'=> ['Mode'=> 0]],
                    ['SEQ'=> 2, 'Object'=> ['Mode'=> 0, 'StayTime'=> 15], 'PeopleCount'=> ['Mode'=> 1]],
                    ['SEQ'=> 3, 'Object'=> ['Mode'=> 0, 'StayTime'=> 25], 'PeopleCount'=> ['Mode'=> 1]],
                    ['SEQ'=> 4, 'Object'=> ['Mode'=> 0, 'StayTime'=> 35], 'PeopleCount'=> ['Mode'=> 1]],
                    ['SEQ'=> 5, 'Object'=> ['Mode'=> 1, 'StayTime'=> 45], 'PeopleCount'=> ['Mode'=> 0]],
                    ['SEQ'=> 6, 'Object'=> ['Mode'=> 1, 'StayTime'=> 55], 'PeopleCount'=> ['Mode'=> 0]]
            ];
            $list = $messageObj->CameraList;
            $cam = null;
                    
            foreach ($CameraList as $camItem) {
                if (in_array($camItem['SEQ'], $list)) {
                    $cam = $camItem;
                    break; // 如果只取一筆就可以中斷
                }
            }
            $resTopic = 'Web/Alarm/Response'; // AIToWeb003
            $resMsg = [
                'CommandID' => $messageObj->CommandID,
                'CameraList' => $cam,
            ];
            echo "回傳:\n";
            $jsonMsg = json_encode($resMsg);
            echo $jsonMsg."\n";
            $mqtt->publish($resTopic, $jsonMsg, 0);
            break;
        case "AI/Alarm/Update": // WebToAI006
            $resTopic = 'Web/Update/Response'; // AIToWeb004
            $resMsg = [
                'CommandID' => $messageObj->CommandID,
                'StatusCode' => 'ABC001',
                'Message' => '成功'
            ];
            echo "回傳:\n";
            $jsonMsg = json_encode($resMsg);
            echo $jsonMsg."\n";
            $mqtt->publish($resTopic, $jsonMsg, 0);
            break;
    }
    echo "\n\n";
}
