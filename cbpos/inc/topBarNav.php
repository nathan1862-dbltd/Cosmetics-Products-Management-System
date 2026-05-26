<nav class="navbar navbar-expand-lg navbar-light navbar-header">
  <div class="container px-3 px-lg-5">

    <div class="d-flex align-items-center w-100 header-row">

      <!-- LOGO -->
      <a class="logo-wrap" href="./" aria-label="Delux Beauti Home">
        <img src="<?php echo base_url ?>assets/img/delux-beauti-logo.png"
             class="logo-img"
             alt="Delux Beauti"
             loading="lazy">
      </a>

      <!-- SEARCH -->
      <form class="form-inline flex-grow-1 search-wrap" id="search-form">
        <div class="input-group w-100">

          <input class="form-control form-control-sm"
                 type="search"
                 placeholder="Search"
                 aria-label="Search"
                 name="search"
                 value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>"
                 aria-describedby="search-btn">

          <div class="input-group-append">
            <button class="btn btn-sm search-btn"
                    type="submit"
                    id="search-btn">
              <i class="fa fa-search"></i>
            </button>
          </div>

        </div>
      </form>

      <!-- MOBILE CART ALWAYS VISIBLE -->
<a class="nav-link d-lg-none mobile-cart"
   href="./?p=cart"
   aria-label="Cart">

  <i class="bi-cart-fill"></i>

  <span class="badge rounded-pill"
        id="cart-count-mobile">

    <?php 
      if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2){

          $count = $conn->query("SELECT SUM(quantity) as items from `cart` where client_id =".$_settings->userdata('id'))->fetch_assoc()['items'];

          echo ($count > 0 ? $count : 0);

      } else {

          echo 0;

      }
    ?>

  </span>
</a>

      <!-- MOBILE LOGIN -->
      <?php if($_settings->userdata('id') <= 0 || $_settings->userdata('login_type') != 2): ?>

      <button class="btn btn-sm login-btn d-lg-none"
              id="login-btn"
              type="button">
        Login
      </button>

      <?php endif; ?>

    </div>

    <!-- DESKTOP ACTIONS -->
    <div class="d-none d-lg-flex align-items-center header-actions">

      <!-- CART ALWAYS VISIBLE -->
      <a class="nav-link desktop-cart"
         href="./?p=cart"
         aria-label="Cart">

        <i class="bi-cart-fill mr-1"></i>

        <span class="badge rounded-pill"
              id="cart-count">

          <?php 
            if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2){
                echo ($count > 0 ? $count : 0);
            } else {
                echo 0;
            }
          ?>

        </span>
      </a>

      <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2): ?>

        <a href="./?p=my_account"
           class="nav-link account-link"
           aria-label="My Account">

           <i class="fa fa-user-circle mr-1"></i>
           My Account

        </a>

        <a href="logout.php"
           class="nav-link logout-link"
           aria-label="Logout">

           <i class="fa fa-sign-out-alt"></i>

        </a>

      <?php else: ?>

        <button class="btn btn-sm login-btn"
                id="login-btn-desktop"
                type="button">
          Login
        </button>

      <?php endif; ?>

    </div>

  </div>
</nav>

<style>

/* =========================
   HEADER
========================= */

.navbar-header{
    background:#fff;
    min-height:52px;
    padding:6px 0;
    border-bottom:1px solid #f1f1f1;
    position:sticky;
    top:0;
    z-index:999;
}

.header-row{
    min-width:0;
}

/* =========================
   LOGO
========================= */

.logo-wrap{
    display:flex;
    align-items:center;
    flex-shrink:0;
    margin-right:12px;
    text-decoration:none;
}

.logo-img{
    height:38px;
    width:auto;
    max-width:140px;
    object-fit:contain;
    display:block;
}

/* =========================
   SEARCH
========================= */

.search-wrap{
    margin:0 10px;
}

.search-wrap .input-group{
    overflow:hidden;
    border-radius:12px;
    border:1px solid #e5e5e5;
    background:#fafafa;
}

.search-wrap .form-control{
    border:none;
    box-shadow:none !important;
    background:transparent;
    height:38px;
    font-size:14px;
    padding-left:14px;
}

.search-btn{
    border:none;
    background:transparent;
    width:42px;
    color:#666;
}

.search-btn:hover{
    background:#f5f5f5;
}

/* =========================
   ACTIONS
========================= */

.header-actions{
    margin-left:16px;
    gap:10px;
}

.desktop-cart,
.account-link,
.logout-link{
    color:#222 !important;
    text-decoration:none;
    font-size:14px;
    transition:0.2s ease;
}

.desktop-cart:hover,
.account-link:hover,
.logout-link:hover{
    color:#000 !important;
    transform:translateY(-1px);
}

/* =========================
   BADGE
========================= */

.badge{
    background:#000;
    color:#fff;
    font-size:11px;
    min-width:18px;
    height:18px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}

/* =========================
   MOBILE CART
========================= */

.mobile-cart{
    position:relative;
    color:#000 !important;
    font-size:20px;
    margin-left:8px;
}

.mobile-cart .badge{
    position:absolute;
    top:-6px;
    right:-10px;
}

/* =========================
   LOGIN BUTTON
========================= */

.login-btn{
    border:none;
    background:#000;
    color:#fff;
    border-radius:10px;
    padding:7px 16px;
    font-size:13px;
    font-weight:500;
    transition:0.2s ease;
}

.login-btn:hover{
    background:#222;
    color:#fff;
}

/* =========================
   MOBILE
========================= */

@media (max-width:768px){

    .navbar-header{
        min-height:52px;
        padding:5px 0;
    }

    .logo-img{
        height:30px;
        max-width:110px;
    }

    .search-wrap{
        margin:0 6px;
    }

    .search-wrap .form-control{
        height:34px;
        font-size:13px;
    }

    .search-btn{
        width:38px;
    }

    .login-btn{
        padding:6px 12px;
        font-size:12px;
    }
}

</style>

<script>
  $(function(){

    $('#login-btn, #login-btn-desktop').click(function(){
      uni_modal("", "login.php")
    })

  })

  $('#search-form').submit(function(e){
    e.preventDefault()

    var sTxt = $('[name="search"]').val()

    if(sTxt != '')
      location.href = './?p=products&search=' + sTxt;
  })
</script>