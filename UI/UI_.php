<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            box-sizing:border-box:
            
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-info">
        <div class="container border mt-5 bg-warning" id="main" style="height: 80vh;">
            <div class="row d-flex flex-nowrap">
                <div class="col col-2 d-flex flex-column sidebar border m-3 p-2" id="sidebar" style="height: 75vh;border:1px black;">
                    <a href="">Host Settings</a>
                    <a href="">Camera Settings</a>
                </div>
                <div class="col col-10 d-flex flex-column content m-3 pt-2" id="contentHost" style="height: 75vh;">
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

            </div>
        </div>
    
    </div>
</body>
</html>