<?php

namespace Route4Me\V5\Enum;

class Endpoint
{
    const API_VERSION = "5";

    const MAIN_HOST = "https://wh.route4me.com/modules/api/v5.0";

    const MAIN_HOST_WEB = "https://wh.route4me.com/modules/webapi/v5.0";

    // <editor-fold defaultstate="collapsed" desc="region Routes">

    const Routes = self::MAIN_HOST . "/routes";
    const RoutesDuplicate = self::MAIN_HOST . "/routes/duplicate";
    const RoutesMerge = self::MAIN_HOST . "/routes/merge";
    const RoutesPaginate = self::MAIN_HOST . "/routes/paginate";
    const RoutesFallbackPaginate = self::MAIN_HOST . "/routes/fallback/paginate";
    const RoutesFallbackDatatable = self::MAIN_HOST . "/routes/fallback/datatable";
    const RoutesFallback = self::MAIN_HOST . "/routes/fallback";
    const RoutesReindexCallback = self::MAIN_HOST . "/routes/reindex-callback";
    const RoutesDatatable = self::MAIN_HOST . "/routes/datatable";
    const RoutesDatatableConfig = self::MAIN_HOST . "/routes/datatable/config";
    const RoutesDatatableConfigFallback = self::MAIN_HOST . "/routes/fallback/datatable/config";

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Team Users">

    const TEAM_USERS = self::MAIN_HOST . "/team/users";
    const TEAM_USERS_BULK_INSERT = self::MAIN_HOST . "/team/bulk-insert";
    const DriverReview = self::MAIN_HOST . "/driver-reviews";

    // </editor-fold>
    
    const ACCOUNT_PROFILE = self::MAIN_HOST . "/profile-api";

    // <editor-fold defaultstate="collapsed" desc="Vehicles">

    const Vehicles = self::MAIN_HOST . "/vehicles";
    const VehicleTemporary = self::MAIN_HOST . "/vehicles/assign";
    const VehicleExecuteOrder = self::MAIN_HOST . "/vehicles/execute";
    const VehicleLocation = self::MAIN_HOST . "/vehicles/location";
    const VehicleProfiles = self::MAIN_HOST . "/vehicle-profiles";
    const VehicleLicense = self::MAIN_HOST . "/vehicles/license";
    const VehicleSearch = self::MAIN_HOST . "/vehicles/search";

    const RECURRING_ROUTES = self::MAIN_HOST . "/recurring-routes";
    const RECURRING_ROUTES_SCHEDULES = self::MAIN_HOST . "/recurring-routes/schedules";
    const RECURRING_ROUTES_SCHEDULES_PAGINATION = self::MAIN_HOST . "/recurring-routes/schedules/pagination";
    const RECURRING_ROUTES_ROUTE_SCHEDULES = self::MAIN_HOST . "/recurring-routes/route-schedules";
    const RECURRING_ROUTES_ROUTE_SCHEDULES_PAGINATION =
        self::MAIN_HOST . "/recurring-routes/route-schedules/pagination";
    const RECURRING_ROUTES_ROUTE_SCHEDULES_REPLACE = self::MAIN_HOST . "/recurring-routes/route-schedules/replace";
    const RECURRING_ROUTES_SCHEDULED_ROUTES_IS_COPY = self::MAIN_HOST . "/recurring-routes/scheduled-routes/is-copy";
    const RECURRING_ROUTES_SCHEDULED_ROUTES_GET_COPIES =
        self::MAIN_HOST . "/recurring-routes/scheduled-routes/get-copies";
    const RECURRING_ROUTES_MASTER_ROUTES = self::MAIN_HOST . "/recurring-routes/master-routes";

    // </editor-fold>
 
    // <editor-fold defaultstate="collapsed" desc="Telematicx Platform">
    
    const STAGING_HOST = "https://virtserver.swaggerhub.com/Route4Me/telematics-gateway/1.0.0";

    const TELEMATICS_CONNECTION = self::STAGING_HOST."/connections";
    const TELEMATICS_CONNECTION_VEHICLES = self::STAGING_HOST . "/connections/{connection_token}/vehicles";

    const TELEMATICS_ACCESS_TOKEN = self::STAGING_HOST . "/access-tokens";
    const TELEMATICS_ACCESS_TOKEN_SCHEDULES = self::STAGING_HOST . "/access-token-schedules";
    const TELEMATICS_ACCESS_TOKEN_SCHEDULE_ITEMS = self::STAGING_HOST . "/access-token-schedules/{schedule_id}/items";

    const TELEMATICS_VEHICLE_GROUPS = self::STAGING_HOST . "/vehicle-groups";
    const TELEMATICS_VEHICLE_GROUPS_RELATION = self::STAGING_HOST . "/vehicle-groups/{vehicle_group_id}/{relation}";
    const TELEMATICS_VEHICLES_RESLATION = self::STAGING_HOST . "/vehicles/{vehicle_id}/{relation}";

    const TELEMATICS_INFO_MEMBERS = self::STAGING_HOST . "/info/members";
    const TELEMATICS_INFO_VEHICLES = self::STAGING_HOST . "/info/vehicles";
    const TELEMATICS_INFO_VEHICLE = self::STAGING_HOST . "/info/vehicle/{vehicle_id}/track";
    const TELEMATICS_INFO_MODULES = self::STAGING_HOST . "/info/members";

