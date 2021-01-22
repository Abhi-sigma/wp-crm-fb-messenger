<?php
session_start();
$login_nonce = wp_create_nonce("login_admin_nonce");
echo $login_nonce;
if($_SESSION["logged_in"]){
  wp_redirect( "./ula-crm-dashboard/");
  exit;
}
?>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Login Form -->
    <form action= <?php echo esc_url( admin_url('admin-post.php') ); ?> method = post >
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="password">
      <input type="hidden" name="action" value="login_form">
      <input type = "hidden" name="login_form_nonce" value = <?php  echo $login_nonce ?> >
      <input type="submit" class="fadeIn fourth">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>

