@include('inc.header');
  <div class="container">
    <form id="login_form" class="form-horizontal" action="{{ url('/login') }}" role="form">
      <fieldset>
        <legend>Login</legend>
        @if (isset($msg))
          <div style="color: red;">{{ $msg }}</div>
        @endif
        <div class="form-group">
          <label for="inputEmail" class="col-lg-2 control-label">Email</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-2 control-label">Password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>

  <script>
    $(function() {
      $("#login_form").validator();
    })
  </script>
@include('inc.footer');
