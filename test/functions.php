<?php
require('../functions.php');
Use PHPUnit\Framework\TestCase;


class StackTest extends TestCase {
    public function testdisplayDisease()
    {
        $expectedResult = '<div class="disease-item"><div><img src="figures/img_campylobacter.jpg" alt=""></div><strong>Organism</strong><br>Campylobacter<br><strong>Incubation_usual</strong><br>2-5 days<br><strong>Incubation_range</strong><br>1 - 10 days<br><strong>Symptoms</strong><br>Diarrhoea often with blood, abdominal pain with or without fever<br><strong>Severity</strong><br>Usually lasts 2-7 days<br><strong>Avg_annual_incidence</strong><br>47600<br></div>';
        $dummyData = [0 => ["Organism" => "Campylobacter", "Incubation_usual" => "2-5 days",  "Incubation_range" => "1 - 10 days",
            "Symptoms" => "Diarrhoea often with blood, abdominal pain with or without fever",
            "Severity" => "Usually lasts 2-7 days", "Avg_annual_incidence" => "47600",
            "Img_location" => "figures/img_campylobacter.jpg"]];
        $actual = displayDisease($dummyData);
        $this->assertEquals($expectedResult, $actual);
    }
}