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
            /* border-right: 1px solid #dee2e6; */
        }
        .sidebar a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            color: #212529;
            margin-bottom: 5px;
        }
        .sidebar a.active {
            /* background-color: #0d6efd; */
            /* border-radius: 4px; */
            
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

        /* .selection-panel {
            display: flex;
            justify-content: space-between;
        } */
        
        .camera-list-panel, .selected-cameras-panel {
            border: 1px solid #333;
            width: 45%;
            padding: 10px;
            height: 20vh;
        }
        
        h6 {
            margin-top: 0;
            text-align: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        
        .camera-item {
            padding: 3px;
            margin: 5px 0;
            cursor: pointer;
        }
        
        .camera-item:hover {
            background-color: #f0f0f0;
        }
        
        .camera-item.selected {
            background-color:rgb(33, 29, 241);
        }
        
        .arrows-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .arrow {
            margin: 10px;
            width: 40px;
            height: 55px;
            font-size: 40px;
            color: #337ab7;
        }
        
        /* .action-buttons {
            text-align: right;
        } */
        
        .action-button {
            padding: 8px 16px;
            margin-left: 10px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .action-button:hover {
            background-color: #e7e7e7;
        }

        .serverLabel{
            /* bg-primary text-white text-center py-1 */
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 0.5rem 0;
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
                <!-- 攝影機設定表格 -->
                <div class="table-container border h-100 p-3">
                    <div class="d-flex flex-column mb-3">
                        <h5>攝影機設定</h5>
                        <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#camModal" onclick="initCameraList()" style="width:100px;">編輯</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="camTable">
                            <thead>
                                <tr class="table-header">
                                    <th>序號</th>
                                    <th>IP位址</th>
                                    <th>所屬錄影主機</th>
                                    <th>頻道</th>
                                    <th>連線帳號</th>
                                    <th>連線狀態</th>
                                    <th>動作</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 新增錄影機設定 Modal -->
    <div class="modal fade" id="camModal" tabindex="-1" aria-labelledby="camModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="camModalLabel">新增攝影機清單</h5>
                </div>
                <div class="model-body">
                    <div class="selection-panel my-4 d-flex justify-content-between" style="height:50vh;">
                        <div class="camera-list-panel h-100 d-flex flex-column">
                            <h6 class="bg-white py-2">攝影機清單</h6>
                            <div id="camera-list" class="overflow-auto d-flex flex-column gap-2 flex-grow-1">
                            </div>
                        </div>
                        <div class="arrows-panel">
                            <div class="arrow">→</div>
                            <div class="arrow">←</div>
                        </div>
                        <div class="selected-cameras-panel h-100 d-flex flex-column">
                            <h6 class="bg-white py-2">已選攝影機</h6>
                            <div id="selected-cameras" class="overflow-auto d-flex flex-column gap-2 flex-grow-1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="initCameraList()">重置</button>
                    <button class="btn btn-primary" data-bs-dismiss="modal" onclick="chkList()">確認</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 警報設定模態框 -->
    <div class="modal fade" id="alarmModal" tabindex="-1" aria-labelledby="alarmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alarmModalLabel">警報設定</h5>
                </div>
                <div class="row modal-body d-flex " style="height: 50vh;">
                    <div id="alarmSetting" class="col col-6 d-flex flex-column ps-5">
                        <input type="hidden" id="SEQ">
                        <div class="checkbox-group">
                            <input type="checkbox" id="objectDetection">
                            <label for="objectDetection">物件偵測</label>
                            <div class="form-group">
                                <label for="pauseTime">停留時間</label>
                                <input type="text" id="pauseTime" style="width: 80px;">
                                <span>秒</span>
                            </div>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="peopleCount">
                            <label for="peopleCount">人流計算</label>
                        </div>
                    </div>
                    <div id="applyTo" class="col col-5 h-100">
                        <div class="card h-100">
                            <div class="card-header">套用至</div>
                            <div class="card-body">
                                <h5 class="card-title">攝影機清單</h5>
                                <div class="border p-2 h-75 overflow-auto" id="applyToCam">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="applyBtn" class="btn btn-secondary">套用至</button>
                    <button id="reset" class="btn btn-danger" onclick="initAlarmModel()">重置</button>
                    <button class="btn btn-primary" data-bs-dismiss="modal" onclick="sendAlarm()">確認</button>
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
        // let Topic = "AI/Camera/Connected";
        // let SubscribeTxt = "Web/Camera/Response";
        // let camerasData = "";
        // let camSetting = "";
        // let setting = {};
        // let MQTTClient = mqtt.connect("ws://" + ip + ":" + port);

        // MQTTClient.on('connect', function () {
        //     console.log('MQTT Connection OK');
        //     Subscribe();
        // });

        // MQTTClient.on('reconnect', function () {
        //     console.log('MQTT Reconnecting...');
        // });

        // MQTTClient.on('close', function () {
        //     console.log('MQTT Disconnected');
        // })

        // MQTTClient.on('error', function (error) {
        //     console.log('MQTT error', error);
        // })

        // MQTTClient.on("message", function (topic, payload, packet) {
        //     let msg = JSON.parse(payload.toString());
        //     if(msg.CommandID != CommandID){
        //         return;
        //     }
            
        //     switch(topic){
        //         case "Web/Camera/Response": // AIToWeb002
        //             camerasData = msg.CameraList;
        //             initCamTable();
        //             break;
        //         case "Web/Update/Response": // AIToWeb004
        //             console.log("Web/Update/Response",msg);
        //             break;
        //         case "Web/Alarm/Response": // AIToWeb005
        //             camSetting = msg.CameraList;
        //             alarmData();
        //             break;
        //     }
        // });

        // function Subscribe(){
        //     MQTTClient.subscribe(SubscribeTxt);
        //     console.log('MQTT Subscribe OK',SubscribeTxt);
        // }

        // function Send(){
        // 	MQTTClient.publish(Topic, message);
        //     console.log('MQTT Send OK',Topic,message);
        // }

    </script>
    <script>
        $(document).ready(function() {
            $('#HostSetting').removeClass('active');
            $('#CamSetting').addClass('active');
            
            // mqtt
            Topic = "AI/Camera/Connected";
            SubscribeTxt = "Web/Camera/Response";
            Subscribe();
            Send();
        });
        
        // mqtt返回
        function initCamTable(){
            camerasData.forEach(camera => {
                if (camera.Status === 1) {
                    const camData = `
                        <tr>
                            <td>${camera.SEQ}</td>
                            <td>${camera.IPAddress}</td>
                            <td>${camera.RecordingServer}</td>
                            <td>${camera.Channel}</td>
                            <td>${camera.Account}</td>
                            <td>${(camera.Status == 1)? "連線":""}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#alarmModal"  onclick="alarmsetting(${camera.SEQ})">設定</button>
                            </td>
                        </tr>
                    `;
                    $('#camTable tbody').append(camData);
                }
            });
        }

        // camModal
        function initCameraList() {
            $('#camera-list').empty();
            $('#selected-cameras').empty();
            ServerList = (localStorage.getItem("ServerList"));
            let camListArr = [];
            $.ajax({
                url: 'CUI/fetch_json.php',
                type: 'Post',
                contentType: 'application/json',
                data : ServerList,
                success: function(res) {
                    res.forEach(serverData => {
                        if(serverData.status == 200){
                            server = serverData.response;
                            const $serverLabel = $('<label>')
                                .addClass('serverLabel')
                                .attr('data-name', server.NvrName)
                                .text(server.NvrIP);
    
                            $('#camera-list').append($serverLabel);

                            const camerasList = server.Camera;
                            camerasList.forEach(camera => {
                                const $cameraItem = $('<div>')
                                    .addClass('camera-item')
                                    .attr('data-host', server.NvrName)
                                    .attr('data-seq', camera.Channel)
                                    .attr('data-select', camera.Recording === 1 ? 'true' : 'false')
                                    .text(camera.IP);
                                // 將攝影機項目添加到容器
                                $('#camera-list').append($cameraItem);
                            });
                        }
                    });
                    showSelectedList();
                },
                error: function(xhr, status, error) {
                    console.error('錯誤詳情:', xhr.responseText);
                }
            });
        }

        // 顯示已選列表的函數
        function showSelectedList() {
            $('#selected-cameras').empty();
            var hostGroups = {};
            $('#camera-list [data-select="true"]').each(function() {
                var hostName = $(this).data('host');
                if (!hostGroups[hostName]) {
                    var label = $('#camera-list label[data-name="' + hostName + '"]');
                    hostGroups[hostName] = {
                        label: label.clone(),
                        items: []
                    };
                }
                hostGroups[hostName].items.push($(this).clone());
            });

            $.each(hostGroups, function(hostName, group) {
                group.label.appendTo('#selected-cameras');
                $.each(group.items, function(i, item) {
                    item.appendTo('#selected-cameras');
                });
            });
            // $('#camera-list [data-select="true"]').clone().appendTo('#selected-cameras');
        }

        $('#camera-list').on('click', '.camera-item', function() {
            const isSelected = $(this).attr('data-select') === 'true';
            // data-select toggle
            $(this).attr('data-select', isSelected ? 'false' : 'true');

            showSelectedList();
        });

        $('#selected-cameras').on('click', '.camera-item', function() {
            const seq = $(this).attr('data-seq');
            $(`#camera-list [data-seq="${seq}"]`).attr('data-select', 'false');
            
            showSelectedList();
        });

        // 關閉camModal 清除資料
        $('#camModal').on('hidden.bs.modal', function (event) {
            $('#camera-list').empty();
            $('#selected-cameras').empty();
        });

        function chkList() {
            Topic = "AI/Camera/Update";
            SubscribeTxt = "Web/Update/Response";
            let selectedSeqs = [];
            $('#camera-list [data-select="true"]').each(function() {
                selectedSeqs.push($(this).attr('data-seq'));
            });

            camerasData.forEach(cam => cam.Status = 0);
            camerasData.forEach(cam => {
                if (selectedSeqs.includes(cam.SEQ.toString())) {
                    cam.Status = 1;
                }
            });
            let messageObj = {
                CommandID: CommandID,
                CameraList: [camerasData]
            };
            message = JSON.stringify(messageObj);
            console.log("chkList",message);
            Subscribe();
            Send();
            // camModal.hide();
        }

        // alarmModal
        function alarmsetting(id){
            $('#applyToCam').empty();
            Topic = "AI/Alarm/Setting";
            SubscribeTxt = "Web/Alarm/Response";
            $("#SEQ").val(id);
            let messageObj = {
                CommandID: CommandID,
                CameraList: [id]
            };

            message = JSON.stringify(messageObj);
            console.log("alarmsetting",message);
            Subscribe();
            Send();
        }

        function alarmData(){
            initAlarmModel();
            // alarmModal.show();
            $("#applyTo").hide();
            $("#applyBtn").show();
        }

        function initAlarmModel(){
            resetdata(alarmModal);
            let id = $("#SEQ").val();
            
            if(id == camSetting.SEQ){
                detecMode = (camSetting.Object.Mode == 1)? true:false;
                pauseTime = camSetting.Object.StayTime;
                peopleCount = (camSetting.PeopleCount.Mode == 1)? true:false;
                
                $("#pauseTime").val(pauseTime);
                $("#objectDetection").prop("checked", detecMode);
                $("#peopleCount").prop("checked", peopleCount);
            }
        }
        
        $("#applyBtn").on("click",function() {
            let id = $("#SEQ").val();
            camerasData.forEach(camera => {
                const isChecked = (id == camera.SEQ) ? 'checked' : '';
                const checkboxHTML = `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="camera${camera.SEQ}" data-seq="${camera.SEQ}" ${isChecked}>
                        <label class="form-check-label" for="camera${camera.SEQ}">${camera.IPAddress}</label>
                    </div>
                `;
                $("#applyToCam").append(checkboxHTML);
            });
            $("#applyTo").show();
            $("#applyBtn").hide();
        });
        


        function sendAlarm(){
            Topic = "AI/Camera/Update";
            SubscribeTxt = "Web/Update/Response";
            let cameraSettings = [];

            $('#applyToCam input[type="checkbox"]:checked').each(function () {
                const seq = $(this).data('seq');            
                cameraSettings.push({
                    SEQ: seq,
                    Object: {
                        Mode: $('#objectDetection').prop('checked') ? 1 : 0,
                        StayTime: $('#pauseTime').val()
                    },
                    PeopleCount: {
                        Mode: $('#peopleCount').prop('checked') ? 1 : 0
                    }
                });
            });
            let messageObj = {
                CommandID: CommandID,
                CameraList: cameraSettings
            };
            
            // alarmModal.hide();
            message = JSON.stringify(messageObj);
            // console.log("sendAlarm",message);
            Subscribe();
            Send();
        }

        function resetdata(modelId){
            switch (modelId) {
                case alarmModal:
                    $('#objectDetection').prop('checked', false);
                    $('#peopleCount').prop('checked', false);
                    $('#pauseTime').val('');
                    $('#applyToCam input[type="checkbox"]').prop('checked', false);
                    break;
            
                default:
                    break;
            }
            
        }
    </script>
    
</body>
</html>