<?php

namespace Route4Me\Enum;

class Endpoint
{
    const BASE_URL = '';
    const BASE_URL_1 = 'https://api.route4me.com';
    const WH_BASE_URL = '';
    const WH_BASE_URL_1 = 'https://wh.route4me.com/modules';

    const AVOIDANCE_ZONE = self::BASE_URL_1 . '/api.v4/avoidance.php';
    const TERRITORY_V4 = self::BASE_URL_1 . '/api.v4/territory.php';

    const GET_ACTIVITIES = self::BASE_URL_1 . '/api/get_activities.php';
    const ACTIVITY_FEED = self::BASE_URL_1 . '/api.v4/activity_feed.php';

    const ADDRESS_V4 = self::BASE_URL_1 . '/api.v4/address.php';
    const MOVE_ROUTE_DESTINATION = self::BASE_URL_1 . '/actions/route/move_route_destination.php';
    const MARK_ADDRESS_DEPARTED = self::BASE_URL_1 . '/api/route/mark_address_departed.php';
    const UPDATE_ADDRESS_VISITED = self::BASE_URL_1 . '/actions/address/update_address_visited.php';

    const ADDRESS_BOOK_V4 = self::BASE_URL_1 . '/api.v4/address_book.php';
    const ADDRESS_BOOK_GROUP = self::BASE_URL_1 . '/api.v4/address_book_group.php';
    const ADDRESS_BOOK_SEARCH = self::BASE_URL_1 . '/api/address_book/get_search_group_addresses.php';
    //const MODIFY_CONTACT = '/api/address_book/modify_contact.php';

    const GEOCODER = self::BASE_URL_1 . '/api/geocoder.php';
    //const JSON_GEOCODE = '/actions/upload/json-geocode.php';
    const STREET_DATA = 'https://rapid.route4me.com/street_data/';
    const STREET_DATA_ZIPCODE = 'https://rapid.route4me.com/street_data/zipcode/';
    const STREET_DATA_SERVICE = 'https://rapid.route4me.com/street_data/service/';

    const USER_V4 = self::BASE_URL_1 . '/api.v4/user.php';
    const VERIFY_DEVICE_LICENSE = self::BASE_URL_1 . '/api/device/verify_device_license.php';
    const USER_LICENSE = self::BASE_URL_1 . '/api/member/user_license.php';
    const WEBINAR_REGISTER = self::BASE_URL_1 . '/actions/webinar_register.php';
    //const EXPIRE_SESSION = '/datafeed/session/expire_session.php';
    const VALIDATE_SESSION = self::BASE_URL_1 . '/datafeed/session/validate_session.php';
    const AUTHENTICATE = self::BASE_URL_1 . '/actions/authenticate.php';
    const REGISTER_ACTION = self::BASE_URL_1 . '/actions/register_action.php';
    const VIEW_USER_LOCATIONS = self::BASE_URL_1 . '/api/track/view_user_locations.php';
    const CONFIGURATION_SETTINGS = self::BASE_URL_1 . '/api.v4/configuration-settings.php';

    const OPTIMIZATION_PROBLEM = self::BASE_URL_1 . '/api.v4/optimization_problem.php';
    const HYBRID_DATE_OPTIMIZATION = self::BASE_URL_1 . '/api.v4/hybrid_date_optimization.php';
    const CHANGE_HYBRID_OPTIMIZATION_DEPOT = self::BASE_URL_1 . '/api/change_hybrid_optimization_depot.php';

    const ORDER_V4 = self::BASE_URL_1 . '/api.v4/order.php';
    const ORDER_CUSTOM_FIELDS_V4 = self::BASE_URL_1 . '/api.v4/order_custom_user_fields.php';

    const ROUTE_V4 = self::BASE_URL_1 . '/api.v4/route.php';
    //const ROUTE_DUPLICATE = '/actions/duplicate_route.php';
    //const ROUTES_DELETE = '/actions/delete_routes.php';
    const REOPTIMIZE_V3_2 = self::BASE_URL_1 . '/api.v3/route/reoptimize_2.php';
    const ROUTES_MERGE = self::BASE_URL_1 . '/actions/merge_routes.php';
    const ROUTE_SHARE = self::BASE_URL_1 . '/actions/route/share_route.php';
    const ROUTE_NOTES_ADD = self::BASE_URL_1 . '/actions/addRouteNotes.php';
    const STATUS_V4 = self::BASE_URL_1 . '/api.v4/status.php';

    const GET_DEVICE_LOCATION = self::BASE_URL_1 . '/api/track/get_device_location.php';
    const TRACK_SET = self::BASE_URL_1 . '/track/set.php';
    const USER_LOCATION = self::BASE_URL_1 . '/api/track/view_user_locations.php';

    const NOTE_CUSTOM_TYPES_V4 = self::BASE_URL_1 . '/api.v4/note_custom_types.php';

    //const ViewVehicles = '/api/vehicles/view_vehicles.php';
    const VEHICLE_V4 = self::WH_BASE_URL_1 . '/api/vehicles';
    const VEHICLE_V4_API = self::BASE_URL_1 . '/api.v4/vehicle.php';
    
    const TELEMATICS_VENDORS = "http://telematics.route4me.com/api/vendors.php";
    const TELEMATICS_REGISTER_MEMBER = self::BASE_URL_1 . "/api.v4/telematics/register.php";
    const TELEMATICS_CONNECTION = self::BASE_URL_1 . "/api.v4/telematics/connections.php";
    //const TELEMATICS_VENDORS_INFO = "/api.v4/telematics/vendors.php";

    const MEMBER_CAPABILITIES = self::BASE_URL_1 . "/api/member/capabilities.php";

    const SCHEDULE_CALENDAR = self::BASE_URL_1 . "/api/schedule_calendar_data.php";
}
