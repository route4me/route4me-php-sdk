<?php
namespace Route4Me\Enum;

class ActivityTypes
{
    const AREA_REMOVED              = 'area-removed';
    const AREA_ADDED                = 'area-added';
    const AREA_UPDATED              = 'area-updated';
    const DELETE_DESTINATION        = 'delete-destination';
    const INSERT_DESTINATION        = 'insert-destination';
    const DESTINATION_OUT_SEQUENCE  = 'destination-out-sequence';
    const DRIVER_ARRIVED_EARLY      = 'driver-arrived-early';
    const DRIVER_ARRIVED_LATE       = 'driver-arrived-late';
    const DRIVER_ARRIVED_ON_TIME    = 'driver-arrived-on-time';
    const GEOFENCE_LEFT             = 'geofence-left';
    const GEOFENCE_ENTERED          = 'geofence-entered';
    const MARK_DESTINATION_DEPARTED = 'mark-destination-departed';
    const MARK_DESTINATION_VISITED  = 'mark-destination-visited';
    const MEMBER_CREATED            = 'member-created';
    const MEMBER_DELETED            = 'member-deleted';
    const MEMBER_MODIFIED           = 'member-modified';
    const MOVE_DESTINATION          = 'move-destination';
    const NOTE_INSERT               = 'note-insert';
    const ROUTE_DELETE              = 'route-delete';
    const ROUTE_OPTIMIZED           = 'route-optimized';
    const ROUTE_OWNER_CHANGED       = 'route-owner-changed';
    const ROUTE_DUPLICATE           = 'route-duplicate';
    const UPDATE_DESTINATIONS       = 'update-destinations';
    const USER_MESSAGE              = 'user_message';

    static function getConstants() {
        $atc = new \ReflectionClass('Route4Me\\Enum\\ActivityTypes');
        return $atc->getConstants();
    }
}

