<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>監控系統設定</title>
    <style>
        .sidebar {
            min-height: 600px;
        }
        a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            color: #212529;
            margin-bottom: 5px;
        }
        a.active {
            border-bottom:5px double #0d6efd;
            color: black;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        .form-label {
            font-weight: 500;
        }
        .camera-list-panel, .selected-cameras-panel {
            border: 1px solid #333;
            width: 45%;
            padding: 10px;
            height: 20vh;
        }
    </style>
</head>
<body>
    <div class="container-fluid w-75 mt-5">
        <div class="row">
            <!-- 左側選單 -->
            <div class="col col-2">
			    <?php include_once("sidebar.php");?>
            </div>
            <!-- 主要內容 -->
            <div class="col col-10">
                <!-- 錄影主機設定表格 -->
                <div class="table-container border h-100 p-3">
                    <div class="d-flex flex-column mb-3">
                        <h5>錄影主機設定</h5>
                        <button class="btn btn-md btn-primary" style="width:100px;" onclick="hostBtn()">新增</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="hostTable">
                            <thead>
                                <tr class="table-header">
                                    <th>序號</th>
                                    <th>IP位址</th>
                                    <th>連線埠</th>
                                    <th>連線帳號</th>
                                    <th>連線狀態</th>
                                    <th>動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>1</td>
                                    <td>192.168.30.100</td>
                                    <td>8080</td>
                                    <td>admin</td>
                                    <td>已連線</td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" onclick="hostBtn(id)">編輯</button>
                                        <button class="btn btn-danger btn-sm" onclick="alertText()">刪除</button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 新增/編輯錄影主機的 Modal -->
    <div class="modal fade" id="hostModal" tabindex="-1" aria-labelledby="hostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hostModalLabel">新增錄影主機</h5>
                </div>
                <div class="modal-body">
                    <form id="hostSettingForm">
                        <input type="hidden" id="action">
                        <input type="hidden" id="SEQ">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="hostIp" class="form-label">錄影主機IP</label>
                                <input type="text" class="form-control" id="hostIp">
                            </div>
                            <div class="col-md-6">
                                <label for="hostPort" class="form-label">連線埠號</label>
                                <input type="text" class="form-control" id="hostPort">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="account" class="form-label">連線帳號</label>
                                <input type="text" class="form-control" id="account">
                            </div>
                            <div class="col-md-6">
                                <label for="pwd" class="form-label">連線密碼</label>
                                <input type="password" class="form-control" id="pwd">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary" onclick="sendHost()">確認</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 彈跳視窗 Alert -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">提示</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden">
                    
                    <p>您確定要刪除 序號<span id="delSEQ"></span> 嗎？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="confirmBtn" onclick="del(id)">確認</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/mqtt.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/mqtt.js"></script>
    <script>
        // let ip = "192.168.30.194";
        // let port = "1884";
        // let SubscribeTxt = "Web/Server/Response";
        // let Topic = "AI/Server/Connected";
        // let CommandID = $.now();
        // let message = '{"CommandID":' + CommandID + '}';
        // let ServerList = "";
        // let hostList = [];
        // let MQTTClient = mqtt.connect("ws://" + ip + ":" + port);

        // MQTTClient.on('connect', function () {
        // console.log('MQTT Connection OK');
        //     Subscribe();
        // });

        // MQTTClient.on('reconnect', function () {
        // console.log('MQTT Reconnecting...');
        // });

        // MQTTClient.on('close', function () {
        //     console.log('MQTT Disconnected');
        // })

        // MQTTClient.on('error', function (error) {
        //     console.log('MQTT error', error);
        // })

        // MQTTClient.on("message", function (topic, payload, packet) {
        //     let msg = JSON.parse(payload.toString());
        //     // console.log("message",msg);
        //     // 不是自己則跳過
        //     if(msg.CommandID != CommandID){
        //         return;
        //     }
            
        //     switch(topic){
        //         case "Web/Server/Response": // AIToWeb001
        //             ServerList = msg.ServerList;
        //             console.log("ServerList",typeof ServerList);
        //             localStorage.setItem("ServerList", JSON.stringify(ServerList));
        //             break;
        //         case "Web/Update/Response": // AIToWeb004
        //             console.log("Web/Update/Response",msg);
                    
        //             break;
        //     }
        // });

        // function Subscribe(){
        //     console.log("SubscribeTxt",SubscribeTxt);
        // 	MQTTClient.subscribe(SubscribeTxt);
        // }

        // function Send(){
        //     console.log("message",message);
        // 	MQTTClient.publish(Topic, message);
        // }

    </script>
    <script>
        $(document).ready(function(){
            $('#CamSetting').removeClass('active');
            $("#hostSetting").addClass('active');

            // mqtt
            SubscribeTxt = "Web/Server/Response";
            Topic = "AI/Server/Connected";
            Subscribe();
            Send();
        });

        // mqtt返回
        function initHostTable(){
            ServerList.forEach(server => {
                $("#hostTable tbody").append(`
                    <tr>
                        <td>${server.SEQ}</td>
                        <td>${server.IPAddress}</td>
                        <td>${server.Port}</td>
                        <td>${server.Account}</td>
                        <td>${(server.Status == 1)? "連線":""}</td>
                        <td>
                            <button class="btn btn-secondary btn-sm" onclick="hostBtn(${server.SEQ})">編輯</button>
                            <button class="btn btn-danger btn-sm" onclick="waringTxt(${server.SEQ})">刪除</button>
                        </td>
                    </tr>
                `);
            });
        }

        // hostModal
        function hostBtn(id = null){
            if(id){  // 編輯
                $("#action").val("edit");
                $("#SEQ").val(id);
                $('#hostModalLabel').text('編輯錄影主機');
                const host = ServerList.find(item => item.SEQ === id);
                if (!host) {
                    alert("找不到該主機資訊");
                    return;
                }

                // 將資料填入欄位
                $("#hostIp").val(host.IPAddress);
                $("#hostPort").val(host.Port);
                $("#account").val(host.Account);
                $("#pwd").val(host.Password);
            }else{  // 新增
                $('#hostSettingForm')[0].reset();
                $("#action").val("add");
                $("#SEQ").val("");
                $('#hostModalLabel').text('新增錄影主機');
            }
            $("#hostModal").modal("show");
        }

        function sendHost() {
            //{"CommandID":"001","ServerList":[{"SEQ":1,"IPAddress":"192.168.1.1","Port":80,"Account":"root","Password":"root"}]}   
            Topic = "AI/Server/Update";
            SubscribeTxt = "Web/Update/Response";
            let serverData = {
                IPAddress: $("#hostIp").val(),
                Port: $("#hostPort").val(),
                Account: $("#account").val(),
                Password: $("#pwd").val()
            };

            if ($("#action").val() === "edit") {
                serverData.SEQ = $("#SEQ").val();
            }

            let messageObj = {
                CommandID: CommandID,
                ServerList: [serverData]
            };
            $("#hostModal").modal("hide");
            let message = JSON.stringify(messageObj);
            console.log("messageSent",message);
            Subscribe();
            Send();
            $('#hostSettingForm')[0].reset();
        }

        // alertModal
        function waringTxt(id) {           
            // $("#delSEQ").val(id);
            $("#delSEQ").text(id);
            $("#alertModal").modal("show");
        }

        function del(id) {
            // $('#hostSettingForm')[0].reset();
        }

        // function resetdata(){
        //     $('#hostSettingForm')[0].reset();            
        // }

    </script>
</body>
</html>