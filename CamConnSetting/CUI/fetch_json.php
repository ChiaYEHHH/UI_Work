
<?php
header('Content-Type: application/json');

// 防止緩存
header('Cache-Control: no-cache, must-revalidate');
header('Expires: 0');
http_response_code(200);
$serverList = file_get_contents("php://input");
$serverListArr = json_decode($serverList, true);
// $results[] = "";
$results = [];
// echo json_encode($serverListArr);

// // 如果需要調試信息，將其添加到響應數據中
// $response = [
//     'status' => 'success',
//     'original_data' => $json_data,
//     'data_type' => gettype($decoded_data),
//     'parsed_data' => $decoded_data
// ];

// // 返回純 JSON 響應
// echo json_encode($response);
// $results = [];
// $hasErrors = false;

// foreach ($serverListArr as $key => $source) {
//     // $Ip = "192.168.30.194:8888";
//     $Ip = $source['IPAddress'].':'.$source['Port'];
//     $url = "http://$Ip/cam_list.cgi";
//     $result = fetchData(
//         $url,
//         $source['Account'],
//         $source['Password']
//     );
    
//     if (empty($result['error']) && $result['status'] == 200) {
//         $results[$key] = json_decode($result['response'], true);
//     } else {
//         $results[$key] = [
//             'error' => $result['error'] ?: "HTTP error: {$result['status']}",
//             'status' => $result['status']
//         ];
//         $hasErrors = true;
//     }
// }
// foreach ($serverListArr as $key => $source) {
foreach ($serverListArr as  $source) {
    // $Ip = "192.168.30.194:8888";
    $Ip = $source['IPAddress'].':'.$source['Port'];
    $url = "http://$Ip/cam_list.cgi";
    $result = fetchData(
        $url,
        $source['Account'],
        $source['Password']
    );
    
    // if (empty($result['error'])) {
    // if (empty($result['error']) && $result['status'] == 200) {
        // $results[] = json_decode($result['response'], true);
        $results[] = $result;
        // $results = [
        //     'response' => $result['response'],
        //     'status' => $result['status']
        // ];
        // $results[] = [  'server' => $result['response'],
        //                 'status' => $result['status']
        //     ];
    // } else {
    //     $results[] = [  'error' => $result['error'] ?: "HTTP error: {$result['status']}",
    //                     'status' => $result['status']
    //     ];
        // $results[] = [
        //     'error' => $result['error'] ?: "HTTP error: {$result['status']}",
        //     'status' => $result['status']
        // ];
        // $hasErrors = true;
    // }
}

// 返回組合後的結果
echo json_encode($results);

function fetchData($url, $username = '', $password = '') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // 設定超時時間為 2 秒
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);  // 總超時時間
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);  // 連接超時時間
    
    if (!empty($username) && !empty($password)) {
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    }

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // $result
    return [
        'response' => json_decode($response, true),
        'error' => $error,
        'status' => $status
    ];
    
}


// 設定目標 URL

// $Ip = "192.168.30.194:8888";
// $url = "http://$Ip/cam_list.cgi";
// $username = "root";
// $password = "root";

?>