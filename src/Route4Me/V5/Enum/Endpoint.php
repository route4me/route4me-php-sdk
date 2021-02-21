<?php


namespace Route4Me\V5\Enum;


class Endpoint
{
    const API_VERSION = "5";

    const MAIN_HOST = "https://wh.route4me.com/modules/api/v5.0";

    const MAIN_HOST_WEB = "https://wh.route4me.com/modules/webapi/v5.0";

    //region Routes

    const Routes = "https://wh.route4me.com/modules/api/v5.0/routes";
    const RoutesDuplicate = "https://wh.route4me.com/modules/api/v5.0/routes/duplicate";
    const RoutesMerge = "https://wh.route4me.com/modules/api/v5.0/routes/merge";
    const RoutesPaginate = "https://wh.route4me.com/modules/api/v5.0/routes/paginate";
    const RoutesFallbackPaginate = "https://wh.route4me.com/modules/api/v5.0/routes/fallback/paginate";
    const RoutesFallbackDatatable = "https://wh.route4me.com/modules/api/v5.0/routes/fallback/datatable";
    const RoutesFallback = "https://wh.route4me.com/modules/api/v5.0/routes/fallback";
    const RoutesReindexCallback = "https://wh.route4me.com/modules/api/v5.0/routes/reindex-callback";
    const RoutesDatatable = "https://wh.route4me.com/modules/api/v5.0/routes/datatable";
    const RoutesDatatableConfig = "https://wh.route4me.com/modules/api/v5.0/routes/datatable/config";
    const RoutesDatatableConfigFallback = "https://wh.route4me.com/modules/api/v5.0/routes/fallback/datatable/config";

    //endregion

    //region Team Users
    const TeamUsers = "https://wh.route4me.com/modules/api/v5.0/team/users";

    const TeamUsersBulkCreate = "https://wh.route4me.com/modules/api/v5.0/team/bulk-insert";

    const DriverReview = "https://wh.route4me.com/modules/api/v5.0/driver-reviews";

    //endregion

    //region Vehicles

    const Vehicles = "https://wh.route4me.com/modules/api/v5.0/vehicles";

    const VehicleTemporary = "https://wh.route4me.com/modules/api/v5.0/vehicles/assign";

    const VehicleExecuteOrder = "https://wh.route4me.com/modules/api/v5.0/vehicles/execute";

    const VehicleLocation = "https://wh.route4me.com/modules/api/v5.0/vehicles/location";

    const VehicleProfiles = "https://wh.route4me.com/modules/api/v5.0/vehicle-profiles";

    const VehicleLicense = "https://wh.route4me.com/modules/api/v5.0/vehicles/license";

    const VehicleSearch = "https://wh.route4me.com/modules/api/v5.0/vehicles/search";

    //endregion

}