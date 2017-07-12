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
        <center>
            <h1>Recipe Recommender</h1>
            <form action='RecommendationsController.php' method='post' enctype="multipart/form-data">
                <label for='fileFridge' >Import Fridge File(CSV):</label> <input type='file' name='fileFridge'  id='fileFridge' size="20" ><br  /><br  />
                <label for='fileRecipes'>Import Recipes File(JSON): </label><input type='file' name='fileRecipes' id='fileRecipes' size="20"><br /><br  />
                <input type='submit' name='submit' value='submit'>
            </form>
        </center>
    </body>
</html>
