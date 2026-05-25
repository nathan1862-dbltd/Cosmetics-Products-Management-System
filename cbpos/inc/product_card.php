<?php
$card_col_class = isset($card_col_class) ? $card_col_class : 'col mb-5';
$card_price_label_class = isset($card_price_label_class) ? $card_price_label_class : 'text-muted';
?>
<div class="<?php echo $card_col_class ?>">
    <a class="card product-item text-reset text-decoration-none h-100" href=".?p=view_product&id=<?php echo md5($row['id']) ?>">
        <div class="overflow-hidden shadow product-holder">
            <img class="card-img-top w-100 product-cover" src="<?php echo validate_image($img) ?>" alt="<?php echo htmlspecialchars($row['name']) ?>" />
        </div>
        <div class="card-body p-4">
            <div>
                <h5 class="fw-bolder"><?php echo $row['name'] ?></h5>
                <span><b class="<?php echo $card_price_label_class ?>">Price: </b><?php echo $price ?></span>
                <p class="m-0"><small><span class="text-muted">Brand:</span> <?php echo $row['bname'] ?></small></p>
                <p class="m-0"><small><span class="text-muted">Category:</span> <?php echo $row['category'] ?></small></p>
            </div>
        </div>
    </a>
</div>
