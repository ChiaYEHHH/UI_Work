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