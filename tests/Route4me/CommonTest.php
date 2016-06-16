<?php

namespace Route4Me;

use Route4Me\Common;

class CommonTest extends \PHPUnit_Framework_TestCase
{
    public $address;

    public function setUp() {
        $this->address =  array(
            "address"=> "10609 Mystic Pointe Dr, Fredericksburg, VA 22407",
            "lat"=> 38.2513427734,
            "lng"=> -77.5993652344,
            "time"=> 300,
            "time_window_end"=> 75600,
            "time_window_start"=> 28800
        );
    }

    public function testCheckValue() {
        $addressName = Common::getValue($this->address, 'address');
        $this->assertNotNull($addressName);
        $this->assertEquals($addressName, "10609 Mystic Pointe Dr, Fredericksburg, VA 22407");
    }

    public function testCheckNonExistsValue() {
        $badKey = Common::getValue($this->address, 'badkey');
        $this->assertNull($badKey);
    }

    public function testCheckNonExistsValueWithDefaultValue() {
        $memberId = Common::getValue($this->address, 'member_id', 1);
        $this->assertNotNull($memberId);
        $this->assertEquals($memberId, 1);
    }
}
