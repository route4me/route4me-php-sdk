<?php

namespace Route4Me\V5\Orders\OrderInventoriesApi;

/**
 * Class OrderInventory.
 */
class OrderInventory extends \Route4Me\Common
{
    /** Unique inventory ID.
     * @var int
     */
    public $inventory_id;

    /** Unique order ID.
     * @var int
     */
    public $order_id;

    /** Order inventory name.
     * @var string
     */
    public $name;

    /** Order inventory quantity.
     * @var int
     */
    public $quantity;

    /** Total weight of the order inventory.
     * @var float
     */
    public $total_weight;

    /** Total volume of the inventory.
     * @var float
     */
    public $total_volume;

    /** Total cost of the inventory.
     * @var float
     */
    public $total_cost;

    /** Total price of the inventory.
     * @var float
     */
    public $total_price;

    /** When the inventory created.
     * @var string
     */
    public $created_at;

    /** When the inventory updated.
     * @var string
     */
    public $updated_at;
}
