<?
function send_email( $email, $from, $to, $subj, $body ) {
  sleep(rand(1, 10));
  return 1;
}

$conn = new mysqli('localhost', '*****', '******', '*****');

if ($conn->connect_error) {

  die('Connection failed: ' . $conn->connect_error);
}

$pid  = getmypid();

$conn->query('INSERT INTO sending_emails (email, started, pid) 
    SELECT u.email, now(), '.$pid.' FROM users u
      LEFT JOIN emails e ON e.email = u.email
      WHERE (u.confirmed = 1 OR e.valid) AND u.validts + (3*86400) > UNIX_TIMESTAMP() 
        AND u.email NOT IN (SELECT email FROM sending_emails) LIMIT 100');

$rows = $conn->query('SELECT se.email, u.username FROM sending_emails se JOIN users u ON se.email = u.email WHERE se.pid = '.$pid);

if ($rows->num_rows > 0) {

  while($row = $rows->fetch_assoc()) {

    $result = send_email($row['email'], 'robots@test.ts', $row['email'], 'subscription is expiring
soon', $row['username'].', your subscription is expiring
soon');
    $conn->query('UPDATE sending_emails SET done = 1 WHERE email = "'.$row['email'].'"');
  }
}

mysqli_close($conn);
