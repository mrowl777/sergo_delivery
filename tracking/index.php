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
        <p>Отправитель:</p><div id="sender_title"></div>
    </div>
    <div>
        <p>Отправление из:</p><div id="sender_city"></div>
    </div>
    <div>
        <p>Доставка:</p><div  id="sender_delivery"></div>
    </div>

    <br/><br/>

    <div>
        <p>Получатель:</p><div id="recipient_title"></div>
    </div>
    <div>
        <p>Отправление в:</p><div id="recipient_city"></div>
    </div>
    <div>
        <p>Доставка:</p><div id="recipient_delivery"></div>
    </div>

    <br/><br/>

    <div>
        <p>Cтатус:<div id="status"> </div>
    </div>
    
    </div>
</body>
