<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internal User Information</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 30px;">
        <h2 style="text-align: center; color: #333;">Welcome to Mobas</h2>
        <p style="text-align: center; color: #555;">Here are your login details:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <td style="padding: 10px; font-weight: bold; border-bottom: 1px solid #eee;">Email</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $user['email'] }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: bold; border-bottom: 1px solid #eee;">Role</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $user['role'] }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: bold; border-bottom: 1px solid #eee;">Password</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $password['password'] }}</td>
            </tr>
        </table>

        <p style="margin-top: 30px; text-align: center; color: #666;">
            Please keep this information safe. <br>
            You can log in at <a href="{{ url('/login_mobas') }}" style="color: #007bff; text-decoration: none;">Mobas Website</a>.
        </p>

        <div style="margin-top: 40px; text-align: center; font-size: 12px; color: #999;">
            &copy; {{ date('Y') }} Mobas. All rights reserved.
        </div>
    </div>
</body>
</html>
