@include('inc.header');
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <legend>THE LINK KNOWS ALL. SO CAN YOU.</legend>
          <div class="input-group">
            <input type="text" class="form-control" id="long_url" placeholder="Paste a link to shorten it">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" onclick="getShortUrl();">SHORTEN</button>
            </span>
          </div>
          <div id="result" style="display: none;">
            <div class="input-group">
              <label>Original URL: <a href="#" id="origin_url"></a></label>
            </div>
            <div class="input-group">
              <label>Shorten URL:  <a href="#" id="short_url"></a></label>
            </div>
          </div>
          <div id="error" style="display: none;">
            Can't find the URL
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function getShortUrl() {
      $("#result").hide();
      $("#error").hide();

      var url = $('#long_url').val();
      $.ajax({
        url: '/shorten',
        data: {
          url: url
        },
        success: function(res) {
          $("#result").show();

          $("#origin_url").attr('href', url);
          $("#origin_url").html(url);

          var short_url = document.location + 'url/' + res;
          $("#short_url").attr('href', short_url);
          $("#short_url").html(short_url);
        },
        error: function() {
          $("#error").show();
        }
      })
    }
  </script>
@include('inc.footer');
