<?php
if (!isset($products) || !is_array($products) || empty($products)) {
    return;
}
?>

<div class="product-slider-wrapper">

    <button class="slider-btn prev-btn">&#10094;</button>

    <div class="product-slider-track" id="<?php echo $slider_id; ?>">

        <?php foreach($products as $row): ?>

            <?php
            $upload_path = base_app . '/uploads/product_' . $row['id'];
            $img = '';

            if(is_dir($upload_path)){
                $fileO = scandir($upload_path);
                if(isset($fileO[2])){
                    $img = 'uploads/product_' . $row['id'] . '/' . $fileO[2];
                }
            }

            $inventory = $conn->query("
                SELECT DISTINCT(price)
                FROM inventory
                WHERE product_id = {$row['id']}
                ORDER BY price ASC
            ");

            $inv = [];

            while($ir = $inventory->fetch_assoc()){
                $inv[] = format_num($ir['price']);
            }

            $price = '';
            if(isset($inv[0])) $price = $inv[0];
            if(count($inv) > 1) $price .= ' ~ '.end($inv);
            ?>

            <div class="product-slide">

                <a href="./?p=view_product&id=<?php echo $row['id']; ?>" class="product-link">

                    <div class="product-card">

                        <img
                            src="<?php echo validate_image($img); ?>"
                            alt="<?php echo htmlspecialchars($row['name']); ?>"
                            class="product-image">

                        <div class="product-info">

                            <div class="product-name">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </div>

                            <div class="product-brand">
                                <?php echo htmlspecialchars($row['bname']); ?>
                            </div>

                            <?php if(!empty($price)): ?>
                                <div class="product-price">
                                    $<?php echo $price; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>

                </a>

            </div>

        <?php endforeach; ?>

    </div>

    <button class="slider-btn next-btn">&#10095;</button>

</div>

<style>

.product-slider-wrapper{
    position:relative;
    width:100%;
    overflow:hidden;
}

.product-slider-track{
    display:flex;
    gap:20px;
    transition:transform .5s ease;
}

.product-slide{
    flex:0 0 calc(25% - 15px);
}

@media(max-width:768px){
    .product-slide{
        flex:0 0 calc(50% - 10px);
    }
}

.product-link{
    text-decoration:none;
    color:inherit;
}

.product-card{
    background:#fff;
    border:1px solid #eee;
    border-radius:12px;
    overflow:hidden;
    height:100%;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.product-image{
    width:100%;
    height:220px;
    object-fit:cover;
}

.product-info{
    padding:15px;
}

.product-name{
    font-size:16px;
    font-weight:600;
    margin-bottom:5px;
}

.product-brand{
    color:#777;
    font-size:14px;
    margin-bottom:8px;
}

.product-price{
    color:#28a745;
    font-size:18px;
    font-weight:700;
}

.slider-btn{
    position:absolute;
    top:45%;
    transform:translateY(-50%);
    z-index:100;
    border:none;
    width:42px;
    height:42px;
    border-radius:50%;
    background:rgba(0,0,0,.7);
    color:#fff;
    cursor:pointer;
}

.prev-btn{
    left:10px;
}

.next-btn{
    right:10px;
}

</style>

<script>

document.addEventListener('DOMContentLoaded', function(){

    const slider = document.getElementById('<?php echo $slider_id; ?>');

    const prevBtn = slider.parentElement.querySelector('.prev-btn');
    const nextBtn = slider.parentElement.querySelector('.next-btn');

    let position = 0;

    function cardWidth(){
        const card = slider.querySelector('.product-slide');
        return card ? card.offsetWidth + 20 : 0;
    }

    nextBtn.addEventListener('click', function(){

        const maxScroll = slider.scrollWidth - slider.parentElement.offsetWidth;

        position += cardWidth();

        if(position > maxScroll){
            position = 0;
        }

        slider.style.transform = `translateX(-${position}px)`;
    });

    prevBtn.addEventListener('click', function(){

        position -= cardWidth();

        if(position < 0){
            position = 0;
        }

        slider.style.transform = `translateX(-${position}px)`;
    });

    setInterval(function(){

        const maxScroll = slider.scrollWidth - slider.parentElement.offsetWidth;

        position += cardWidth();

        if(position > maxScroll){
            position = 0;
        }

        slider.style.transform = `translateX(-${position}px)`;

    }, 3000);

});

</script>