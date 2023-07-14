
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>

    HI Welcome, You have got an invitation<br>
    <button style="padding:8px 16px; border:0;border-radius: 7px;background-color: crimson;">
        <a href="http://localhost:5173/register?email=<?php echo $data['email'];?>&token=<?php echo $data['token'];?>" style="text-decoration:none; font-weight:bold; color:white;">Register</a>
    </button>
    
</body>
</html>