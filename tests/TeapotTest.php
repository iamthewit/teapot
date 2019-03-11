<?php

namespace App\Tests;

use App\Teapot;
use PHPUnit\Framework\TestCase;
use PhpUnitsOfMeasure\PhysicalQuantity\Volume;
use Ramsey\Uuid\Uuid;

class TeapotTest extends TestCase
{
    public function testItReturnsAVolume()
    {
        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(10, 'l')
        );

        $this->assertEquals(new Volume(10, 'l'), $teapot->volume());
    }

    public function testItReturnsAnId()
    {
        $id = Uuid::uuid4();

        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            $id,
            new Volume(10, 'l'),
            new Volume(10, 'l')
        );

        $this->assertEquals($id, $teapot->id());
    }

    public function testCapacity()
    {
        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(10, 'l')
        );

        $this->assertEquals(new Volume(10, 'l'), $teapot->capacity());
    }

    public function testCreateFromIdAndCapacityAndVolume()
    {

    }

    public function testItExceptionWhenCreatingWithAGreaterVolumeThanCapacity()
    {

    }

    public function testFill()
    {

    }

    public function testItThrowsAnExceptionWhenOverfilling()
    {

    }

    public function testPour()
    {

    }

    public function testItThrowsAnExceptionWhenPouringMoreThanIsLeftInThePot()
    {

    }
}
