<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'eu',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'd4ea70bad159f7d970c5',
    '7be5494a8c1ab067df75',
    '1079004',
    $options
  );

  $data['message'] = 'STUDENTSSSSSS';
  $pusher->trigger('channel-1', 'event-1', $data);
?>