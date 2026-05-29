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

// Group products into slides of 4 items each
$chunked_products = array_chunk($products, 4);
?>

<!-- Modern Product Slider Styles -->
<style>
    /* ========== SLIDER SMOOTH TRANSITIONS ========== */
    .product-slider.modern-slider {
        position: relative;
        padding: 0 20px;
    }

    .product-slider.modern-slider .carousel-item {
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.5s ease;
    }

    .product-slider.modern-slider .carousel-inner {
        border-radius: 24px;
        overflow: hidden;
    }

    /* ========== MODERN CARD DESIGN ========== */
    .product-card-modern {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        transition: all 0.35s cubic-bezier(0.2, 0, 0, 1);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        backdrop-filter: blur(0px);
    }

    .product-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 35px -12px rgba(0, 0, 0, 0.15);
    }

    .product-image-modern {
        background: #f8fafc;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
    }

    .product-image-modern img {
        max-height: 160px;
        width: auto;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .product-card-modern:hover .product-image-modern img {
        transform: scale(1.03);
    }

    .product-body-modern {
        padding: 1.25rem 1rem 1.25rem 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-brand-modern {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #3b82f6;
        font-weight: 600;
        margin-bottom: 0.35rem;
    }

    .product-title-modern {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price-modern {
        font-size: 1.2rem;
        font-weight: 800;
        color: #0f172a;
        margin-top: auto;
        letter-spacing: -0.01em;
    }

    .product-price-modern small {
        font-size: 0.8rem;
        font-weight: 500;
        color: #64748b;
    }

    /* ========== CLEAN CAROUSEL CONTROLS ========== */
    .product-slider.modern-slider .carousel-control-prev,
    .product-slider.modern-slider .carousel-control-next {
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 60px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .product-slider.modern-slider:hover .carousel-control-prev,
    .product-slider.modern-slider:hover .carousel-control-next {
        opacity: 0.9;
    }

    .product-slider.modern-slider .carousel-control-prev:hover,
    .product-slider.modern-slider .carousel-control-next:hover {
        background: white;
        opacity: 1;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .product-slider.modern-slider .carousel-control-prev-icon,
    .product-slider.modern-slider .carousel-control-next-icon {
        filter: invert(0.2);
        width: 22px;
        height: 22px;
    }

    /* ========== RESPONSIVE FINE-TUNING ========== */
    @media (max-width: 767.98px) {
        .product-slider.modern-slider {
            padding: 0 8px;
        }
        
        .product-image-modern img {
            max-height: 130px;
        }
        
        .product-title-modern {
            font-size: 0.85rem;
        }
        
        .product-price-modern {
            font-size: 1rem;
        }
        
        .carousel-control-prev,
        .carousel-control-next {
            width: 36px;
            height: 36px;
        }
    }

    /* Smooth carousel container */
    .product-slider.modern-slider .carousel-item .row {
        --bs-gutter-x: 1.2rem;
        --bs-gutter-y: 0;
    }
    
    .col.mb-4 {
        margin-bottom: 1.5rem !important;
    }
    
    /* Make cards equal height */
    .product-slider.modern-slider .carousel-item .row > [class*="col"] {
        display: flex;
    }
</style>

<div id="<?php echo htmlspecialchars($slider_id, ENT_QUOTES) ?>" class="carousel slide product-slider modern-slider" data-ride="carousel" data-interval="false" data-wrap="true">
    <div class="carousel-inner">
        <?php foreach ($chunked_products as $chunk_index => $chunk): ?>
            <div class="carousel-item <?php echo $chunk_index === 0 ? 'active' : '' ?>">
                <div class="row gx-3 gx-lg-4 row-cols-2 row-cols-lg-4">
                    <?php foreach ($chunk as $row): ?>
                        <?php
                            // Product image handling
                            $upload_path = base_app . '/uploads/product_' . $row['id'];
                            $img = "";
                            if (is_dir($upload_path)) {
                                $fileO = scandir($upload_path);
                                if (isset($fileO[2])) {
                                    $img = 'uploads/product_' . $row['id'] . '/' . $fileO[2];
                                }
                            }
                            
                            // Fallback placeholder if no image found
                            if (empty($img)) {
                                $img = 'https://placehold.co/400x300/f1f5f9/1e293b?text=No+Image';
                            }

                            // Clean data
                            foreach ($row as $k => $v) {
                                $row[$k] = trim(stripslashes($v));
                            }

                            // Get product price range (fixed distinct query)
                            $inventory = $conn->query("SELECT DISTINCT price FROM inventory WHERE product_id = " . $row['id'] . " ORDER BY price ASC");
                            $inv = array();
                            while ($ir = $inventory->fetch_assoc()) {
                                $inv[] = format_num($ir['price']);
                            }

                            $price = '';
                            if (isset($inv[0])) {
                                $price .= $inv[0];
                            }
                            if (count($inv) > 1) {
                                $price .= " <small>–</small> " . $inv[count($inv) - 1];
                            }
                            
                            // If no price found, show default
                            if (empty($price)) {
                                $price = '<small>Price on request</small>';
                            }
                        ?>
                        <div class="col mb-4 d-flex">
                            <!-- Modern product card structure (replaces product_card.php include but preserves functionality) -->
                            <div class="product-card-modern w-100">
                                <div class="product-image-modern">
                                    <img src="<?php echo htmlspecialchars($img, ENT_QUOTES) ?>" 
                                         class="img-fluid" 
                                         alt="<?php echo htmlspecialchars($row['name'], ENT_QUOTES) ?>"
                                         loading="lazy">
                                </div>
                                <div class="product-body-modern">
                                    <?php if (!empty($row['bname'])): ?>
                                        <div class="product-brand-modern"><?php echo htmlspecialchars($row['bname'], ENT_QUOTES) ?></div>
                                    <?php endif; ?>
                                    <h5 class="product-title-modern"><?php echo htmlspecialchars($row['name'], ENT_QUOTES) ?></h5>
                                    <div class="product-price-modern">
                                        <?php echo $price; ?>
                                    </div>
                                </div>
                            </div>
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

<script>
// Ensures smooth carousel behavior and active state consistency (optional micro fix)
(function() {
    var carouselElement = document.getElementById('<?php echo htmlspecialchars($slider_id, ENT_QUOTES) ?>');
    if (carouselElement && typeof $ !== 'undefined') {
        // Reinitialize carousel to guarantee smooth transition if needed
        $(carouselElement).carousel({
            interval: false,
            wrap: true
        });
    }
})();
</script>