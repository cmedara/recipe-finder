<?php

require_once './RecommendationsModel.php';
$recipeFilePath = "";
$fridgeIndgFilePath = "";
if (!empty($argv[1]) && !empty($argv[2]))
{
    $recipeFilePath = $argv[1];
    $fridgeIndgFilePath = $argv[2];
}
else
{
    die('Wrong request');
}
$recommendations = new RecommendationsModel();
try
{
    $recommendations->checkFileExists($recipeFilePath, $fridgeIndgFilePath);
    $frideData = $recommendations->processCsv("./fridge.csv");
    $rawRecpData = file_get_contents("./recipes.json");
    $recipData = json_decode($rawRecpData, 1);
    $suggRecomdation = $recommendations->calcRecommdations($recipData, $frideData);
    if (empty($suggRecomdation))
    {
        throw new Exception("Order Takeout");
    }
    if (count($suggRecomdation) > 1)
    {
        $suggRecomdation = $recommendations->calcTheLeastUseByIngredInRecip($suggRecomdation);
    }
    echo $suggRecomdation[0]['name'];
} 
catch (Exception $ex)
{
    echo $ex->getMessage();
}