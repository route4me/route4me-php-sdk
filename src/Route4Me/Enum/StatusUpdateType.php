<?php
namespace Route4Me\Enum;

class StatusUpdateType
{
    const PICKUP                         = 'pickup';
    const DROPOFF                        = 'dropoff';
    const NOANSWER                       = 'noanswer';
    const NOTFOUND                       = 'notfound';
    const NOTPAID                        = 'notpaid';
    const PAID                           = 'paid';
    const WRONGDELIVERY                  = 'wrongdelivery';
    const WRONGADDRESSRECIPIENT          = 'wrongaddressrecipient';
    const NOTPRESENT                     = 'notpresent';
    const PARTS_MISSING                  = 'parts_missing';
    const SERVICE_RENDERED               = 'service_rendered';
    const FOLLOW_UP                      = 'follow_up';
    const LEFT_INFORMATION               = 'left_information';
    const SPOKE_WITH_DECISION_MAKER      = 'spoke_with_decision_maker';
    const SPOKE_WITH_DECISION_INFLUENCER = 'spoke_with_decision_influencer';
    const SPOKE_WITH_DECISION_INFLUENCER = 'spoke_with_decision_influencer';
    const COMPETITIVE_ACCOUNT            = 'competitive_account';
    const SCHEDULED_FOLLOW_UP_MEETING    = 'scheduled_follow_up_meeting';
    const SCHEDULED_LUNCH                = 'scheduled_lunch';
    const SCHEDULED_PRODUCT_DEMO         = 'scheduled_product_demo';
    const SCHEDULED_CLINICAL_DEMO        = 'scheduled_clinical_demo';
    const NO_OPPORTUNITY                 = 'no_opportunity';
}
