<div class="subheader">
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="index.php"> Main page </a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu bar</span></a></li>
  </ul>
    <?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
    <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <?php include('includes/checkiflogged.php'); ?>
      <li class="has-dropdown">
        <a href="index.php" <?php if($currentPage == 'index.php'){echo '>';} ?>> Home</a>
        <ul class="dropdown">
          <li><a href="gallery.php" <?php if($currentPage == 'gallery.php'){echo '>'; } ?>> Gallery</a></li>
          <li><a href="about.php" <?php if($currentPage == 'about.php'){echo '>'; } ?>> About Us</a></li>
        </ul>
      </li>
    </ul>
    </section>
</nav>
</div>