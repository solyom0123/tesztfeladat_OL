<?php

namespace App\Tests\Controller;

use App\Controller\WorkingTimeController;
use App\Entity\Worker;
use App\Entity\WorkingTime;
use PHPUnit\Framework\TestCase;


class WorkingTimeControllerTest extends TestCase
{
    public function testBonusCalc()
    {
        $controller = new WorkingTimeController();
        $workingTime = new WorkingTime();
        $worker = new Worker();
        $birthday = new \DateTime("2010-04-10");
        $worker->setBirthdate($birthday);
        $worker->setName("Test John");
        $workingTime->setDate(new \DateTime("2021-02-20"));
        $start = new \DateTime("14:00:00");
        $end = new \DateTime("08:00:00");
        $workingTime->setEnd($end);
        $workingTime->setStart($start);
        $workingTime->setWorkerId($worker);
        $result =$controller->calculateWeekendBonus($workingTime);
        $this->assertEquals(9,$result,"9=${result} - jó!");
    }

    public function testBonusCalcFail_onNotWeekendDay()
    {
        $controller = new WorkingTimeController();
        $workingTime = new WorkingTime();
        $worker = new Worker();
        $birthday = new \DateTime("2010-04-10");
        $worker->setBirthdate($birthday);
        $worker->setName("Test John");
        $workingTime->setDate(new \DateTime("2020-02-20"));
        $start = new \DateTime("14:00:00");
        $end = new \DateTime("08:00:00");
        $workingTime->setEnd($end);
        $workingTime->setStart($start);
        $workingTime->setWorkerId($worker);
        $result =$controller->calculateWeekendBonus($workingTime);
        $this->assertNotEquals(9,$result,"0=${result} - jó!");
    }
}