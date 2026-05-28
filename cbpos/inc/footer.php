<script>
$(document).ready(function(){

    // =========================================================
    // Resolve jQuery UI & Bootstrap conflicts safely
    // =========================================================
    if (typeof $.ui !== 'undefined') {

        // Tooltip conflict
        if ($.ui.tooltip) {
            $.widget.bridge('uitooltip', $.ui.tooltip)
        }

        // Button conflict
        if ($.ui.button) {
            $.widget.bridge('uibutton', $.ui.button)
        }
    }

    // =========================================================
    // Bootstrap Tooltip Safe Init
    // =========================================================
    try {
        $('[data-toggle="tooltip"]').tooltip('dispose')
        $('[data-toggle="tooltip"]').tooltip()
    } catch(err){
        console.warn('Tooltip initialization skipped')
    }

    // =========================================================
    // Privacy Policy Modal
    // =========================================================
    $('#p_use').click(function(){
        uni_modal("Privacy Policy","policy.php","mid-large")
    })

    // =========================================================
    // Viewer Modal
    // =========================================================
    window.viewer_modal = function($src = ''){

        start_loader()

        var ext = $src.split('.').pop().toLowerCase()

        var view = ''

        if(ext === 'mp4'){
            view = $(
                '<video src="'+$src+'" controls autoplay style="width:100%;height:auto;"></video>'
            )
        } else {
            view = $(
                '<img src="'+$src+'" style="width:100%;height:auto;" />'
            )
        }

        $('#viewer_modal .modal-content').html(view)

        // Remove duplicate modal backdrops
        $('#viewer_modal').modal('hide')
        $('body').removeClass('modal-open')
        $('.modal-backdrop').remove()

        $('#viewer_modal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false,
            focus: true
        })

        end_loader()
    }

    // =========================================================
    // Universal Modal
    // =========================================================
    window.uni_modal = function($title = '', $url = '', $size = ""){

        start_loader()

        $.ajax({
            url: $url,

            error: function(err){

                console.error(err)

                alert("An error occurred")

                end_loader()
            },

            success: function(resp){

                if(resp){

                    $('#uni_modal .modal-title').html($title)

                    $('#uni_modal .modal-body').html(resp)

                    if($size != ''){

                        $('#uni_modal .modal-dialog')
                            .removeAttr("class")
                            .addClass(
                                'modal-dialog ' +
                                $size +
                                ' modal-dialog-centered'
                            )

                    } else {

                        $('#uni_modal .modal-dialog')
                            .removeAttr("class")
                            .addClass(
                                'modal-dialog modal-md modal-dialog-centered'
                            )
                    }

                    // Remove duplicate modal backdrops
                    $('#uni_modal').modal('hide')
                    $('body').removeClass('modal-open')
                    $('.modal-backdrop').remove()

                    $('#uni_modal').modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false,
                        focus: true
                    })

                    end_loader()
                }
            }
        })
    }

    // =========================================================
    // Confirmation Modal
    // =========================================================
    window._conf = function($msg = '', $func = '', $params = []){

        $('#confirm_modal #confirm')
            .attr('onclick', $func + "(" + $params.join(',') + ")")

        $('#confirm_modal .modal-body').html($msg)

        $('#confirm_modal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        })
    }

})
</script>

<!-- ========================================================= -->
<!-- FOOTER -->
<!-- ========================================================= -->

