<?php

namespace App;

use PhpUnitsOfMeasure\PhysicalQuantity\Volume;
use Ramsey\Uuid\UuidInterface;

class Teapot
{
    private $id;

//    private $weight; // current weight of the teapot

    private $capacity; // the total volume of the teapot when it is full

    private $volume; // current amount of liquid available in teapot

    private function __construct(UuidInterface $id, Volume $capacity, Volume $volume)
    {
        $this->id       = $id;
        $this->capacity = $capacity;
        $this->volume   = $volume;
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function capacity(): Volume
    {
        return $this->capacity;
    }

    public function volume(): Volume
    {
        return $this->volume;
    }

    /**
     * @param UuidInterface $id
     * @param Volume        $capacity
     * @param Volume        $volume
     *
     * @return Teapot
     * @throws InvalidVolumeException
     */
    public static function createFromIdAndCapacityAndVolume(UuidInterface $id, Volume $capacity, Volume $volume)
    {
        if ($volume->toNativeUnit() > $capacity->toNativeUnit()) {
            $m = sprintf('You can not create a Teapot with a greater volume (%s) than it\'s capacity (%s)',
                $volume,
                $capacity
            );
            throw new InvalidVolumeException($m);
        }
        return new self($id, $capacity, $volume);
    }

    public function fillUp()
    {
        $this->volume = clone $this->capacity;
    }

    /**
     * @param Volume $fillVolume
     *
     * @throws InvalidFillVolumeException
     * @throws \PhpUnitsOfMeasure\Exception\PhysicalQuantityMismatch
     */
    public function fill(Volume $fillVolume)
    {
        if ($this->volume->add($fillVolume)->toNativeUnit() > $this->capacity->toNativeUnit()) {
            $m = 'You are trying to fill the teapot with more liquid than it can currently hold.';
            throw new InvalidFillVolumeException($m);
        }

        $this->volume = $this->volume->add($fillVolume);
    }

    /**
     * @param Volume $pourVolume
     *
     * @throws InvalidPourVolumeException
     * @throws \PhpUnitsOfMeasure\Exception\PhysicalQuantityMismatch
     */
    public function pour(Volume $pourVolume)
    {
        if ($pourVolume->toNativeUnit() > $this->volume->toNativeUnit()) {
            $m = sprintf(
                'Unable to pour %s from the pot as the pot only has %s left.',
                $pourVolume,
                $this->volume
            );
            throw new InvalidPourVolumeException($m);
        }

        $this->volume = $this->volume->subtract($pourVolume);
    }
}


/**
 * Ideas:
 *
 * Maybe the namespace could be Beverage?
 *  - Beverage/Teapot
 *  - Beverage/Mug
 */