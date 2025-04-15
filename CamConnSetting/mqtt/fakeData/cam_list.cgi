<?php
// 設定認證資訊
$valid_username = "admin";
$valid_password = "1234";

// 檢查認證
if (!isset($_SERVER['PHP_AUTH_USER']) || 
    $_SERVER['PHP_AUTH_USER'] != $valid_username || 
    $_SERVER['PHP_AUTH_PW'] != $valid_password) {
    header('WWW-Authenticate: Basic realm="請輸入有效的帳號密碼"');
    header('HTTP/1.0 401 Unauthorized');
    echo '認證失敗，請輸入正確的帳號密碼';
    exit;
}

// 認證成功後顯示您的假資料
// 設定正確的內容類型，依據您實際需要的資料格式調整
header("Content-Type: application/json");

// 禁用快取，確保每次請求都獲取最新數據
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// 您的假資料
$fakeData = [
    "NvrName"=> "DESKTOP-fakeData",
	"NvrIP"=> "192.168.30.159",
    "CameraCount"=> 3,
    "Camera"=>
	[
		[
			"Channel"=> 10,
			"Uid"=> "bd58f642-aaab-4085-9fcf-030c3fa19e79",
			"Name"=> "N9012-BE",
			"IP"=> "192.168.30.100",
			"Username"=> "root",
			"Password"=> "root",
			"MainRTSP"=> 0,
			"SubRTSP"=> 0,
			"Recording"=> 0
		],
        [
			"Channel"=> 20,
			"Uid"=> "bd58f642-aaab-4085-9fcf-030c3fa19e80",
			"Name"=> "N9012-BE",
			"IP"=> "192.168.30.200",
			"Username"=> "root",
			"Password"=> "root",
			"MainRTSP"=> 0,
			"SubRTSP"=> 0,
			"Recording"=> 1
		],
        [
			"Channel"=> 30,
			"Uid"=> "bd58f642-aaab-4085-9fcf-030c3fa19e81",
			"Name"=> "N9012-BE",
			"IP"=> "192.168.30.300",
			"Username"=> "root",
			"Password"=> "root",
			"MainRTSP"=> 0,
			"SubRTSP"=> 0,
			"Recording"=> 1
		],
    ]
];

// 輸出 JSON 格式的資料
echo json_encode($fakeData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>