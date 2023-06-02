<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

class ApiCapabilities extends \Route4Me\Common
{
    /** Sortable Fields
     * @var string[] $sortable_fields
     */
    public $sortable_fields = [];

    /** Combinations of the sortable fields
     * @var Array $sortable_fields_combinations
     */
    public $sortable_fields_combinations = [];

    /** If true, multi-sorting enabled.
     * @var boolean $multi_sorting_enabled
     */
    public $multi_sorting_enabled;

    /** An array of the filterable fields.
     * @var string[] $filterable_fields
     */
    public $filterable_fields = [];

    /** If true, search enabled.
     * @var boolean $search
     */
    public $search;
}
