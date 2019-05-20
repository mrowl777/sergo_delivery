<?php

if( isset($_GET['track_code'])){
  echo($_GET['track_code']);
}

?>

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
</body>
