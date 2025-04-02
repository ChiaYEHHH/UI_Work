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
        .content-area {
            border: 1px solid #dee2e6;
            padding: 20px;
            min-height: 600px;
        }
        .table-header {
            background-color: #f8f9fa;
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
                <div class="table-container border p-3" id="hostTable">
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
                                    <button type="button" class="btn btn-primary" onclick="send()">確認</button>
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
                                    <p>您確定嗎？</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <button type="button" class="btn btn-primary" id="confirmBtn" onclick="del(id)">確認</button>
                                </div>
                            </div>
                        </div>
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
        var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));

        $(document).ready(function(){
            $('#CamSetting').removeClass('active');
            $("#hostSetting").addClass('active');

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

        function send() {           
            hostModal.hide();
            $('#hostSettingForm')[0].reset();
        }

        function del(id) {           
            hostModal.hide();
        }

        function resetdata(){
            $('#hostSettingForm')[0].reset();            
        }

    </script>
    
</body>
</html>