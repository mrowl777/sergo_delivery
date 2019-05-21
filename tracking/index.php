<head>
    <title>Tracking</title>
    <link href="index.css" rel="stylesheet" type="text/css" />
    <script src="../jquery-3.4.0.js"></script>
    <script src="index.js"></script>
</head>
<body>
    <div class="close">
        <i class="icon-large icon-times"></i>
    </div>
    
    <div class="search">
    <i class="icon-large icon-search"></i>
        <input type="text" name='trackcode' class="input">
    </div>

    <div class="data_block">
    <div>
        Отправитель:<div id="sender_title"></div>
    </div>
    <div>
        Отправление из:<div id="sender_city"></div>
    </div>
    <div>
        Доставка:<div  id="sender_delivery"></div>
    </div>

    <br/><br/>

    <div>
        Получатель:<div id="recipient_title"></div>
    </div>
    <div>
        Отправление в:<div id="recipient_city"></div>
    </div>
    <div>
        Доставка:<div id="recipient_delivery"></div>
    </div>

    <br/><br/>

    <div>
        Cтатус:<div id="status"> </div>
    </div>
    
    </div>
</body>
