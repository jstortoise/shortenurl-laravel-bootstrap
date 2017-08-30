@include('inc.header');
  <div class="container">
    <form id="register_form" class="form-horizontal" action="{{ url('/register') }}" role="form">
      <fieldset>
        <legend>Sign Up</legend>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-2 control-label">Name</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-2 control-label">Email</label>
          <div class="col-lg-10">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-2 control-label">Password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-2 control-label">Confirm</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" id="repassword" placeholder="Reenter Password" data-match="#password" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary">SignUp</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>

  <script>
    $(function() {
      $("#register_form").validator();
    })
  </script>
@include('inc.footer');
