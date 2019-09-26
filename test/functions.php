<?php
require('../functions.php');
Use PHPUnit\Framework\TestCase;

class FunctionTest extends TestCase {
    public function testdisplayDisease()
    {
        $expectedResult = '<div class="disease-item"><div><img src="figures/img_campylobacter.jpg" alt=""></div><strong>Organism</strong><br>Campylobacter<br><strong>Incubation_usual</strong><br>2-5 days<br><strong>Incubation_range</strong><br>1 - 10 days<br><strong>Symptoms</strong><br>Diarrhoea often with blood, abdominal pain with or without fever<br><strong>Severity</strong><br>Usually lasts 2-7 days<br><strong>Avg_annual_incidence</strong><br>47600<br></div>';
        $dummyData = [0 => ["Organism" => "Campylobacter", "Incubation_usual" => "2-5 days",  "Incubation_range" => "1 - 10 days",
            "Symptoms" => "Diarrhoea often with blood, abdominal pain with or without fever",
            "Severity" => "Usually lasts 2-7 days", "Avg_annual_incidence" => "47600",
            "Img_location" => "figures/img_campylobacter.jpg"]];
        $actualResult = displayDisease($dummyData);
        $this->assertEquals($expectedResult, $actualResult);
        $this->assertIsString($actualResult);
    }

    public function testgrabAllOrganisms()
    {
        $expectedResult = [0 => "Campylobacter"];
        $dummyData = [0 => ["Organism" => "Campylobacter", "Incubation_usual" => "2-5 days",  "Incubation_range" => "1 - 10 days",
            "Symptoms" => "Diarrhoea often with blood, abdominal pain with or without fever",
            "Severity" => "Usually lasts 2-7 days", "Avg_annual_incidence" => "47600",
            "Img_location" => "figures/img_campylobacter.jpg"]];
        $actualResult = grabAllOrganisms($dummyData);
        $this->assertEquals($expectedResult, $actualResult);
        $this->assertIsArray($actualResult);
    }

    public function testcreateAllOrganismDropDown()
    {
        $expectedResult = '<option value="Campylobacter">Campylobacter</option>';
        $dummyData = [0 => "Campylobacter"];
        $actualResult = createAllOrganismDropDown($dummyData);
        $this->assertEquals($expectedResult, $actualResult);
        $this->assertIsString($actualResult);
    }


    public function testgrabDataForSelectedOrganism()
    {
        $expectedResult = ["Organism" => "Campylobacter", "Incidence" => "High"];
        $dummyData = [0 => ["Organism" => "Campylobacter", "Incidence" => "High"], 1 => ["Organism" => "Polio", "Incidence" => "Low"]];
        $actualResult = grabDataForSelectedOrganism($dummyData, "Campylobacter");
        $this->assertEquals($expectedResult, $actualResult);
        $this->assertIsArray($actualResult);
    }

    public function testcreateOrganismEditForm()
    {
        $expectedResult = ' <form method="post" enctype="multipart/form-data"><label for="organism">Organism</label><input type="text" name="organism" id="organism" value = "Campylobacter" required><label for="incubation-usual">Incubation usual</label><input type="text" name="incubation-usual" id="incubation-usual" value = "2-5 days" required><label for="incubation-range">Incubation range</label><input type="text" name="incubation-range" id="incubation-range" value = "1 - 10 days" required><label for="symptoms">Symptoms</label><input type="text" name="symptoms" id="symptoms" value = "Diarrhoea often with blood, abdominal pain with or without fever" required><label for="severity">Severity</label><input type="text" name="severity" id="severity" value = "Usually lasts 2-7 days" required><label for="avg-annual-incidence">Average annual incidence</label><input type="number" name="avg-annual-incidence" id="avg-annual-incidence" value = "47600" required><label for="disease-img">Image</label><input type="file" name="disease-img" id="disease-img" required><input type="submit" value="Edit disease"></form>';
        $dummyData = ["Organism" => "Campylobacter", "Incubation_usual" => "2-5 days",  "Incubation_range" => "1 - 10 days",
            "Symptoms" => "Diarrhoea often with blood, abdominal pain with or without fever",
            "Severity" => "Usually lasts 2-7 days", "Avg_annual_incidence" => "47600",
            "Img_location" => "figures/img_campylobacter.jpg"];
        $actualResult = createOrganismEditForm($dummyData);
        $this->assertEquals($expectedResult, $actualResult);
        $this->assertIsString($actualResult);
    }
}