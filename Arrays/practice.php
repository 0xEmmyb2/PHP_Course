<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $users = ['john', 'dave', 'tim'];

    for ($i = 0;$i < count($users); $i++){
        echo $users[$i]. "<br>";
        // var_dump($users);
        print_r($users);
    }

    
    ?>
</body>
</html>