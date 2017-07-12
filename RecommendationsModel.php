<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author cmeda
 */
class RecommendationsModel
{

    public function checkFileExists($recipeFilePath, $fridgeIndgFilePath)
    {
        $boolExists = true;
        return $boolExists;
    }

    public function processCsv($csvFilePath)
    {
    }

}

//$recommendations = new RecommendationsModel();
//$frideData = $recommendations->processCsv("./fridge.csv");
//$rawRecpData = file_get_contents("./recipes.json");
//$recipData = json_decode($rawRecpData, 1);
//$calcRecomdation = $recommendations->calcRecommdations($recipData, $frideData);
