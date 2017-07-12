<?php

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

    public function calcRecommdations($recipes, $frideIngeds)
    {
        $recommendations = array();
        $timeStampNow = time();
        /**
         * loop through all the recipes
         */
        foreach ($recipes as $recipkey => $recipe)
        {
            $recipIngedCount = count($recipe['ingredients']);
            $frideIngedsCanUseCount = 0;
            /**
             * loop through all the ingredients in the recipes
             */
            foreach ($recipe['ingredients'] as $recpIngredkey => $recpIngredient)
            {
                /**
                 * loop through all the ingredients in the fridge
                 */
                foreach ($frideIngeds as $frideIngedsKey => $frideIngredient)
                {
                    $useByfrideIngred = strtotime(str_replace("/", "-", $frideIngredient[3]));
                    /**
                     * check if ingredients in the fridge map with the recipes
                     */
                    if (
                            $useByfrideIngred >= $timeStampNow//check if the fridge ingredient is not expired
                            &&
                            $recpIngredient['item'] == $frideIngredient[0] //match the ingreditents
                            &&
                            $recpIngredient['amount'] <= $frideIngredient[1]//check if sufficient amount
                            &&
                            $recpIngredient['unit'] == $frideIngredient[2])//check the unit is the same
                    {
                        $frideIngedsCanUseCount++;
                        $recipe['ingredients'][$recpIngredkey]['useByDiff'] = $useByfrideIngred - $timeStampNow; //append the time difference B/W now and expiry to calculate the closest ingredient for expiry if mulitple recpies
                    }
                }
            }
            if ($recipIngedCount == $frideIngedsCanUseCount)
            {
                $recommendations[] = $recipe;
            }
        }

        return $recommendations;
    }

}