<footer class="sephora-footer">

    <div class="sephora-footer__top">

        <div class="container">

            <div class="row g-4">

                <!-- About -->
                <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">

                    <details class="sephora-footer__accordion" open>

                        <summary class="sephora-footer__heading">
                            About <?php echo $_settings->info('short_name') ?>
                        </summary>

                        <ul class="sephora-footer__list">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Store Locator</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Sustainability</a></li>
                        </ul>

                    </details>

                </div>

                <!-- Customer Service -->
                <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">

                    <details class="sephora-footer__accordion">

                        <summary class="sephora-footer__heading">
                            Customer Service
                        </summary>

                        <ul class="sephora-footer__list">
                            <li><a href="#">Shipping & Returns</a></li>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li>
                                <a id="p_use" href="javascript:void(0)">
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>

                    </details>

                </div>

                <!-- Beauty Community -->
                <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">

                    <details class="sephora-footer__accordion">

                        <summary class="sephora-footer__heading">
                            Beauty Community
                        </summary>

                        <ul class="sephora-footer__list">
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Rewards Program</a></li>
                            <li><a href="#">Virtual Consultations</a></li>
                            <li><a href="#">Beauty Insider</a></li>
                        </ul>

                    </details>

                </div>

                <!-- Newsletter -->
                <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">

                    <details class="sephora-footer__accordion">

                        <summary class="sephora-footer__heading">
                            Get Beauty Updates
                        </summary>

                        <p class="sephora-footer__copy">
                            Sign up for exclusive deals, product drops,
                            and skincare tips.
                        </p>

                        <form class="sephora-footer__form" action="#" method="post">

                            <input
                                type="email"
                                placeholder="Enter your email"
                                aria-label="Email address"
                            >

                            <button type="button">
                                Sign Up
                            </button>

                        </form>

                    </details>

                </div>

            </div>

        </div>

    </div>

    <!-- Footer Bottom -->
    <div class="sephora-footer__bottom">

        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">

            <p class="m-0">
                &copy; <?php echo date('Y'); ?>
                <?php echo $_settings->info('short_name') ?>.
                All rights reserved.
            </p>

            <p class="m-0">
                Developed by: Robi &amp; Tanim
            </p>

        </div>

    </div>

</footer>

<!-- ========================================================= -->
<!-- FOOTER CSS -->
<!-- ========================================================= -->

<style>

.sephora-footer{
    background:#000;
    color:#fff;
    margin-top:3rem;
}

.sephora-footer__top{
    border-top:1px solid #2f2f2f;
    border-bottom:1px solid #2f2f2f;
    padding:2.5rem 0;
}

.sephora-footer__heading{
    color:#fff;
    font-size:1rem;
    letter-spacing:.04em;
    text-transform:uppercase;
    margin-bottom:1rem;
    font-weight:700;
    list-style:none;
    cursor:pointer;
}

.sephora-footer__heading::-webkit-details-marker{
    display:none;
}

.sephora-footer__list{
    list-style:none;
    margin:0;
    padding:0;
}

.sephora-footer__list li{
    margin-bottom:.55rem;
}

.sephora-footer__list a{
    color:#d0d0d0;
    text-decoration:none;
    font-size:.93rem;
}

.sephora-footer__list a:hover{
    color:#fff;
    text-decoration:underline;
}

.sephora-footer__copy{
    color:#d0d0d0;
    font-size:.93rem;
    margin-bottom:.85rem;
}

.sephora-footer__form{
    display:flex;
    gap:.5rem;
}

.sephora-footer__form input{
    flex:1;
    min-width:0;
    border:1px solid #555;
    background:#111;
    color:#fff;
    padding:.55rem .7rem;
}

.sephora-footer__form button{
    border:1px solid #fff;
    background:#fff;
    color:#000;
    padding:.55rem 1rem;
    font-weight:600;
    text-transform:uppercase;
    font-size:.75rem;
}

.sephora-footer__form button:hover{
    background:#000;
    color:#fff;
}

.sephora-footer__bottom{
    padding:1rem 0;
    font-size:.85rem;
    color:#bdbdbd;
}

@media (max-width:767.98px){

    .sephora-footer__top{
        padding:1.25rem 0;
    }

    .sephora-footer__section{
        border-bottom:1px solid #2a2a2a;
        padding-bottom:.75rem;
    }

    .sephora-footer__heading{
        margin:0;
        padding:.25rem 0;
        position:relative;
    }

    .sephora-footer__heading::after{
        content:'+';
        position:absolute;
        right:0;
        top:0;
        color:#fff;
    }

    .sephora-footer__accordion[open]
    .sephora-footer__heading::after{
        content:'−';
    }

    .sephora-footer__accordion > *:not(summary){
        padding-top:.75rem;
    }

    .sephora-footer__form{
        flex-direction:column;
    }

    .sephora-footer__form button{
        width:100%;
    }
}

@media (min-width:768px){

    .sephora-footer__accordion{
        display:block;
    }

    .sephora-footer__accordion > summary{
        pointer-events:none;
    }

    .sephora-footer__accordion > *:not(summary){
        display:block !important;
    }
}

</style>

<!-- ========================================================= -->
<!-- JS LIBRARIES -->
<!-- ========================================================= -->

<script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>

<script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>

<script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

<script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>

<script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>

<script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>

<script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="<?php echo base_url ?>dist/js/adminlte.js"></script>