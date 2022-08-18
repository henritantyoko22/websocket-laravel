<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel Real Time Web socket Broadcast Using Events </title>
  <script src="{{asset('js/app.js')}}" crossorigin="anonymous"></script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />
 
</head>

<body>
    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2>Laravel Real Time Web socket Broadcast Using Events </h2>
            </div>
            <div class="panel-body">
              Logged In as  : {{@request()->username}}
            <div id="messages"></div>
            <form id="chatbox" action="{{url('send-notification')}}" >
              <div class="form-group">
                <label>Message</label>
                <input type="text" id='text' name="message" value="" class="form-control" />
              </div>
              <div class="form-group">
                <button class="btn btn-primary">Send</button>
              </div>
            </form>
                
            </div>
        </div>
    </div>
</body>
@vite('resources/js/app.js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
      Echo.channel('my-notifications')
      .listen('SendNotification', (e) => {
        $("#messages").append("<br>"+JSON.stringify(e));
      });

      $("#chatbox").on("submit", function(e) {
          e.preventDefault();
          var action = $(this).attr("action");
          var message = $("#text").val();
         
            $.get(action+"?message="+message, function(data) {
              $("#text").val('');
                 
            }) 
            return false;
        });
    
    });
  </script>
</html>