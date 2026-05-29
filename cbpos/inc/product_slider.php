<?php
if (!isset($products) || !is_array($products) || empty($products)) {
    return;
}

$chunked_products = array_chunk($products, 4);
?>

<div id="<?php echo $slider_id; ?>" class="carousel slide" data-ride="carousel" data-interval="5000">

    <div class="carousel-inner">

        <?php foreach ($chunked_products as $chunk_index => $chunk): ?>

            <div class="carousel-item <?php echo ($chunk_index == 0) ? 'active' : ''; ?>">

                <div class="row">

                    <?php foreach ($chunk as $row): ?>

                        <?php
                        $upload_path = base_app . '/uploads/product_' . $row['id'];
                        $img = '';

                        if (is_dir($upload_path)) {
                            $fileO = scandir($upload_path);
                            if (isset($fileO[2])) {
                                $img = 'uploads/product_' . $row['id'] . '/' . $fileO[2];
                            }
                        }

                        foreach ($row as $k => $v) {
                            $row[$k] = trim(stripslashes($v));
                        }

                        $inventory = $conn->query("SELECT DISTINCT(price) FROM inventory WHERE product_id = {$row['id']} ORDER BY price ASC");

                        $inv = [];
                        while ($ir = $inventory->fetch_assoc()) {
                            $inv[] = format_num($ir['price']);
                        }

                        $price = '';
                        if (isset($inv[0])) {
                            $price .= $inv[0];
                        }
                        if (count($inv) > 1) {
                            $price .= ' ~ ' . end($inv);
                        }

                        $product_id = $row['id'];
                        $product_name = $row['name'];
                        $product_brand = $row['bname'];
                        $product_category = $row['category'];
                        $product_price = $price;
                        $product_image = $img;
                        ?>

                        <div class="col-6 col-md-3 mb-4">
                            <?php include base_app . '/inc/product_card.php'; ?>
                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <?php if (count($chunked_products) > 1): ?>

        <a class="carousel-control-prev"
           href="#<?php echo $slider_id; ?>"
           role="button"
           data-slide="prev">

            <span class="carousel-control-prev-icon"></span>
        </a>

        <a class="carousel-control-next"
           href="#<?php echo $slider_id; ?>"
           role="button"
           data-slide="next">

            <span class="carousel-control-next-icon"></span>
        </a>

    <?php endif; ?>

</div>

<style>
.carousel-control-prev,
.carousel-control-next{
    width:50px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon{
    background-color:rgba(0,0,0,.6);
    border-radius:50%;
    padding:20px;
}

.carousel-item{
    transition:transform .6s ease-in-out;
}
</style>