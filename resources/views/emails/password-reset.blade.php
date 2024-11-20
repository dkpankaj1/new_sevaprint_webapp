<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header svg {
            width: 60px;
            height: 60px;
            fill: #007bff;
        }
        h2 {
            font-size: 24px;
            color: #333;
            margin-top: 10px;
        }
        .message {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            display: inline-block;
        }
        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 30px;
        }
        .footer a {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Inline SVG for the reset password icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm1-13h-2v6l4.25 2.25.75-1.5-3.25-1.75V7z"/></svg>
        </div>

        <h2>Password Reset Request</h2>

        <p class="message">Hi, {{$user->name}},</p>

        <p class="message">
            We received a request to reset your password. To proceed with the password reset, click the button below:
        </p>

        <p>
            <a href="{{ $url }}" class="btn">Reset Password</a>
        </p>

        <p class="message">
            If you did not request a password reset, you can safely ignore this email.
        </p>

        <div class="footer">
            <p>Thank you for using our service!</p>
            <p>If you have any questions, feel free to <a href="mailto:support@example.com">contact us</a>.</p>
        </div>
    </div>
</body>
</html>
