<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>監控系統設定</title>
    <style>
        /* body {
            font-family: "Microsoft JhengHei", Arial, sans-serif;
        } */
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
        .content-area {
            border: 1px solid #dee2e6;
            padding: 20px;
            min-height: 600px;
        }
        .table-header {
            background-color: #f8f9fa;
        }
        .table-container {
            display: none;
        }
        .table-container.active {
            display: block;
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
        
        /* .camera-item.selected {
            background-color:rgb(33, 29, 241);
        } */
        
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
        /* fieldset {
    border: 1px solid #dee2e6;
    padding: 1rem;
    border-radius: 0.25rem;
}
legend {
    width: auto;
    padding: 0 10px;
    margin-bottom: 0;
} */
    </style>
</head>
<body>
    <div class="container-fluid w-75 mt-5">
        <div class="row">
            <!-- 左側選單 -->
            <div class="col-2 sidebar border p-3">
                <h5 class="mb-3">系統設定</h5>
                <a href="#" class="active" id="HostSetting">錄影主機設定</a>
                <a href="#" id="CamSetting">攝影機設定</a>
            </div>
            
            <!-- 主要內容區域 -->
            <div class="col-10">
                <div class="content-area">
                    <!-- 錄影主機設定表格 -->
                    <div class="table-container active" id="hostTable">
                        <div class="d-flex flex-column mb-3">
                            <h5>錄影主機設定</h5>
                            <button class="btn btn-md btn-primary" style="width:100px;" onclick="hostBtn()">新增</button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                    <tr>
                                        <td>1</td>
                                        <td>192.168.30.100</td>
                                        <td>8080</td>
                                        <td>admin</td>
                                        <td>已連線</td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm" onclick="hostBtn(1)">編輯</button>
                                            <button class="btn btn-danger btn-sm" onclick="alertText()">刪除</button>
                                        </td>
                                    </tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- 攝影機設定表格 -->
                    <div class="table-container" id="camTable">
                        <div class="d-flex  flex-column mb-3">
                            <h5>攝影機設定</h5>
                            <button class="btn btn-md btn-primary" id="addCamBtn" style="width:100px;">新增</button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-secondary btn-sm" onclick="alarmsetting(id)">設定</button>
                                        </td>
                                    </tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                                </tbody>
                            </table>
                        </div>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="send(hostModal)">確認</button>
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
                        <div class="camera-list-panel h-100">
                            <h6>攝影機清單</h6>
                            <div id="camera-list" class="overflow-auto">
                            </div>
                        </div>
                        <div class="arrows-panel">
                            <div class="arrow">→</div>
                            <div class="arrow">←</div>
                        </div>
                        <div class="selected-cameras-panel h-100">
                            <h6>已選攝影機</h6>
                            <div id="selected-cameras" class="overflow-auto">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="action-buttons"> -->
                <div class="modal-footer">
                    <button class="btn btn-danger" id="reset-button" onclick="resetdata(camModal)">重置</button>
                    <button class="btn btn-primary" id="confirm-button" onclick="send(camModal)">確認</button>
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
                                <div class="cameraList border p-2 h-75 overflow-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="camera1">
                                        <label class="form-check-label" for="camera1">錄影機1</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="camera2">
                                        <label class="form-check-label" for="camera2">攝影機1</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="camera3">
                                        <label class="form-check-label" for="camera3">攝影機2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="applyBtn" class="btn btn-secondary">套用至</button>
                    <button id="reset" class="btn btn-danger" onclick="resetdata(alarmModal)">重置</button>
                    <!-- <button class="btn btn-primary" onclick="send(alarmSetting)">確認</button> -->
                    <button class="btn btn-primary" onclick="send(alarmModal)">確認</button>
                </div>
            </div>
            <!-- 套用至 -->
            <!-- <div class="modal-content" id="applyTo"> -->
                <!-- <div class="modal-header"> -->
                    <!-- <h5 class="modal-title">套用至</h5> -->
                <!-- </div> -->
                <!-- <div class="modal-body" style="height: 50vh;"> -->
                    <!-- <div class="cameraListCHK h-75">
                        <h5>攝影機清單</h5>
                        <div class="cameraList border h-100 p-2">
                            <input type="checkbox" id="camera1">
                            <label for="camera1">錄影機1</label><br>

                            <input type="checkbox" id="camera2">
                            <label for="camera2">攝影機1</label><br>

                            <input type="checkbox" id="camera3">
                            <label for="camera3">攝影機2</label><br>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="resetdata(applyTo)">重置</button>
                    <button class="btn btn-primary" onclick="">確認</button>
                </div>
            </div> -->
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
                    <p>您確定嗎？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confirmBtn">確認</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        var hostModal = new bootstrap.Modal(document.getElementById('hostModal'));
        var camModal = new bootstrap.Modal(document.getElementById('camModal'));
        var alarmModal = new bootstrap.Modal(document.getElementById('alarmModal'));
        var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
        var camerasData=[];
        // var camerasData= new Set();
        var selectedCameras = new Set();

        $(document).ready(function() {
            
            camerasData = [
                { id: 'cam01', name: 'AAA' },
                { id: 'cam02', name: 'BBB' },
                { id: 'cam03', name: 'CCC' },
                { id: 'cam04', name: 'DDD' },
                { id: 'cam05', name: 'EEE' },
                { id: 'cam06', name: 'FFF' },
                { id: 'cam07', name: 'GGG' },
                { id: 'cam08', name: 'HHH' },
                { id: 'cam09', name: 'III' },
                { id: 'cam10', name: 'JJJ' }
            ];

            renderCameraList(camerasData);
            renderSelectedCameras(selectedCameras);
        });

        
        $('#HostSetting').click(function() {
            $('.sidebar a').removeClass('active');
            $(this).addClass('active');
            $('.table-container').removeClass('active');
            $('#hostTable').addClass('active');
        });
        
        $('#CamSetting').click(function() {
            $('.sidebar a').removeClass('active');
            $(this).addClass('active');
            $('.table-container').removeClass('active');
            $('#camTable').addClass('active');
        });
        
        function alertText() {           
            alertModal.show();
        }

        function hostBtn(id = null){
            if(id){
                $('#hostModalLabel').text('編輯錄影主機');
            }else{
                $('#hostModalLabel').text('新增錄影主機');
                $('#hostSettingForm')[0].reset();
            }
            hostModal.show();
        }

        $("#addCamBtn").click(function() {
            selectedCameras.clear()
            renderSelectedCameras();
            camModal.show();
        });

        function renderCameraList(camerasData) {
            var cameraList = $('#camera-list');
            cameraList.empty();
            
            camerasData.forEach(camera => {
                var $item = $('<div>')
                    .addClass('camera-item')
                    .attr('data-id', camera.id)
                    .text(camera.name);
                
                cameraList.append($item);
            });
        }

        function renderSelectedCameras() {
            var selectedList = $('#selected-cameras');
            selectedList.empty();

            selectedCameras.forEach(cameraId => {
                var camera = camerasData.find(c => c.id === cameraId);

                if (camera) {
                    var $item = $('<div>')
                        .addClass('camera-item')
                        .attr('data-id', camera.id)
                        .text(camera.name);

                    selectedList.append($item);
                }
            });
        }

        $('#camera-list').on('click', '.camera-item', function() {
            const cameraId = $(this).data('id');

            if (!selectedCameras.has(cameraId)) {
                selectedCameras.add(cameraId);
                renderSelectedCameras();
            }
        });
        
        // 點擊已選攝影機清單中的項目
        $('#selected-cameras').on('click', '.camera-item', function() {
            const cameraId = $(this).data('id');
            selectedCameras.delete(cameraId);
            
            renderSelectedCameras();
        });
        

        function alarmsetting(id = null){
            alarmModal.show();
            $("#applyTo").hide();
            $("#applyBtn").show();
        }
        
        $("#applyBtn").on("click",function() {

            $("#applyTo").show();
            $("#applyBtn").hide();

        });
        
        function send(modelId) {           
            modelId.hide();
            resetdata(modelId)
        }

        function resetdata(modelId){
            switch (modelId) {
                case hostModal:
                    $('#hostSettingForm')[0].reset();
                    break;
                case camModal:
                    // renderCameraList();
                    selectedCameras.clear()
                    renderSelectedCameras();
                    break;
                // case alarmSetting:
                //     $('#objectDetection').prop('checked', false);
                //     $('#peopleCount').prop('checked', false);
                //     $('#pauseTime').val('');
                //     break;
                // case applyTo:
                //     $('.cameraList input[type="checkbox"]').prop('checked', false);
                //     break;
                case alarmModal:
                    $('#objectDetection').prop('checked', false);
                    $('#peopleCount').prop('checked', false);
                    $('#pauseTime').val('');
                    $('.cameraList input[type="checkbox"]').prop('checked', false);
                    break;
            
                default:
                    break;
            }
            
        }
    </script>
</body>
</html>