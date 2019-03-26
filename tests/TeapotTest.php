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

    public function testItReturnsACapacity()
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
        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(10, 'l')
        );

        $this->assertInstanceOf(Teapot::class, $teapot);
    }

    /**
     * @expectedException \App\InvalidVolumeException
     * @expectedExceptionMessage You can not create a Teapot with a greater volume (100 l) than it's capacity (10 l)
     */
    public function testItExceptionWhenCreatingWithAGreaterVolumeThanCapacity()
    {
        Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(100, 'l')
        );
    }

    public function testFillMethodFillsTeapotWithGivenVolume()
    {
        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(0, 'l')
        );

        $this->assertEquals(new Volume(0, 'l'), $teapot->volume());

        $teapot->fill(new Volume(10, 'l'));

        $this->assertEquals(new Volume(10, 'l'), $teapot->volume());
    }

    /**
     * @expectedException \App\InvalidFillVolumeException
     * @expectedExceptionMessage You are trying to fill the teapot with more liquid than it can currently hold.
     */
    public function testItThrowsAnExceptionWhenOverfilling()
    {
        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(10, 'l')
        );

        $teapot->fill(new Volume(10, 'l'));
    }

    public function testPourMethodRemovesGivenVolumeFromTeapotVolume()
    {
        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(10, 'l')
        );

        $this->assertEquals(new Volume(10, 'l'), $teapot->volume());

        $teapot->pour(new Volume(1, 'l'));

        $this->assertEquals(new Volume(9, 'l'), $teapot->volume());
    }

    /**
     * @expectedException \App\InvalidPourVolumeException
     * @expectedExceptionMessage Unable to pour 1 l from the pot as the pot only has 0 l left.
     */
    public function testItThrowsAnExceptionWhenPouringMoreThanIsLeftInThePot()
    {
        $teapot = Teapot::createFromIdAndCapacityAndVolume(
            Uuid::uuid4(),
            new Volume(10, 'l'),
            new Volume(0, 'l')
        );

        $teapot->pour(new Volume(1, 'l'));
    }
}
