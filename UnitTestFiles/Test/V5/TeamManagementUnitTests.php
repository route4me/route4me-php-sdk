<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Route4Me;
use Route4Me\Members\Member;
use Route4Me\V5\TeamManagement\Option;
use Route4Me\V5\TeamManagement\Permission;
use Route4Me\V5\TeamManagement\ResponseTeam;
use Route4Me\V5\TeamManagement\TeamManagement;

final class TeamManagementUnitTests extends \PHPUnit\Framework\TestCase
{
    public static ?int $member_id = null;
    public static ?int $owner_member_id = null;

    public static function setUpBeforeClass() : void
    {
        Route4Me::setApiKey(Constants::API_KEY);
    }

    public function testOwnerMemberMustExists() : void
    {
        $member = new Member();
        $res_members = $member->getUsers();
    
        if (is_array($res_members) && isset($res_members['results'])) {
            foreach ($res_members['results'] as $key => $value) {
                if ($value['OWNER_MEMBER_ID'] == 0) {
                    self::$owner_member_id = $value['member_id'];
                    break;
                }
            }
        }
        $this->assertNotNull(self::$owner_member_id);
    }

    public function testOptionCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Option::class, new Option());
    }

    public function testOptionCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Option::class, new Option([
            'value' => '1',
            'title' => '2'
        ]));
    }

    public function testPermissionCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Permission::class, new Permission());
    }

    public function testPermissionCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Permission::class, new Permission([
            'id' => '1',
            'options' => [
                [
                    'value' => '2',
                    'title' => '3'
                ], [
                    'value' => '4',
                    'title' => '5'
                ]
            ]
        ]));
    }

    public function testResponseTeamCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponseTeam::class, new ResponseTeam());
    }

    public function testResponseTeamCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ResponseTeam::class, new ResponseTeam([
            'member_id' => '1',
            'member_first_name' => '2'
        ]));
    }

    public function testTeamManagementCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(TeamManagement::class, new TeamManagement());
    }

    public function testCreateMustReturnResponseTeam() : void
    {
        $team_mng = new TeamManagement();
        $res_team = $team_mng->create([
            'new_password' => '12345&Qwerty',
            'member_first_name' => 'Tusha I',
            'member_last_name' => 'Pupkindzes',
            'member_email' => 'The_I@best.com',
            'member_type' => 'SUB_ACCOUNT_DRIVER',
            'OWNER_MEMBER_ID' => self::$owner_member_id
        ]);

        $this->assertInstanceOf(ResponseTeam::class, $res_team);
        $this->assertNotNull($res_team->member_id);
        $this->assertEquals($res_team->member_first_name, 'Tusha I');
        
        self::$member_id = $res_team->member_id;
    }

    public function testGetUserMustReturnResponseTeam() : void
    {
        $team_mng = new TeamManagement();
        $res_team = $team_mng->getUser(self::$member_id);

        $this->assertInstanceOf(ResponseTeam::class, $res_team);
        $this->assertNotNull($res_team->member_id);
        $this->assertEquals($res_team->member_first_name, 'Tusha I');
    }

    public function testGetUsersMustReturnArrayOfResponseTeam() : void
    {
        $team_mng = new TeamManagement();
        $result = $team_mng->getUsers();

        $this->assertIsArray($result);
        if (count($result) > 0) {
            $this->assertInstanceOf(ResponseTeam::class, $result[0]);
        }
    }

    public function testUpdateMustReturnUpdatedResponseTeam() : void
    {
        $team_mng = new TeamManagement();
        $res_team = $team_mng->update(self::$member_id, [
            'HIDE_ROUTED_ADDRESSES' => true,
            'member_type' => 'SUB_ACCOUNT_DISPATCHER'
        ]);

        $this->assertInstanceOf(ResponseTeam::class, $res_team);
        $this->assertEquals($res_team->HIDE_ROUTED_ADDRESSES, 1);
        $this->assertEquals($res_team->member_type, 'SUB_ACCOUNT_DISPATCHER');
    }

    public function testDeleteMustReturnDeletedResponseTeam() : void
    {
        $team_mng = new TeamManagement();
        $res_team = $team_mng->delete(self::$member_id);

        $this->assertInstanceOf(ResponseTeam::class, $res_team);
        $this->assertNotNull($res_team->member_id);
        $this->assertEquals($res_team->member_first_name, 'Tusha I');
    }

    public function testBulkInsertMustAddNewMembers() : void
    {
        $team_mng = new TeamManagement();
        $result = $team_mng->bulkInsert([
            [
                'new_password' => '12345&Qwerty',
                'member_first_name' => 'Tusha I',
                'member_last_name' => 'Pupkindzes',
                'member_email' => 'the_I@best.com',
                'member_type' => 'SUB_ACCOUNT_DRIVER',
                'OWNER_MEMBER_ID' => self::$owner_member_id
            ], [
                'new_password' => '12345&Qwerty',
                'member_first_name' => 'Tusha II',
                'member_last_name' => 'Pupkindzes',
                'member_email' => 'the_II@best.com',
                'member_type' => 'SUB_ACCOUNT_DRIVER',
                'OWNER_MEMBER_ID' => self::$owner_member_id
                ]
        ], [
            'conflicts' => 'overwrite'
        ]);

        $this->assertIsArray($result);
    }
    
    public static function tearDownAfterClass() : void
    {
        sleep(5);

        $team_mng = new TeamManagement();
        $result = $team_mng->getUsers();

        if (is_array($result)) {
            foreach ($result as $key => $member) {
                if ($member->member_last_name == 'Pupkindzes') {
                    $team_mng->delete($member->member_id);
                }
            }
        }
    }
}
