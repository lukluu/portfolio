<?php

/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
//$receiving_email_address = 'laode.lukmana88@gmail.com';


// if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//   include( $php_email_form );
// } else {
//   die( 'Unable to load the "PHP Email Form" Library!');
// }

// $contact = new ;
// $contact->ajax = true;

// $contact->to = $receiving_email_address;
// $contact->from_name = $_POST['name'];
// $contact->from_email = $_POST['email'];
// $contact->subject = $_POST['subject'];

// // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials

// $contact->smtp = array(
//   'host' => 'example.com',
//   'username' => 'example',
//   'password' => 'pass',
//   'port' => '587'
// );


// $contact->add_message( $_POST['name'], 'From');
// $contact->add_message( $_POST['email'], 'Email');
// $contact->add_message( $_POST['message'], 'Message', 10);

// echo $contact->send();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Ambil informasi dari formulir
  $nama = $_POST['name'];
  $email = $_POST['email'];
  $subjek = $_POST['subject'];
  $pesan = $_POST['message'];

  // Simpan data ke dalam array
  $data = array(
    'name' => $nama,
    'email' => $email,
    'subject' => $subjek,
    'message' => $pesan,
    'timestamp' => $tanggal_waktu = date('Y-m-d H:i:s', time())
  );

  // Konfigurasi header email
  $to = 'laode.lukmana88@gmail.com';
  $subject = $subjek;
  $message = $pesan;
  $headers = "From: " . $email . "\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  $headers .= "Content-Type: text/html\r\n";

  // Kirim email menggunakan fungsi mail()
  mail($to, $subject, $message, $headers);

  // Simpan data ke dalam file JSON
  $jsonFile = 'pesan.json';
  $jsonData = json_decode(file_get_contents($jsonFile), true);
  $jsonData[] = $data;
  file_put_contents($jsonFile, json_encode($jsonData));
  
  // Redirect ke halaman sukses
  header('Location: ../contact.php');
  exit;
}
