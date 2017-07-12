<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testRecommedation
 *
 * @author cmeda
 */
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

}
