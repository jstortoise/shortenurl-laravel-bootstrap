@include('inc.header');
  <div class="container">
    <div class="row">
      <h1>Shortened URL List</h1>
      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>No</th>
            <th>Orginal URL</th>
            <th>Shorten URL</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 0; $i < count($urls); $i++)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $urls[$i]->long_url }}</td>
              <!-- <td>{{ Request::root() }}/url/{{ $urls[$i]->short_code }}</td> -->
              <td>{{ Request::path() }}</td>
            </tr>
          @endfor
        </tbody>
      </table>
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
