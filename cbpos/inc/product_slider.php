<?php
/**
 * Sephora‑style product slider – clickable cards (MD5 product ID), smaller padding.
 * Expected variables:
 * - $products : array of product rows with id,name,bname,category
 * - $slider_id : unique id string for carousel
 */

if (!isset($products) || !is_array($products) || empty($products)) {
    return;
}
?>

<style>
    /* ----- Slider container – reduced padding ----- */
    .sephora-slider-<?php echo $slider_id; ?> {
        position: relative;
        width: 100%;
        padding: 0 16px;
        box-sizing: border-box;
    }

    /* Scrollable track */
    .sephora-track-<?php echo $slider_id; ?> {
        display: flex;
        flex-flow: row nowrap;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        gap: 1rem;
        padding: 0.25rem 0 1rem;
        scrollbar-width: thin;
        -webkit-overflow-scrolling: touch;
    }
    .sephora-track-<?php echo $slider_id; ?>::-webkit-scrollbar {
        height: 4px;
    }
    .sephora-track-<?php echo $slider_id; ?>::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .sephora-track-<?php echo $slider_id; ?>::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* Card container – responsive width */
    .sephora-card-<?php echo $slider_id; ?> {
        flex: 0 0 calc(50% - 0.5rem);
        scroll-snap-align: start;
    }
    @media (min-width: 768px) {
        .sephora-card-<?php echo $slider_id; ?> {
            flex: 0 0 calc(25% - 0.75rem);
        }
    }

    /* Product card link – removes underline, inherits color */
    .product-link-<?php echo $slider_id; ?> {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    /* Modern product card */
    .product-card-sephora-<?php echo $slider_id; ?> {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }
    .product-card-sephora-<?php echo $slider_id; ?>:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.1);
    }
    .card-img-sephora-<?php echo $slider_id; ?> {
        background: #faf9f8;
        padding: 0.75rem;
        text-align: center;
        border-bottom: 1px solid #f0efed;
    }
    .card-img-sephora-<?php echo $slider_id; ?> img {
        max-height: 130px;
        width: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    .product-card-sephora-<?php echo $slider_id; ?>:hover .card-img-sephora-<?php echo $slider_id; ?> img {
        transform: scale(1.02);
    }
    .card-info-sephora-<?php echo $slider_id; ?> {
        padding: 0.6rem 0.7rem 0.8rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .brand-sephora-<?php echo $slider_id; ?> {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #7c3aed;
        text-transform: uppercase;
        margin-bottom: 0.2rem;
    }
    .product-title-sephora-<?php echo $slider_id; ?> {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1e1a2f;
        line-height: 1.3;
        margin-bottom: 0.3rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .price-sephora-<?php echo $slider_id; ?> {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        margin-top: auto;
    }
    .price-sephora-<?php echo $slider_id; ?> small {
        font-size: 0.65rem;
        font-weight: 500;
        color: #5b6e8c;
    }

    /* Navigation arrows */
    .slider-arrow-<?php echo $slider_id; ?> {
        position: absolute;
        top: 45%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(6px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.5rem;
        font-weight: 300;
        color: #2d2a2e;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.2s;
        z-index: 5;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }
    .slider-arrow-<?php echo $slider_id; ?>:hover {
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        transform: translateY(-50%) scale(1.02);
    }
    .arrow-prev-<?php echo $slider_id; ?> {
        left: 0;
    }
    .arrow-next-<?php echo $slider_id; ?> {
        right: 0;
    }

    /* Mobile adjustments */
    @media (max-width: 640px) {
        .sephora-slider-<?php echo $slider_id; ?> {
            padding: 0 8px;
        }
        .slider-arrow-<?php echo $slider_id; ?> {
            width: 28px;
            height: 28px;
            font-size: 1.2rem;
        }
        .card-img-sephora-<?php echo $slider_id; ?> img {
            max-height: 100px;
        }
        .product-title-sephora-<?php echo $slider_id; ?> {
            font-size: 0.75rem;
        }
        .price-sephora-<?php echo $slider_id; ?> {
            font-size: 0.85rem;
        }
        .sephora-track-<?php echo $slider_id; ?> {
            gap: 0.75rem;
        }
    }
</style>

<div class="sephora-slider-<?php echo $slider_id; ?>">
    <div class="sephora-track-<?php echo $slider_id; ?>" id="sephoraTrack_<?php echo $slider_id; ?>">
        <?php foreach ($products as $row): 
            // ----- Product image handling -----
            $upload_path = base_app . '/uploads/product_' . $row['id'];
            $img = "";
            if (is_dir($upload_path)) {
                $fileO = scandir($upload_path);
                if (isset($fileO[2])) {
                    $img = 'uploads/product_' . $row['id'] . '/' . $fileO[2];
                }
            }
            if (empty($img)) {
                $img = 'https://placehold.co/400x300/f8fafc/1e293b?text=No+Image';
            }

            // Clean data
            foreach ($row as $k => $v) {
                $row[$k] = trim(stripslashes($v));
            }

            // Price range from inventory
            $inventory = $conn->query("SELECT DISTINCT price FROM inventory WHERE product_id = " . $row['id'] . " ORDER BY price ASC");
            $inv = [];
            while ($ir = $inventory->fetch_assoc()) {
                $inv[] = format_num($ir['price']);
            }
            $price_html = '';
            if (isset($inv[0])) {
                $price_html .= $inv[0];
            }
            if (count($inv) > 1) {
                $price_html .= " <small>–</small> " . $inv[count($inv) - 1];
            }
            if (empty($price_html)) {
                $price_html = '<small>Price on request</small>';
            }

            // Build product URL with MD5 of product ID
            $product_hash = md5($row['id']);
            $product_url = "./?p=view_product&id=" . $product_hash;
        ?>
            <div class="sephora-card-<?php echo $slider_id; ?>">
                <a href="<?php echo htmlspecialchars($product_url, ENT_QUOTES); ?>" class="product-link-<?php echo $slider_id; ?>">
                    <div class="product-card-sephora-<?php echo $slider_id; ?>">
                        <div class="card-img-sephora-<?php echo $slider_id; ?>">
                            <img src="<?php echo htmlspecialchars($img, ENT_QUOTES); ?>" 
                                 alt="<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>"
                                 loading="lazy">
                        </div>
                        <div class="card-info-sephora-<?php echo $slider_id; ?>">
                            <?php if (!empty($row['bname'])): ?>
                                <div class="brand-sephora-<?php echo $slider_id; ?>">
                                    <?php echo htmlspecialchars($row['bname'], ENT_QUOTES); ?>
                                </div>
                            <?php endif; ?>
                            <div class="product-title-sephora-<?php echo $slider_id; ?>">
                                <?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>
                            </div>
                            <div class="price-sephora-<?php echo $slider_id; ?>">
                                <?php echo $price_html; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Navigation arrows -->
    <div class="slider-arrow-<?php echo $slider_id; ?> arrow-prev-<?php echo $slider_id; ?>">‹</div>
    <div class="slider-arrow-<?php echo $slider_id; ?> arrow-next-<?php echo $slider_id; ?>">›</div>
</div>

<script>
    (function() {
        const sliderId = '<?php echo $slider_id; ?>';
        const track = document.getElementById('sephoraTrack_' + sliderId);
        if (!track) return;

        const prevBtn = document.querySelector('.arrow-prev-' + sliderId);
        const nextBtn = document.querySelector('.arrow-next-' + sliderId);
        
        function getCardScrollWidth() {
            const cards = track.querySelectorAll('.sephora-card-' + sliderId);
            if (!cards.length) return 0;
            const firstCard = cards[0];
            const style = window.getComputedStyle(firstCard);
            const flexBasis = parseFloat(style.flexBasis);
            const gap = parseFloat(window.getComputedStyle(track).gap);
            return (flexBasis + gap);
        }
        
        function scrollPrev() {
            const scrollAmount = getCardScrollWidth();
            track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        }
        
        function scrollNext() {
            const scrollAmount = getCardScrollWidth();
            track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
        
        if (prevBtn) prevBtn.addEventListener('click', scrollPrev);
        if (nextBtn) nextBtn.addEventListener('click', scrollNext);
        
        function updateArrowsVisibility() {
            if (!prevBtn || !nextBtn) return;
            const scrollLeft = track.scrollLeft;
            const maxScroll = track.scrollWidth - track.clientWidth;
            prevBtn.style.opacity = scrollLeft <= 5 ? '0.3' : '1';
            nextBtn.style.opacity = maxScroll - scrollLeft <= 5 ? '0.3' : '1';
        }
        
        track.addEventListener('scroll', updateArrowsVisibility);
        window.addEventListener('resize', updateArrowsVisibility);
        setTimeout(updateArrowsVisibility, 100);
        
        let startX = 0;
        track.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, {passive: true});
        track.addEventListener('touchend', (e) => {
            const diff = e.changedTouches[0].clientX - startX;
            if (Math.abs(diff) > 40) {
                if (diff > 0) scrollPrev();
                else scrollNext();
            }
        });
    })();
</script>