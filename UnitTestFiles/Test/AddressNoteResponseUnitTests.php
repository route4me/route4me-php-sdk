<?php

namespace UnitTestFiles\Test;

use Route4Me\AddressNoteResponse;
use Route4Me\AddressNote;

class AddressNoteResponseUnitTests extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $addressNoteResponse = AddressNoteResponse::fromArray([
            'status'    => true,
            'note_id'   => '1015289',
            'upload_id' => '',
            'note' => [
                'note_id'               => 1015289,
                'route_id'              => 'DD376C7148E777736CFABE2BD9998BDD',
                'route_destination_id'  => 183045812,
                'ts_added'              => 1480511401,
                'activity_type'         => '',
                'upload_id'             => '',
                'upload_extension'      => null,
                'upload_url'            => null,
                'upload_type'           => null,
                'contents'              => 'Note example for Destination Audit Use Case',
                'lat'                   => 41.145241,
                'lng'                   => -81.410248,
                'device_type'           => 'web'
            ]
        ]);

        $this->assertEquals(true, $addressNoteResponse->status);
        $this->assertEquals('1015289', $addressNoteResponse->note_id);
        $this->assertEquals('', $addressNoteResponse->upload_id);
        $this->assertEquals([
                'note_id'               => 1015289,
                'route_id'              => 'DD376C7148E777736CFABE2BD9998BDD',
                'route_destination_id'  => 183045812,
                'ts_added'              => 1480511401,
                'activity_type'         => '',
                'upload_id'             => '',
                'upload_extension'      => null,
                'upload_url'            => null,
                'upload_type'           => null,
                'contents'              => 'Note example for Destination Audit Use Case',
                'lat'                   => 41.145241,
                'lng'                   => -81.410248,
                'device_type'           => 'web'
            ],
            $addressNoteResponse->note);

        $note = AddressNote::fromArray(
            $addressNoteResponse->note
        );

        $this->assertContainsOnlyInstancesOf(AddressNote::class, [$note]);
    }
}