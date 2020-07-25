<?php

namespace UnitTestFiles\Test;

use Route4Me\AddressNote;

class AddressNoteUnitTests extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $addressNote = AddressNote::fromArray([
            'note_id'               => 539264,
            'route_id'              => '5555E83A4BE0055551537955558D5555',
            'route_destination_id'  => 162916895,
            'ts_added'              => 1466515325,
            'activity_type'         => 'dropoff',
            'upload_id'             => '1a499993c63d68d1a5d26045a1763d16',
            'upload_extension'      => 'csv',
            'upload_url'            => 'http:\/\/adb6def9928467589ebb-f540d5a8d53c2e76ad581b6e5c346ad6.\/1a499113c63d68d1a5d26045a1763d16.csv',
            'upload_type'           => 'ANY_FILE',
            'contents'              => 'Some text',
            'lat'                   => 33.132675,
            'lng'                   => -83.244743,
            'device_type'           => 'web'
        ]);

        $this->assertEquals(539264, $addressNote->note_id);
        $this->assertEquals('5555E83A4BE0055551537955558D5555', $addressNote->route_id);
        $this->assertEquals(162916895, $addressNote->route_destination_id);
        $this->assertEquals(1466515325, $addressNote->ts_added);
        $this->assertEquals('dropoff', $addressNote->activity_type);
        $this->assertEquals('1a499993c63d68d1a5d26045a1763d16', $addressNote->upload_id);
        $this->assertEquals('csv', $addressNote->upload_extension);
        $this->assertEquals('http:\/\/adb6def9928467589ebb-f540d5a8d53c2e76ad581b6e5c346ad6.\/1a499113c63d68d1a5d26045a1763d16.csv', $addressNote->upload_url);
        $this->assertEquals('ANY_FILE', $addressNote->upload_type);
        $this->assertEquals('Some text', $addressNote->contents);
        $this->assertEquals(33.132675, $addressNote->lat);
        $this->assertEquals(-83.244743, $addressNote->lng);
        $this->assertEquals('web', $addressNote->device_type);
    }
}