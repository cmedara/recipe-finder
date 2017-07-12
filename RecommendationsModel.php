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
        if (!file_exists($recipeFilePath) && file_exists($fridgeIndgFilePath))
        {
            throw new Exception("The recipe file does not exsist");
        }
        if (!file_exists($fridgeIndgFilePath))
        {
            throw new Exception("The fridge ingredients file does not exsist");
        }
        return $boolExists;
    }

    public function processCsv($csvFilePath)
    {
        $fridgeData = array();
        if (($handle = fopen($csvFilePath, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                if (!empty($data[0]))
                {
                    $fridgeData[] = $data;
                }
            }
            fclose($handle);
        }
        return $fridgeData;
    }

}

//$recommendations = new RecommendationsModel();
//$frideData = $recommendations->processCsv("./fridge.csv");
//$rawRecpData = file_get_contents("./recipes.json");
//$recipData = json_decode($rawRecpData, 1);
//$calcRecomdation = $recommendations->calcRecommdations($recipData, $frideData);
