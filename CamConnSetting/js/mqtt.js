        let ip = "192.168.30.194";
        let port = "1884";
        let SubscribeTxt = "Web/Server/Response";
        let Topic = "AI/Server/Connected";
        let CommandID = $.now();
        let message = '{"CommandID":' + CommandID + '}';
        let MQTTClient = mqtt.connect("ws://" + ip + ":" + port);
        let ServerList = "";
        let hostList = [];
        let camerasData = "";
        let camSetting = "";
        let setting = {};

        MQTTClient.on('connect', function () {
        console.log('MQTT Connection OK');
            Subscribe();
        });

        MQTTClient.on('reconnect', function () {
        console.log('MQTT Reconnecting...');
        });

        MQTTClient.on('close', function () {
            console.log('MQTT Disconnected');
        })

        MQTTClient.on('error', function (error) {
            console.log('MQTT error', error);
        })

        MQTTClient.on("message", function (topic, payload, packet) {
            let msg = JSON.parse(payload.toString());
            // console.log("message",msg);
            // 不是自己則跳過
            if(msg.CommandID != CommandID){
                return;
            }
            
            switch(topic){
                case "Web/Server/Response": // AIToWeb001
                    ServerList = msg.ServerList;
                    // console.log("ServerList",typeof ServerList);
                    localStorage.setItem("ServerList", JSON.stringify(ServerList));
                    // console.log("localStorageServerList",typeof localStorage.getItem("ServerList"));
                    // ServerList.forEach(server => {
                    //     // hostList.push(server);
                    //     $("#hostTable tbody").append(`
                    //         <tr>
                    //             <td>${server.SEQ}</td>
                    //             <td>${server.IPAddress}</td>
                    //             <td>${server.Port}</td>
                    //             <td>${server.Account}</td>
                    //             <td>${(server.Status == 1)? "連線":""}</td>
                    //             <td>
                    //                 <button class="btn btn-secondary btn-sm" onclick="hostBtn(${server.SEQ})">編輯</button>
                    //                 <button class="btn btn-danger btn-sm" onclick="alertText()">刪除</button>
                    //             </td>
                    //         </tr>
                    //     `);
                    // });
                    initHostTable();
                    break;
                case "Web/Update/Response": // AIToWeb004
                    console.log("Web/Update/Response",msg);
                    
                    break;
                case "Web/Camera/Response": // AIToWeb002
                    camerasData = msg.CameraList;
                    initCamTable();
                    break;
                case "Web/Update/Response": // AIToWeb004
                    console.log("Web/Update/Response",msg);
                    break;
                case "Web/Alarm/Response": // AIToWeb005
                    camSetting = msg.CameraList;
                    alarmData();
                    break;
            }
        });

        function Subscribe(){
            console.log("SubscribeTxt",SubscribeTxt);
        	MQTTClient.subscribe(SubscribeTxt);
        }

        function Send(){
            console.log("message",message);
        	MQTTClient.publish(Topic, message);
        }