<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="bootstrap/js/bootstrap.js" rel="stylesheet"> -->
    <!-- <link href="bootstrap/js/bootstrap.min.js" rel="stylesheet"> -->
    <style>
        *{
            box-sizing: bordr-box;
        }
        .photo-container {
            border: 1px solid #000;
            min-height: 300px;
            padding: 10px;
        }
        .arrow-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .arrow {
            color: #0a5275;
            font-size: 1.5rem;
            margin: 10px 0;
        }
        .border-container {
            border: 1px solid #000;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .checkbox-group {
            margin: 15px 0;
        }
        .input-group {
            margin: 15px 0;
        }
        #main{
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex">

        <div class="container d-flex border border-2 m-5 w-75" id="main">
    
            <div class="d-flex flex-column sidebar border m-3 p-2" id="sidebar" style="height: 80vh;width:15%;border:1px black;">
                <a href="">Host Settings</a>
                <a href="">Camera Settings</a>
            </div>
            <div class="d-flex flex-column content m-3 pt-2 w-100" id="contentHost" style="height: 80vh;">
                <label>Host Settings</label>
                <div class="container border p-2 h-100"  style="weight:80%;">
                    <button type="button" class="m-2">新增</button>
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                            <td>序號</td>
                            <td>IP位置</td>
                            <td>連線埠號</td>
                            <td>連線帳號</td>
                            <td>連線狀態</td>
                            <td>動作</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="m-1">編輯</button>
                                <button class="m-1">刪除</button>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex flex-column content m-3 p-2 w-100 d-none" id="contentCamera" style="height: 80vh; width:80%;">
                <label>Camera Settings</label>
                <div class="border p-2"  style="width:80%;">
                    <button type="button" class="m-2">編輯</button>
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                            <td>序號</td>
                            <td>IP位址</td>
                            <td>所屬錄影主機</td>
                            <td>頻道</td>
                            <td>連線帳號</td>
                            <td>連線狀態</td>
                            <td>動作</td>
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
                                <button class="m-1">設定</button>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modalHost justify-content-center w-50 p-2 border" id="ModalList" tabindex="-1" aria-labelledby="ModalAction" aria-hidden="">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header p-5 pb-0">
					<h1 class="modal-title fs-3 fw-bold" id="ModalAction">新增錄影主機</h1>
				</div>
				<div class="modal-body p-5 pt-3">
                <form action="" method="post" class="p-2">
                    <div class="container list border">
                        <label class=" p-2"><span id="action"></span>錄影主機</label>
                        <div class="row  flex-nowrap">
                            <div class="input-group col mb-3">
                              <label for="IPHost" class="col-form-label">錄影主機IP</label>
                              <input type="text" class="form-control" id="IPHost">
                            </div>
                            <div class="input-group col mb-3">
                              <label for="account" class="col-form-label">連線帳號</label>
                              <input class="form-control" id="account" rows="3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group col mb-3">
                              <label for="IPHost" class="col-form-label">通訊埠號</label>
                              <input type="text" class="form-control" id="IPHost">
                            </div>
                            <div class="input-group col mb-3">
                              <label for="pwd" class="col-form-label">連線密碼</label>
                              <input class="form-control" id="account" rows="3">
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="button">取消</button>
                            <button type="button">確認</button>
                        </div>

                    </div>
                </form>
				</div>
				<div class="modal-footer flex-nowrap justify-content-center">
					<button type="button" class="btn w-25" data-bs-dismiss="modal">取消</button>
					<button type="submit" class="btn w-25" form="addForm">新增</button>
				</div>
			</div>
		</div>		
	</div>
    <div class="modaldCamera d-flex justify-content-center" style="width:80%;">
        <div class="card-header">
            <h5 class="mb-0">攝影機照片搜尋界面</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <h6 class="text-center mb-2">攝影機清單</h6>
                    <div class="photo-container">
                       
                    </div>
                </div>
                <div class="col-2 arrow-container">
                    <div class="arrow">&#8594;</div>
                    <div class="arrow">&#8592;</div>
                </div>
                <div class="col-5">
                    <h6 class="text-center mb-2">已選攝影機</h6>
                    <div class="photo-container"></div>
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="button" class="me-2">重置</button>
                <button type="button" >確認</button>
            </div>
        </div>
    </div>
    <div class="modalCameraList container mt-4 w-25">
        <div class="border-container" id="alertSettings">
            <h5 class="mb-4">警報設定</h5>
            
            <div class="checkbox-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="objDetection">
                    <label class="form-check-label" for="objDetection">物件偵測</label>
                </div>
            </div>
            
            <div class="input-group">
                <label for="stopTime" class="me-2">停留時間</label>
                <input type="text" class="form-control w-25" id="stopTime">
                <span class="ms-2">秒</span>
            </div>
            
            <div class="checkbox-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="peopleCount">
                    <label class="form-check-label" for="peopleCount">人流計算</label>
                </div>
            </div>
            
            <div class="text-end mt-3">
                <button type="button" class="me-2" id="applyTo">套用至</button>
                <button type="button" class="me-2" id="reset">重置</button>
                <button type="button" id="confirm">確認</button>
            </div>
        </div>
        
        <!-- 第二個頁面 - 套用至 -->
        <div class="border-container" id="applyToPage" style="display: none;">
            <h5 class="mb-4">套用至</h5>
            
            <div class="border p-3">
                <h6 class="mb-3">攝影機清單</h6>
                
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="mainCamera">
                    <label class="form-check-label" for="mainCamera">錄影主機1</label>
                </div>
                
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="camera1">
                    <label class="form-check-label" for="camera1">攝影機1</label>
                </div>
                
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="camera2">
                    <label class="form-check-label" for="camera2">攝影機2</label>
                </div>
                
                <div class="text-center my-2">⋮</div>
            </div>
            
            <div class="btn-group mt-3">
                <button type="button" class="btn btn-outline-secondary" id="resetApply">重置</button>
                <button type="button" class="btn btn-outline-primary" id="confirmApply">確認</button>
            </div>
        </div>
    </div>
    <!-- bootstrap -->
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>

    </script>
</body>
</html>