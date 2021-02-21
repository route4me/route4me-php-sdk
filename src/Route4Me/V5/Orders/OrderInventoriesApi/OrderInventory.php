<?php


namespace Route4Me\V5\Orders\OrderInventoriesApi;

/**
 * Class OrderInventory
 * @package Route4Me\V5\Orders\OrderInventoriesApi
 * Order inventory class
 */
class OrderInventory extends \Route4Me\Common
{
    /** Unique inventory ID
     * @var integer $inventory_id
     */
    public $inventory_id;

    /** Unique order ID
     * @var integer $order_id
     */
    public $order_id;

    /** Order inventory name
     * @var string $name
     */
    public $name;

    /** Order inventory quantity
     * @var integer $quantity
     */
    public $quantity;

    /** Total weight of the order inventory.
     * @var double $total_weight
     */
    public $total_weight;

    /** Total volume of the inventory.
     * @var double $total_volume
     */
    public $total_volume;

    /** Total cost of the inventory.
     * @var double $total_cost
     */
    public $total_cost;

    /** Total price of the inventory.
     * @var double $total_price
     */
    public $total_price;

    /** When the inventory created.
     * @var string $created_at
     */
    public $created_at;

    /** When the inventory updated.
     * @var string $updated_at
     */
    public $updated_at;

    public static function fromArray(array $params)
    {
        $orderInventory = new self();

        foreach ($params as $key => $value) {
            if (property_exists($orderInventory, $key)) {
                $orderInventory->{$key} = $value;
            }
        }

        return $orderInventory;
    }

}