<?php
/**
 * Homepage New Arrivals product slider.
 *
 * Optional variables:
 * - $brands : array of brand ids used by the homepage filter
 */

$where = "";
if (isset($brands) && is_array($brands) && count($brands) > 0) {
    $brand_ids = array_map('intval', $brands);
    $brand_ids = array_filter($brand_ids, function($brand_id) {
        return $brand_id > 0;
    });

    if (count($brand_ids) > 0) {
        $where = " and p.brand_id in (" . implode(",", $brand_ids) . ") ";
    }
}

$new_arrival_products = array();
$product_query = $conn->query("SELECT p.*,b.name as bname,c.category FROM `products` p inner join brands b on p.brand_id = b.id inner join categories c on p.category_id = c.id where p.status = 1 {$where} order by p.date_created desc, p.id desc limit 12");
while ($row = $product_query->fetch_assoc()) {
    $new_arrival_products[] = $row;
}

$slider_id = "new-arrivals-slider";
$products = $new_arrival_products;
include base_app . '/inc/product_slider.php';
