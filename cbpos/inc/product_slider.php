<?php
/**
 * Reusable product slider wrapper – No Bootstrap, vanilla JS.
 * Expected variables:
 * - $products : array of product rows with id,name,bname,category
 * - $slider_id : unique id string for carousel
 */

if (!isset($products) || !is_array($products) || empty($products)) {
    return;
}

$chunked_products = array_chunk($products, 4);
$total_slides = count($chunked_products);
?>

<style>
    /* ----- Modern slider core ----- */
    .custom-slider-<?php echo $slider_id; ?> {
        position: relative;
        width: 100%;
        overflow: hidden;
        padding: 0 40px; /* Space for prev/next buttons */
        box-sizing: border-box;
    }
    .slider-container-<?php echo $slider_id; ?> {
        overflow: hidden;
        border-radius: 24px;
    }
    .slider-track-<?php echo $slider_id; ?> {
        display: flex;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: transform;
    }
    .slider-slide-<?php echo $slider_id; ?> {
        flex: 0 0 100%;
        width: 100%;
        box-sizing: border-box;
        padding: 4px;
    }
    /* ----- Responsive product grid (2 cols mobile, 4 cols desktop) ----- */
    .product-grid-<?php echo $slider_id; ?> {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.2rem;
    }
    @media (min-width: 768px) {
        .product-grid-<?php echo $slider_id; ?> {
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
    }
    /* ----- Modern product card ----- */
    .product-card-<?php echo $slider_id; ?> {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.05), 0 4px 8px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        backdrop-filter: blur(0px);
    }
    .product-card-<?php echo $slider_id; ?>:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 32px -12px rgba(0, 0, 0, 0.12);
    }
    .product-img-<?php echo $slider_id; ?> {
        background: #f9fafb;
        padding: 1.2rem;
        text-align: center;
        border-bottom: 1px solid #f0f2f5;
    }
    .product-img-<?php echo $slider_id; ?> img {
        max-height: 150px;
        width: auto;
        object-fit: contain;
        transition: transform 0.4s ease;
    }
    .product-card-<?php echo $slider_id; ?>:hover .product-img-<?php echo $slider_id; ?> img {
        transform: scale(1.02);
    }
    .product-info-<?php echo $slider_id; ?> {
        padding: 1rem 1rem 1.2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .product-brand-<?php echo $slider_id; ?> {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #3b82f6;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }
    .product-name-<?php echo $slider_id; ?> {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product-price-<?php echo $slider_id; ?> {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f172a;
        margin-top: auto;
        letter-spacing: -0.2px;
    }
    .product-price-<?php echo $slider_id; ?> small {
        font-size: 0.75rem;
        font-weight: 500;
        color: #5b6e8c;
    }
    /* ----- Navigation buttons ----- */
    .slider-btn-<?php echo $slider_id; ?> {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 42px;
        height: 42px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 60px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: 300;
        color: #1f2937;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        z-index: 10;
        opacity: 0.7;
    }
    .slider-btn-<?php echo $slider_id; ?>:hover {
        opacity: 1;
        background: white;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-50%) scale(1.02);
    }
    .slider-prev-<?php echo $slider_id; ?> {
        left: 0;
    }
    .slider-next-<?php echo $slider_id; ?> {
        right: 0;
    }
    /* Dots indicator */
    .slider-dots-<?php echo $slider_id; ?> {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 28px;
    }
    .dot-<?php echo $slider_id; ?> {
        width: 8px;
        height: 8px;
        background: #cbd5e1;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .dot-<?php echo $slider_id; ?>.active {
        width: 24px;
        background: #3b82f6;
    }
    /* Mobile adjustments */
    @media (max-width: 640px) {
        .custom-slider-<?php echo $slider_id; ?> {
            padding: 0 28px;
        }
        .slider-btn-<?php echo $slider_id; ?> {
            width: 34px;
            height: 34px;
            font-size: 1.4rem;
        }
        .product-img-<?php echo $slider_id; ?> img {
            max-height: 110px;
        }
        .product-name-<?php echo $slider_id; ?> {
            font-size: 0.85rem;
        }
    }
</style>

<div class="custom-slider-<?php echo $slider_id; ?>" id="slider_<?php echo $slider_id; ?>">
    <div class="slider-container-<?php echo $slider_id; ?>">
        <div class="slider-track-<?php echo $slider_id; ?>" id="track_<?php echo $slider_id; ?>">
            <?php foreach ($chunked_products as $slide_index => $slide_products): ?>
                <div class="slider-slide-<?php echo $slider_id; ?>">
                    <div class="product-grid-<?php echo $slider_id; ?>">
                        <?php foreach ($slide_products as $row): 
                            // --- Product image handling ---
                            $upload_path = base_app . '/uploads/product_' . $row['id'];
                            $img = "";
                            if (is_dir($upload_path)) {
                                $fileO = scandir($upload_path);
                                if (isset($fileO[2])) {
                                    $img = 'uploads/product_' . $row['id'] . '/' . $fileO[2];
                                }
                            }
                            if (empty($img)) {
                                $img = 'https://placehold.co/400x300/eef2ff/3b82f6?text=No+Image';
                            }

                            // Clean data
                            foreach ($row as $k => $v) {
                                $row[$k] = trim(stripslashes($v));
                            }

                            // Price range
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
                                $price_html = '<small>Call for price</small>';
                            }
                        ?>
                            <div class="product-card-<?php echo $slider_id; ?>">
                                <div class="product-img-<?php echo $slider_id; ?>">
                                    <img src="<?php echo htmlspecialchars($img, ENT_QUOTES); ?>" 
                                         alt="<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>"
                                         loading="lazy">
                                </div>
                                <div class="product-info-<?php echo $slider_id; ?>">
                                    <?php if (!empty($row['bname'])): ?>
                                        <div class="product-brand-<?php echo $slider_id; ?>">
                                            <?php echo htmlspecialchars($row['bname'], ENT_QUOTES); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="product-name-<?php echo $slider_id; ?>">
                                        <?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>
                                    </div>
                                    <div class="product-price-<?php echo $slider_id; ?>">
                                        <?php echo $price_html; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($total_slides > 1): ?>
        <button class="slider-btn-<?php echo $slider_id; ?> slider-prev-<?php echo $slider_id; ?>" aria-label="Previous">‹</button>
        <button class="slider-btn-<?php echo $slider_id; ?> slider-next-<?php echo $slider_id; ?>" aria-label="Next">›</button>
        <div class="slider-dots-<?php echo $slider_id; ?>" id="dots_<?php echo $slider_id; ?>"></div>
    <?php endif; ?>
</div>

<script>
    (function() {
        const sliderId = '<?php echo $slider_id; ?>';
        const track = document.getElementById('track_' + sliderId);
        const slides = document.querySelectorAll('.slider-slide-' + sliderId);
        const prevBtn = document.querySelector('.slider-prev-' + sliderId);
        const nextBtn = document.querySelector('.slider-next-' + sliderId);
        const dotsContainer = document.getElementById('dots_' + sliderId);
        
        if (!track || slides.length === 0) return;
        
        let currentIndex = 0;
        const totalSlides = slides.length;
        let startX = 0;
        let isSwiping = false;
        let swipeThreshold = 50;
        
        // Create dots
        if (dotsContainer && totalSlides > 1) {
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot-' + sliderId);
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
            }
        }
        
        function updateDots() {
            if (!dotsContainer) return;
            const dots = document.querySelectorAll('.dot-' + sliderId);
            dots.forEach((dot, idx) => {
                if (idx === currentIndex) dot.classList.add('active');
                else dot.classList.remove('active');
            });
        }
        
        function goToSlide(index) {
            if (index < 0) index = 0;
            if (index >= totalSlides) index = totalSlides - 1;
            if (index === currentIndex) return;
            currentIndex = index;
            const translateX = - (currentIndex * 100);
            track.style.transform = `translateX(${translateX}%)`;
            updateDots();
        }
        
        function nextSlide() {
            if (currentIndex < totalSlides - 1) {
                goToSlide(currentIndex + 1);
            } else if (currentIndex === totalSlides - 1) {
                // Optional: loop back to first – uncomment if desired
                // goToSlide(0);
            }
        }
        
        function prevSlide() {
            if (currentIndex > 0) {
                goToSlide(currentIndex - 1);
            } else if (currentIndex === 0) {
                // Optional: loop to last
                // goToSlide(totalSlides - 1);
            }
        }
        
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        
        // --- Touch swipe for mobile ---
        const sliderContainer = document.querySelector('.slider-container-' + sliderId);
        if (sliderContainer) {
            sliderContainer.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                isSwiping = true;
            }, {passive: true});
            
            sliderContainer.addEventListener('touchmove', (e) => {
                if (!isSwiping) return;
                const diffX = e.touches[0].clientX - startX;
                // optional: prevent page scroll while swiping horizontally
                if (Math.abs(diffX) > 10) e.preventDefault();
            }, {passive: false});
            
            sliderContainer.addEventListener('touchend', (e) => {
                if (!isSwiping) return;
                const endX = e.changedTouches[0].clientX;
                const diffX = endX - startX;
                if (Math.abs(diffX) > swipeThreshold) {
                    if (diffX > 0) {
                        prevSlide();
                    } else {
                        nextSlide();
                    }
                }
                isSwiping = false;
                startX = 0;
            });
        }
        
        // Optional: keyboard navigation (arrow keys)
        window.addEventListener('keydown', (e) => {
            const sliderElement = document.getElementById('slider_' + sliderId);
            if (!sliderElement || !sliderElement.contains(document.activeElement)) return;
            if (e.key === 'ArrowLeft') {
                prevSlide();
                e.preventDefault();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                e.preventDefault();
            }
        });
        
        // Ensure slider is responsive after window resize (no action needed, % based)
        // But re-check track transform to avoid glitches
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                // re-apply same translation to avoid misalignment
                const translateX = - (currentIndex * 100);
                track.style.transform = `translateX(${translateX}%)`;
            }, 100);
        });
    })();
</script>