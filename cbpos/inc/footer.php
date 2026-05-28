<script>
  $(document).ready(function(){
    $('#p_use').click(function(){
      uni_modal("Privacy Policy","policy.php","mid-large")
    })
     window.viewer_modal = function($src = ''){
      start_loader()
      var t = $src.split('.')
      t = t[1]
      if(t =='mp4'){
        var view = $("<video src='"+$src+"' controls autoplay></video>")
      }else{
        var view = $("<img src='"+$src+"' />")
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
      $('#viewer_modal .modal-content').append(view)
      $('#viewer_modal').modal({
              show:true,
              backdrop:'static',
              keyboard:false,
              focus:true
            })
            end_loader()  

  }
    window.uni_modal = function($title = '' , $url='',$size=""){
        start_loader()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#uni_modal .modal-dialog').addClass($size+'  modal-dialog-centered')
                    }else{
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
                    }
                    $('#uni_modal').modal({
                      show:true,
                      backdrop:'static',
                      keyboard:false,
                      focus:true
                    })
                    end_loader()
                }
            }
        })
    }
    window._conf = function($msg='',$func='',$params = []){
       $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
       $('#confirm_modal .modal-body').html($msg)
       $('#confirm_modal').modal('show')
    }
  })
</script>
<!-- Footer-->
<footer class="sephora-footer">
  <div class="sephora-footer__top">
    <div class="container">
      <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">
          <details class="sephora-footer__accordion" open>
            <summary class="sephora-footer__heading">About <?php echo $_settings->info('short_name') ?></summary>
            <ul class="sephora-footer__list">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Store Locator</a></li>
              <li><a href="#">Careers</a></li>
              <li><a href="#">Sustainability</a></li>
            </ul>
          </details>
        </div>
        <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">
          <details class="sephora-footer__accordion">
            <summary class="sephora-footer__heading">Customer Service</summary>
            <ul class="sephora-footer__list">
              <li><a href="#">Shipping & Returns</a></li>
              <li><a href="#">Order Tracking</a></li>
              <li><a href="#">FAQs</a></li>
              <li><a id="p_use" href="javascript:void(0)">Privacy Policy</a></li>
            </ul>
          </details>
        </div>
        <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">
          <details class="sephora-footer__accordion">
            <summary class="sephora-footer__heading">Beauty Community</summary>
            <ul class="sephora-footer__list">
              <li><a href="#">Gift Cards</a></li>
              <li><a href="#">Rewards Program</a></li>
              <li><a href="#">Virtual Consultations</a></li>
              <li><a href="#">Beauty Insider</a></li>
            </ul>
          </details>
        </div>
        <div class="col-12 col-md-6 col-lg-3 sephora-footer__section">
          <details class="sephora-footer__accordion">
            <summary class="sephora-footer__heading">Get Beauty Updates</summary>
            <p class="sephora-footer__copy">Sign up for exclusive deals, product drops, and skincare tips.</p>
            <form class="sephora-footer__form" action="#" method="post">
              <input type="email" placeholder="Enter your email" aria-label="Email address">
              <button type="button">Sign Up</button>
            </form>
          </details>
        </div>
      </div>
    </div>
  </div>
  <div class="sephora-footer__bottom">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <p class="m-0">&copy; <?php echo date('Y'); ?> <?php echo $_settings->info('short_name') ?>. All rights reserved.</p>
      <p class="m-0">Developed by: Robi &amp; Tanim</p>
    </div>
  </div>
</footer>
<style>
  .sephora-footer { background:#000; color:#fff; margin-top:3rem; }
  .sephora-footer__top { border-top:1px solid #2f2f2f; border-bottom:1px solid #2f2f2f; padding:2.5rem 0; }
  .sephora-footer__heading { color:#fff; font-size:1rem; letter-spacing:.04em; text-transform:uppercase; margin-bottom:1rem; font-weight:700; list-style:none; cursor:pointer; }
  .sephora-footer__heading::-webkit-details-marker { display:none; }
  .sephora-footer__accordion[open] .sephora-footer__heading { margin-bottom:1rem; }
  .sephora-footer__list { list-style:none; margin:0; padding:0; }
  .sephora-footer__list li { margin-bottom:.55rem; }
  .sephora-footer__list a { color:#d0d0d0; text-decoration:none; font-size:.93rem; }
  .sephora-footer__list a:hover { color:#fff; text-decoration:underline; }
  .sephora-footer__copy { color:#d0d0d0; font-size:.93rem; margin-bottom:.85rem; }
  .sephora-footer__form { display:flex; gap:.5rem; }
  .sephora-footer__form input { flex:1; min-width:0; border:1px solid #555; background:#111; color:#fff; padding:.55rem .7rem; border-radius:0; }
  .sephora-footer__form input::placeholder { color:#979797; }
  .sephora-footer__form button { border:1px solid #fff; background:#fff; color:#000; padding:.55rem 1rem; font-weight:600; text-transform:uppercase; font-size:.75rem; letter-spacing:.05em; }
  .sephora-footer__form button:hover { background:#000; color:#fff; }
  .sephora-footer__bottom { padding:1rem 0; font-size:.85rem; color:#bdbdbd; }
  @media (max-width: 767.98px) {
    .sephora-footer__top { padding:1.25rem 0; }
    .sephora-footer__section { border-bottom:1px solid #2a2a2a; padding-bottom:.75rem; }
    .sephora-footer__heading { margin:0; padding:.25rem 0; position:relative; }
    .sephora-footer__heading::after { content:'+'; position:absolute; right:0; top:0; color:#fff; }
    .sephora-footer__accordion[open] .sephora-footer__heading::after { content:'−'; }
    .sephora-footer__accordion > *:not(summary) { padding-top:.75rem; }
    .sephora-footer__form { flex-direction:column; }
    .sephora-footer__form button { width:100%; }
  }
  @media (min-width: 768px) {
    .sephora-footer__accordion { display:block; }
    .sephora-footer__accordion > summary { pointer-events:none; }
    .sephora-footer__accordion > *:not(summary) { display:block !important; }
  }
</style>

   
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- overlayScrollbars -->
    <!-- <script src="<?php echo base_url ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
    <div class="daterangepicker ltr show-ranges opensright">
      <div class="ranges">
        <ul>
          <li data-range-key="Today">Today</li>
          <li data-range-key="Yesterday">Yesterday</li>
          <li data-range-key="Last 7 Days">Last 7 Days</li>
          <li data-range-key="Last 30 Days">Last 30 Days</li>
          <li data-range-key="This Month">This Month</li>
          <li data-range-key="Last Month">Last Month</li>
          <li data-range-key="Custom Range">Custom Range</li>
        </ul>
      </div>
      <div class="drp-calendar left">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
      </div>
      <div class="drp-calendar right">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
      </div>
      <div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div>
    </div>
    <div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>