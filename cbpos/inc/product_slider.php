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

            $inventory = $conn->query("SELECT DISTINCT(price) FROM inventory WHERE product_id=".$row['id']." ORDER BY price ASC");

            $inv = [];
            while($ir = $inventory->fetch_assoc()){
                $inv[] = format_num($ir['price']);
            }

            $price = '';
            if(isset($inv[0])) $price = $inv[0];
            if(count($inv) > 1) $price .= ' ~ '.end($inv);

            $product_id = $row['id'];
            $product_name = $row['name'];
            $product_brand = $row['bname'];
            $product_category = $row['category'];
            $product_price = $price;
            $product_image = $img;
            ?>

            <div class="product-slide">
                <?php include base_app.'/inc/product_card.php'; ?>
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

.slider-btn{
    position:absolute;
    top:45%;
    z-index:10;
    border:none;
    background:rgba(0,0,0,.6);
    color:#fff;
    width:40px;
    height:40px;
    cursor:pointer;
}

.prev-btn{
    left:0;
}

.next-btn{
    right:0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){

    const slider = document.getElementById('<?php echo $slider_id; ?>');

    const prevBtn = slider.parentElement.querySelector('.prev-btn');
    const nextBtn = slider.parentElement.querySelector('.next-btn');

    const cardWidth = () => {
        const card = slider.querySelector('.product-slide');
        return card.offsetWidth + 20;
    };

    let position = 0;

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

    },3000);

});
</script>