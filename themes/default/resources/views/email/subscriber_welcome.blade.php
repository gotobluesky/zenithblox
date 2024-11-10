
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #6570be;
            padding: 10px;
            text-align: center;
            color: #ffffff;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-spacing: 0;
        }
        td {
            padding: 10px 0;
        }
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            td {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <td class="header">
                    <h1>Thank You!</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <p>Thank you for subscribing. We truly appreciate your support and contribution.</p>
                    <p>If you have any questions or need further assistance, please don't hesitate to reach out to us.</p>
                    <p>Best regards,</p>
                    <p>Fode<br>Zenithblox’s.</p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    <p>© {{ date('Y') }} Zenithblox’s. All rights reserved</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
