<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Recipe Recommender</h1>
        <form action='RecommendationsController.php' method='post' enctype="multipart/form-data">
            Import Fridge File(CSV): <input type='file' name='fileFridge' size="20" ><br  />
            Import Recipes File(JSON): <input type='file' name='fileRecipes'  size="20"><br />
            <input type='submit' name='submit' value='submit'>
        </form>
    </body>
</html>
