<?php

namespace UnitTestFiles\Test;

use Route4Me\CustomNoteTypeResponse;

class CustomNoteTypeResponseUnitTests extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $customNoteTypeResponse = CustomNoteTypeResponse::fromArray([
            'note_custom_type_id'       => 10,
            'note_custom_type'          => 'Dropoff Location',
            'root_owner_member_id'      => 1,
            'note_custom_type_values'   => [
                'Front door',
                'Backdoor',
                'Roof'
            ]
        ]);

        $this->assertEquals(10, $customNoteTypeResponse->note_custom_type_id);
        $this->assertEquals('Dropoff Location', $customNoteTypeResponse->note_custom_type);
        $this->assertEquals(1, $customNoteTypeResponse->root_owner_member_id);
        $this->assertEquals([
                'Front door',
                'Backdoor',
                'Roof'
            ],
            $customNoteTypeResponse->note_custom_type_values);
    }
}