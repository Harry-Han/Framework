<?php
$responseData = $_REQUEST['action'];
function getFormArrData($responseData){
    $userId = $responseData['userid'];
    $email = $responseData['email'];
    $password = $responseData['paw'];
    echo $userId . $email . $password;
}
?>s
<html>
<head>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" name="getFormArrData">
        Username <input type="text" name="action[userid]" id="userid" value="" />
        Password <input type="text" name="action[paw]" id="paw" value="" />
        Email <input type="text" name="action[email]" id="email" value="" />
        <input type="submit" name="lookup" value="Go">
    </form>
</body>
</html>