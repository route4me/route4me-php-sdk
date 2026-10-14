<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

class ApiCapabilities extends \Route4Me\Common
{
    /** Sortable Fields.
     * @var string[]
     */
    public $sortable_fields = [];

    /** Combinations of the sortable fields.
     * @var array
     */
    public $sortable_fields_combinations = [];

    /** If true, multi-sorting enabled.
     * @var bool
     */
    public $multi_sorting_enabled;

    /** An array of the filterable fields.
     * @var string[]
     */
    public $filterable_fields = [];

    /** If true, search enabled.
     * @var bool
     */
    public $search;
}
