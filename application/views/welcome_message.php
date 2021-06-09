<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <style type="text/css">
    #container,
    code {
        border: 1px solid #D0D0D0
    }

    ::selection {
        background-color: #E13300;
        color: #fff
    }

    ::-moz-selection {
        background-color: #E13300;
        color: #fff
    }

    body {
        background-color: #fff;
        margin: 40px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155
    }

    a,
    h1 {
        background-color: transparent;
        font-weight: 400
    }

    a {
        color: #039
    }

    h1 {
        color: #444;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        margin: 0 0 14px;
        padding: 14px 15px 10px
    }

    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        color: #002166;
        display: block;
        margin: 14px 0;
        padding: 12px 10px
    }

    #body {
        margin: 0 15px
    }

    p.footer {
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px;
        margin: 20px 0 0
    }

    #container {
        margin: 10px;
        box-shadow: 0 0 8px #D0D0D0
    }

    .Mymessage {
        background-color: #fbd20942;
        border-radius: 30px;
        padding: 5px 10px;

    }

    .messageFrom {
        background-color: #d0d0d05c;
        border-radius: 30px;
        padding: 5px 10px;

    }
    </style>
</head>

<body>
    <div id="container">
        <h1>Welcome to CodeIgniter!</h1>
        <div id="body" align="center">
            <div style="width:30%">
                <div id="messages"></div>
                <form action="" id="formChat">
                    <input type="text" id="text" placeholder="Message ..">
                    <input type="text" id="recipient_id" placeholder="Recipient id .." hidden>
                    <button id="submit" value="POST">Send</button>
                </form>
            </div>
        </div>

        <p class="footer">
            <span style="float: left;" id="token"></span>
            Page rendered in <strong>{elapsed_time}</strong>
            seconds.
            <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
        </p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    var conn = new WebSocket('ws://193.95.69.122:8282');
    var client = {
        user_id: <?php echo $user_id; ?>,
        recipient_id: null,
        type: 'chat',
        token: null,
        message: null
    };

    conn.onopen = function(e) {
        conn.send(JSON.stringify(client));
        $('#messages').append('<font color="green">Successfully connected as user ' + client.user_id +
            '</font><br>');
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        console.log(data)
        if (data.message) {
            $('#messages').append(" <p align = 'right' class='messageFrom' > " + data.message + ' : ' + data
                .user_id +

                '<i  >' + data.date + '</i></p> ');
        }
        if (data.type === 'token') {
            $('#token').html('JWT Token : ' + data.token);
        }
    };

    $('#formChat').submit(function(e) {
        e.preventDefault();
        client.message = $('#text').val();
        client.token = $('#token').text().split(': ')[1];
        client.type = 'chat';
        client.date = Date.now()
        $('#messages').append("<p align='left' class='Mymessage'  >me" + ' : ' + client.message + "</p>");

        if ($('#recipient_id').val()) {
            client.recipient_id = $('#recipient_id').val();
        }
        conn.send(JSON.stringify(client));
        $('#text').val('');
    });
    </script>
</body>

</html>