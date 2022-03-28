<?php

    //obsolete captcha function - will remove
    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    //gets connection to db
    require('connection.php');


    //From line 20 to 35 is code required to post content to database
    $error = false;

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = "tech";

    if(strlen($title) <= 1 || strlen($content <= 1)){
        $error == true;
    }
    else{
        $query = "INSERT INTO threads (title, content, category) VALUES (:title, :content, :category)";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':category', $category);

        $statement->execute();
        header('location: tech.php');
        exit();
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/insertstyles.css">
    <title>NetRunner - Forum</title>
</head>

<body>

    <div class="header-bar">
        <h2><a href="tech.php">&lt;&lt; Back</a></h2>
    </div>

    <div class="threadposition">
        <div id="threadcontainer">
            <form method="post">
                <table>
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td><input type="text" name="name" size="25" maxlength="35" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>
                                <input style="float:left;" type="text" name="title" id="title" size="25" maxlength="100"
                                    autocomplete="off">
                                <input style="margin-left:2px;" type="submit" name="post" value="Post">
                            </td>
                        </tr>
                        <tr>
                            <th>Comment</th>
                            <td>
                                <textarea name="content" id="content" rows="5" cols="35" maxlength="200"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                File
                            </th>
                            <td>
                                <input type="file" name="file" id="upload_file" style="display: block;">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Captcha
                            </th>
                            <td>
                                <input type="text" name="captcha" maxlength="5"
                                    autocomplete="off">&nbsp;<span><?= generateRandomString() ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>

</html>