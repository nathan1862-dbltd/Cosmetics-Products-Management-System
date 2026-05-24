<nav class="navbar navbar-expand-lg cpms-topbar">
  <div class="container px-3 px-lg-5">
    <div class="d-flex align-items-center w-100 cpms-topbar__row">
      <a class="navbar-brand mr-2 cpms-topbar__brand" href="./" aria-label="Delux Beauti Home">
        <img src="<?php echo base_url ?>assets/img/delux-beauti-logo.png" class="cpms-topbar__brand-logo" alt="Delux Beauti" loading="lazy">
      </a>

      <form class="form-inline flex-grow-1 mx-2 cpms-topbar__search" id="search-form">
        <div class="input-group w-100">
          <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-sm m-0" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>

      <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2): ?>
      <a class="nav-link d-lg-none p-0 cpms-topbar__mobile-cart" href="./?p=cart" aria-label="Cart">
        <i class="bi-cart-fill"></i>
        <span class="badge rounded-pill" id="cart-count-mobile">
          <?php 
            $count = $conn->query("SELECT SUM(quantity) as items from `cart` where client_id =".$_settings->userdata('id'))->fetch_assoc()['items'];
            echo ($count > 0 ? $count : 0);
          ?>
        </span>
      </a>
      <?php else: ?>
      <button class="btn btn-sm ml-2 d-lg-none cpms-topbar__login-btn" id="login-btn" type="button">Login</button>
      <?php endif; ?>
    </div>

    <button class="navbar-toggler btn btn-sm ml-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0 ml-lg-4">
        <li class="nav-item"><a class="nav-link" aria-current="page" href="./">Home</a></li>
        <?php 
        $cat_qry = $conn->query("SELECT * FROM categories where status = 1  limit 3");
        $count_cats =$conn->query("SELECT * FROM categories where status = 1 ")->num_rows;
        while($crow = $cat_qry->fetch_assoc()):
        ?>
        <li class="nav-item"><a class="nav-link" aria-current="page" href="./?p=products&c=<?php echo md5($crow['id']) ?>"><?php echo $crow['category'] ?></a></li>
        <?php endwhile; ?>
        <?php if($count_cats > 3): ?>
        <li class="nav-item"><a class="nav-link" href="./?p=view_categories">All Categories</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="./?p=about">About</a></li>
      </ul>

      <div class="d-none d-lg-flex align-items-center cpms-topbar__desktop-actions">
        <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2): ?>
          <a class="mr-3 nav-link" href="./?p=cart" aria-label="Cart">
            <i class="bi-cart-fill mr-1"></i>
            <span class="badge ml-1 rounded-pill" id="cart-count"><?php echo ($count > 0 ? $count : 0); ?></span>
          </a>
          <a href="./?p=my_account" class="nav-link" aria-label="My Account"><i class="fa fa-user-circle mr-1"></i> My Account</a>
          <a href="logout.php" class="nav-link" aria-label="Logout"><i class="fa fa-sign-out-alt"></i></a>
        <?php else: ?>
          <button class="btn btn-sm cpms-topbar__login-btn" id="login-btn-desktop" type="button">Login</button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<script>
  $(function(){
    $('#login-btn, #login-btn-desktop').click(function(){
      uni_modal("","login.php")
    })
  })

  $('#search-form').submit(function(e){
    e.preventDefault()
    var sTxt = $('[name="search"]').val()
    if(sTxt != '')
      location.href = './?p=products&search='+sTxt;
  })
</script>
