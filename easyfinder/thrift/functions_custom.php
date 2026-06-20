<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoloader

function sendEmail($recipientEmail, $subject, $message) {
    $mail = new PHPMailer(true); // Pass `true` to enable exceptions

    try {
        //Server settings
       /*
                  define('APP_MAIL_HOST', 'smtp.example.com'); // Specify your SMTP server
                  define('APP_MAIL_SMTPAuth', true); // Enable SMTP authentication
                  define('APP_MAIL_USERNAME', 'your@example.com'); // SMTP username
                  define('APP_MAIL_PASSWORD' , 'your_password'); // SMTP password
                  define('APP_MAIL_SMTPSECURE', 'tls'); // Enable TLS encryption, `ssl` also accepted
                  define('APP_MAIL_PORT', 587); // TCP port to connect to

                  */

        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = APP_MAIL_HOST; // Specify your SMTP server
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = APP_MAIL_USERNAME; // SMTP username
        $mail->Password = APP_MAIL_PASSWORD; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        //Recipients
        $mail->setFrom(APP_MAIL_ADDRESS, APP_FULLNAME); // Sender's email and name
        $mail->addAddress($recipientEmail); // Recipient's email

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send(); // Send the email
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email not sent
    }
}





function sendHtmlEmail($to, $subject, $message, $headers = []) {
    // Set content-type header for HTML email
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=utf-8';

    // Additional headers if needed (such as From, Cc, Bcc)
    // $headers[] = 'From: Your Name <your@example.com>';
    // $headers[] = 'Cc: another@example.com';

    // Join headers into a single string
    $headersString = implode("\r\n", $headers);

    // Set SMTP server and port using ini_set()
    ini_set('SMTP', 'smtp.example.com');
    ini_set('smtp_port', 587);


    // Send email using mail() function
    return mail($to, $subject, $message, $headersString);
}



function isEmailValid($email) {
    // Remove illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    // Validate email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Valid email address
    } else {
        return false; // Invalid email address
    }
}




/*
// Example usage
$v1 = 100; // Total value
$v2 = 75;  // Value covered by v2

$percentageCovered = calculatePerc($v1, $v2);
echo "v2 covers " . $percentageCovered . "% of v1.";

*/
function calculatePerc($v1, $v2) {
    if ($v1 == 0 || $v2 == 0) {
        return 0; // To avoid division by zero
    }

    // Calculate the percentage
    $percentage = ($v2 / $v1) * 100;

    $percentage= number_format($percentage, 2);
    return $percentage;
}






function limitCharacters($inputString, $maxLength) {
    /*
    // Example usage
    $inputString = "This is a long string that needs to be limited to a certain number of characters.";
    $maxLength = 30; // Limit the string to 30 characters

    $limitedString = limitCharacters($inputString, $maxLength);
    echo $limitedString; // Output: "This is a long string that ne..."

    */
    if (strlen($inputString) > $maxLength) {
        // If the input string is longer than $maxLength characters, truncate it
        $outputString = substr($inputString, 0, $maxLength) . "..."; // Add ellipsis for indication
    } else {
        // If the input string is shorter or equal to $maxLength characters, keep it as it is
        $outputString = $inputString;
    }

    return $outputString;
}



/*
// Example usage:
$phoneNo = "01234567890"; // Replace this with the phone number you want to test
$result = addCountryCode($phoneNo);
echo $result;
*/
function addCountryCode($phoneNo) {
    // Remove any non-numeric characters from the phone number
    $cleanPhoneNo = preg_replace('/[^0-9]/', '', $phoneNo);
    
    // Check if the cleaned phone number is 11 digits long
    if(strlen($cleanPhoneNo) == 11) {
        // If it starts with '0', remove '0' and add '+222'
        if(substr($cleanPhoneNo, 0, 1) == '0') {
            $cleanPhoneNo = '+234' . substr($cleanPhoneNo, 1);
            return $cleanPhoneNo;
        } else {
            // If it doesn't start with '0', add '+222'
            return '+234' . $cleanPhoneNo;
        }
    } else {
        // If the phone number is not 11 digits long, return an error message
        return "Invalid phone number";
    }
}

















function getMySQLPDOLink__($dsn = null, $options= null, $host, $database, $user, $password, $charset)
{
	/*if ($dsn==null) {
		$dsn = "mysql:host=".$host.";dbname=".$database.";charset=".$charset;
	}*/

	if ($dsn==null && $host=='') {
		$dsn = "mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";charset=".DB_CHARSET;
	}else{
    $dsn = "mysql:host=".$host.";dbname=".$database.";charset=".$charset;
  }



	if ($options==null) {
		$options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	    
	];
	}	
/*PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,*/
	try {
	     $pdo = new PDO($dsn, $user, $password, $options);
	     return $pdo;
	} catch (\PDOException $e) {
	     //throw new \PDOException($e->getMessage(), (int)$e->getCode());
	     return false;
	}

}



function getTotalDonationForProject($pdo,$campaign_id){

     $stmt = $pdo->prepare("SELECT  SUM(`donation_amount`) AS `total`  FROM `donations`  WHERE  `campaign_id`=? 
          -- AND `ownerId`=? 
          ");
      /*Execute SQL*/
      $stmt->execute([ $campaign_id]);//, $_SESSION[APP_SESSION_NAME]["ownerId"] ]);

    $result = $stmt->fetchAll();
    if($result){
    	return $result[0]['total'];
    }

    return 0;

}


function getTotalDonationsByUser($pdo,$user_id){

     $stmt = $pdo->prepare("SELECT  SUM(`donation_amount`) AS `total`  FROM `donations`  WHERE  `user_id`=? -- AND `ownerId`=? 
          ");
      /*Execute SQL*/
      $stmt->execute([ $user_id]);//, $_SESSION[APP_SESSION_NAME]["ownerId"] ]);

    $result = $stmt->fetchAll();
    if($result){
    	return $result[0]['total'];
    }

    return 0;

}











function getTotalCampaignsAmount($pdo){

     $stmt = $pdo->prepare("SELECT  SUM(`donate_goal`) AS `total`  FROM `campaigns` 
      -- WHERE `ownerId`=? 
      ");
      /*Execute SQL*/
      $stmt->execute();//[ $_SESSION[APP_SESSION_NAME]["ownerId"] ]);

    $result = $stmt->fetchAll();
    if($result){
    	return $result[0]['total'];
    }

    return 0;

}


function getTotalDonationsAmount($pdo){

     $stmt = $pdo->prepare("SELECT  SUM(`donation_amount`) AS `total`  FROM `donations` 
     --  WHERE   `ownerId`=? ");
      /*Execute SQL*/
      $stmt->execute();//[ $_SESSION[APP_SESSION_NAME]["ownerId"] ]);

    $result = $stmt->fetchAll();
    if($result){
    	return $result[0]['total'];
    }

    return 0;

}




function generateOTP($seed){
    //return 'OTP-'.$seed;
    $otp = rand(100000, 999999);
  return $otp;
     
}


?>