<?
function check_email( $email ) {
  sleep(rand(1, 60));
  return rand(0, 1);
}

$conn = new mysqli('localhost', '*****', '*****', '*****');

if ($conn->connect_error) {

  die('Connection failed: ' . $conn->connect_error);
}

$pid  = getmypid();

$conn->query('INSERT INTO checking_emails (email, started, pid) SELECT email, now(), '.$pid.' FROM emails WHERE checked = 0 AND email NOT IN (SELECT email FROM checking_emails) LIMIT 100');

$rows = $conn->query('SELECT email FROM checking_emails WHERE pid = '.$pid);

if ($rows->num_rows > 0) {

  while($row = $rows->fetch_assoc()) {

    $result = check_email($row['email']);
    $conn->query('UPDATE emails SET checked = 1, valid = '.$result.' WHERE email = "'.$row['email'].'"');
    $conn->query('DELETE FROM checking_emails WHERE email = "'.$row['email'].'"');
  }
}

mysqli_close($conn);