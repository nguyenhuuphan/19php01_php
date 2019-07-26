
<form role="form" name="loginAdmin" action="#" method="get">
  <div class="box-body">
    <div class="form-group <?php echo ($errEmail != '')?'has-error':''; ?>">
      <label for="inputEmail">Email</label>
      <input type="text" class="form-control" id="inputEmail" placeholder="Your Email" name="email">
      <span class="error-block help-block"><?php echo $errEmail ?></span>
    </div>

  <div class="box-footer">
    <button type="submit" class="btn btn-primary" name="login_admin">Login</button>
  </div>
</form>