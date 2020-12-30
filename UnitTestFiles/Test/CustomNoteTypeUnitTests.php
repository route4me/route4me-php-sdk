<?php

namespace UnitTestFiles\Test;

use Route4Me\CustomNoteType;

class CustomNoteTypeUnitTests extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $customNoteType = CustomNoteType::fromArray([
            'note_custom_entry_id'  => 'ABCBA1228FA18888DBEECBFA2DA7777C850E15CA',
            'note_id'               => '3237302',
            'note_custom_type_id'   => '10',
            'note_custom_value'     => 'Backdoor',
            'note_custom_type'      => 'Dropoff Location'
        ]);

        $this->assertEquals('ABCBA1228FA18888DBEECBFA2DA7777C850E15CA', $customNoteType->note_custom_entry_id);
        $this->assertEquals('3237302', $customNoteType->note_id);
        $this->assertEquals('10', $customNoteType->note_custom_type_id);
        $this->assertEquals('Backdoor', $customNoteType->note_custom_value);
        $this->assertEquals('Dropoff Location', $customNoteType->note_custom_type);
    }

}