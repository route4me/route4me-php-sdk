<?php
namespace Route4Me\Enum;

class Endpoint
{
  const BASE_URL = 'https://api.route4me.com';
  const WH_BASE_URL = 'https://wh.route4me.com/modules';
  
  const AVOIDANCE_ZONE = '/api.v4/avoidance.php';
  const TERRITORY_V4 = '/api.v4/territory.php';
  
  const GET_ACTIVITIES = '/api/get_activities.php';
  const ACTIVITY_FEED = '/api.v4/activity_feed.php';
  
  const ADDRESS_V4 = '/api.v4/address.php';
  const MOVE_ROUTE_DESTINATION = '/actions/route/move_route_destination.php';
  const MARK_ADDRESS_DEPARTED = '/api/route/mark_address_departed.php';
  const UPDATE_ADDRESS_VISITED = '/actions/address/update_address_visited.php';
  
  const ADDRESS_BOOK_V4 = '/api.v4/address_book.php';
  const MODIFY_CONTACT = '/api/address_book/modify_contact.php';
  
  const GEOCODER = '/api/geocoder.php';
  const JSON_GEOCODE = '/actions/upload/json-geocode.php';
  const STREET_DATA = 'https://rapid.route4me.com/street_data/';
  const STREET_DATA_ZIPCODE = 'https://rapid.route4me.com/street_data/zipcode/';
  const STREET_DATA_SERVICE = 'https://rapid.route4me.com/street_data/service/';
  
  const USER_V4 = '/api.v4/user.php';
  const VERIFY_DEVICE_LICENSE = '/api/device/verify_device_license.php';
  const USER_LICENSE = '/api/member/user_license.php';
  const WEBINAR_REGISTER = '/actions/webinar_register.php';
  const EXPIRE_SESSION = '/datafeed/session/expire_session.php';
  const VALIDATE_SESSION = '/datafeed/session/validate_session.php';
  const AUTHENTICATE = '/actions/authenticate.php';
  const REGISTER_ACTION = '/actions/register_action.php';
  const VIEW_USER_LOCATIONS = '/api/track/view_user_locations.php';
  const CONFIGURATION_SETTINGS = '/api.v4/configuration-settings.php';
  
  const OPTIMIZATION_PROBLEM = '/api.v4/optimization_problem.php';
  const HYBRID_DATE_OPTIMIZATION = '/api.v4/hybrid_date_optimization.php';
  const CHANGE_HYBRID_OPTIMIZATION_DEPOT = '/api/change_hybrid_optimization_depot.php';
  
  const ORDER_V4 = '/api.v4/order.php';
  
  const ROUTE_V4 = '/api.v4/route.php';
  const ROUTE_DUPLICATE ='/actions/duplicate_route.php';
  const ROUTES_DELETE ='/actions/delete_routes.php';
  const REOPTIMIZE_V3_2 ='/api.v3/route/reoptimize_2.php';
  const ROUTES_MERGE ='/actions/merge_routes.php';
  const ROUTE_SHARE ='/actions/route/share_route.php';
  const ROUTE_NOTES_ADD ='/actions/addRouteNotes.php';
  const STATUS_V4 ='/api.v4/status.php';
  const GET_DEVICE_LOCATION ='/api/track/get_device_location.php';
  
  const NOTE_CUSTOM_TYPES_V4 ='/api.v4/note_custom_types.php';
  
  const VEHICLE_V4 = '/api/vehicles';
}