    const TELEMATICS_ADDRESSES = self::STAGING_HOST . "/addresses";

    const TELEMATICS_Errors = self::STAGING_HOST . "/errors";

    const TELEMATICS_CUSTOMER_NOTIFICATIONS = self::STAGING_HOST . "​/customers​/{customer_id}​/notifications​";
    const TELEMATICS_CUSTOMERS = self::STAGING_HOST . "/customers";
    const TELEMATICS_CUSTOMER_ID = self::STAGING_HOST . "/customers/{customer_id}";

    const TELEMATICS_NOTIFICATION_SCHEDULE_ITEMS = self::STAGING_HOST . "/notification-schedules/{notification_schedule_id}/items";
    const TELEMATICS_NOTIFICATION_SCHEDULES = self::STAGING_HOST . "/notification-schedules";
    const TELEMATICS_NOTIFICATION_SCHEDULE_IS = self::STAGING_HOST . "/notification-schedules/{schedule_id}";
    const TELEMATICS_ONETIME_NOTIFICATIONS = self::STAGING_HOST . "​/one-time-notifications";

    const TELEMATICS_MEMBER = self::STAGING_HOST;

    const TELEMATICS_MEMBER_MODULES = self::STAGING_HOST . "​/user-activated-modules";

    const TELEMATICS_MEMBER_MODULE_ID = self::STAGING_HOST . "​/user-activated-modules/{module_id}";
    const TELEMATICS_MEMBER_MODULE_VEHICLES = self::STAGING_HOST . "​​/user-activated-modules​/{module_id}​/vehicles";
    const TELEMATICS_MEMBER_MODULE_VEHICLE_ID = self::STAGING_HOST . "​​​/user-activated-modules​/{module_id}​/vehicles​/{vehicle_id}";

    const TELEMATICS_VENDORS = self::STAGING_HOST . "​/vendors";
    const TELEMATICS_VENDOR_ID = self::STAGING_HOST . "​​/vendors​/{vendor_id}";
    
    // </editor-fold>

    const ADDRESSES = self::MAIN_HOST . "/address-book/addresses";
    const ADDRESSES_BATCH_CREATE = self::MAIN_HOST . "/address-book/addresses/batch-create";
    const ADDRESSES_INDEX_ALL = self::MAIN_HOST . "/address-book/addresses/index/all";
    const ADDRESSES_INDEX_PAGINATION = self::MAIN_HOST . "/address-book/addresses/index/pagination";
    const ADDRESSES_INDEX_CLUSTERING = self::MAIN_HOST . "/address-book/addresses/index/clustering";
    const ADDRESSES_SHOW = self::MAIN_HOST . "/address-book/addresses/show";
    const ADDRESSES_BATCH_UPDATE = self::MAIN_HOST . "/address-book/addresses/batch-update";
    const ADDRESSES_UPDATE_BY_AREAS = self::MAIN_HOST . "/address-book/addresses/update-by-areas";
    const ADDRESSES_DELETE = self::MAIN_HOST . "/address-book/addresses/delete";
    const ADDRESSES_DELETE_BY_AREAS = self::MAIN_HOST . "/address-book/addresses/delete-by-areas";
    const ADDRESSES_CUSTOM_FIELDS = self::MAIN_HOST . "/address-book/addresses/custom-fields";
    const ADDRESSES_DEPOTS = self::MAIN_HOST . "/address-book/addresses/depots";
    const ADDRESSES_EXPORT = self::MAIN_HOST . "/address-book/addresses/export";
    const ADDRESSES_EXPORT_BY_AREAS = self::MAIN_HOST . "/address-book/addresses/export-by-areas";
    const ADDRESSES_EXPORT_BY_AREA_IDS = self::MAIN_HOST . "/address-book/addresses/export-by-area-ids";
    const ADDRESSES_JOB_TRACKER_STATUS = self::MAIN_HOST . "/address-book/addresses/job-tracker/status";
    const ADDRESSES_JOB_TRACKER_RESULT = self::MAIN_HOST . "/address-book/addresses/job-tracker/result";

    const POD_WORKFLOW = self::MAIN_HOST . "/workflows";

    const ORDER = self::MAIN_HOST . "/orders-platform";
    const ORDER_CREATE = self::ORDER . "/create";
    const ORDER_BATCH_CREATE = self::ORDER . "/batch-create";
    const ORDER_BATCH_DELETE = self::ORDER . "/batch-delete";
    const ORDER_BATCH_UPDATE = self::ORDER . "/batch-update";
    const ORDER_BATCH_UPDATE_FILTER = self::ORDER_BATCH_UPDATE . "/filter";
    const ORDER_CUSTOM_FIELDS = self::ORDER . "/order-custom-user-fields";

    const OPTIMIZATION_PROFILES_LIST = self::MAIN_HOST . "/optimization-profiles/data-list";
    const OPTIMIZATION_PROFILES_SAVE = self::MAIN_HOST . "/optimization-profiles/save-entities";
    const OPTIMIZATION_PROFILES_DELETE = self::MAIN_HOST . "/optimization-profiles/delete-entities";
}
