<!DOCTYPE html>
<head>
  <title>Pusher Test</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('d4ea70bad159f7d970c5', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('channel-1');
    channel.bind('event-1', function(data) {
      //alert(JSON.stringify(data));
      var myNewdata = JSON.stringify(data);
      toastr.success(myNewdata);
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>