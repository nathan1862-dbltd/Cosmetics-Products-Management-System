<?php
/**
 * Reusable product slider wrapper.
 *
 * Expected variables:
 * - $products : array of product rows with id,name,bname,category
 * - $slider_id : unique id string for carousel
 */

if (!isset($products) || !is_array($products) || empty($products)) {
    return;
}

$chunked_products = array_chunk($products, 4);
?>

<div id="<?php echo htmlspecialchars($slider_id, ENT_QUOTES) ?>" class="carousel slide product-slider" data-ride="carousel" data-interval="false">
    <div class="carousel-inner">
        <?php foreach ($chunked_products as $chunk_index => $chunk): ?>
            <div class="carousel-item <?php echo $chunk_index === 0 ? 'active' : '' ?>">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-lg-4">
                    <?php foreach ($chunk as $row): ?>
                        <?php
                            $upload_path = base_app . '/uploads/product_' . $row['id'];
                            $img = "";
                            if (is_dir($upload_path)) {
                                $fileO = scandir($upload_path);
                                if (isset($fileO[2])) {
                                    $img = 'uploads/product_' . $row['id'] . '/' . $fileO[2];
                                }
                            }

                            foreach ($row as $k => $v) {
                                $row[$k] = trim(stripslashes($v));
                            }

                            $inventory = $conn->query("SELECT distinct(`price`) FROM inventory where product_id = " . $row['id'] . " order by `price` asc");
                            $inv = array();
                            while ($ir = $inventory->fetch_assoc()) {
                                $inv[] = format_num($ir['price']);
                            }

                            $price = '';
                            if (isset($inv[0])) {
                                $price .= $inv[0];
                            }
                            if (count($inv) > 1) {
                                $price .= " ~ " . $inv[count($inv) - 1];
                            }
                        ?>
                        <div class="col mb-4">
                            <?php
                                $product_id = $row['id'];
                                $product_name = $row['name'];
                                $product_brand = $row['bname'];
                                $product_category = $row['category'];
                                $product_price = $price;
                                $product_image = $img;
                                include base_app . '/inc/product_card.php';
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (count($chunked_products) > 1): ?>
        <button class="carousel-control-prev" type="button" data-target="#<?php echo htmlspecialchars($slider_id, ENT_QUOTES) ?>" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#<?php echo htmlspecialchars($slider_id, ENT_QUOTES) ?>" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    <?php endif; ?>
</div>
