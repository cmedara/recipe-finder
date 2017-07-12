<?php

require_once 'RecommendationsModel.php';

class RecommedationTest extends PHPUnit_Framework_TestCase
{

    //put your code here
    public function testFileExists()
    {
        $recommendations = new RecommendationsModel();
        $return = $recommendations->checkFileExists("./fridge.csv", "./recipes.json");
        $this->assertTrue($return, "File does not exist");
    }

    public function testProcessCsv()
    {
        $expectedFridgeData = array(
            array('bread', '10', 'slices', '25/12/2018'),
            array('cheese', '10', 'slices', '25/12/2014'),
            array('butter', '250', 'grams', '25/12/2014'),
            array('peanut butter', '250', 'grams', '2/12/2014'),
            array('mixed salad', '150', 'grams', '26/12/2018'));
        //$rawRecpData = file_get_contents("./fridge.csv");
        $recommendations = new RecommendationsModel();

        $parseFrideData = $recommendations->processCsv("./fridge.csv");
        $this->assertEquals($expectedFridgeData, $parseFrideData, "Failed to process the CSV file as expected");
    }

    public function testRecommedation()
    {
        $expectedRecomdation = array(
            "name" => "salad sandwich",
            "ingredients" => array(
                array("item" => "bread", "amount" => "2", "unit" => "slices", "useByDiff" => (strtotime("25-12-2018") - time())),
                array("item" => "mixed salad", "amount" => "100", "unit" => "grams", "useByDiff" => (strtotime("26-12-2018") - time()))
        ));
        $recommendations = new RecommendationsModel();
        $frideData = $recommendations->processCsv("./fridge.csv");
        $rawRecpData = file_get_contents("./recipes.json");
        $recipData = json_decode($rawRecpData, 1);
        $calcRecomdation = $recommendations->calcRecommdations($recipData, $frideData);
        $this->assertEquals($expectedRecomdation, $calcRecomdation[0]);
    }
    
    public function testCalcTheLeastUseByIngredInRecipe()
    {
        $expectedRecipe = array(
                "name" => "salad sandwich",
                "ingredients" => array(
                    array("item" => "bread", "amount" => "2", "unit" => "slices", "useByDiff" => (strtotime("01-01-2018") - time())),
                    array("item" => "mixed salad", "amount" => "100", "unit" => "grams", "useByDiff" => (strtotime("02-01-2018") - time()))
                ),
            );
        $recipes = array(
            $expectedRecipe,
            array(
                "name" => "cecil sandwich",
                "ingredients" => array(
                    array("item" => "bread", "amount" => "2", "unit" => "slices", "useByDiff" => (strtotime("04-01-2018") - time())),
                    array("item" => "mixed salad", "amount" => "100", "unit" => "grams", "useByDiff" => (strtotime("05-01-2018") - time()))
                ),
            ),
            array(
                "name" => "grilled cheese on toast",
                "ingredients" => array(
                    array("item" => "bread", "amount" => "2", "unit" => "slices", "useByDiff" => (strtotime("09-01-2018") - time())),
                    array("item" => "cheese", "amount" => "2", "unit" => "grams", "useByDiff" => (strtotime("03-01-2018") - time()))
                ),
            )
        );
        $recommendations = new RecommendationsModel();
        $calcRecipe = $recommendations->calcTheLeastUseByIngredInRecip($recipes);
        $this->assertEquals($expectedRecipe, $calcRecipe);
    }

}
