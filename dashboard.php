<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body onload="pageLoad()">


    <div class="buttons">
        <div class="button-sec">
            <button class="led-button" data="led1"  onclick="updater(this)">Turn On LED1</button>
            <div class="led-status">Active</div>
        </div>
        <div class="button-sec">
            <button class="led-button" data="led2"  onclick="updater(this)">Turn On LED1</button>
            <div class="led-status">Active</div>
        </div>
    </div>


    <script src="./index.js"></script>
</body>

</html>