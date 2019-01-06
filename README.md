# User-verification

User verification during Sign up via mobile and email

## Database
Change the parameters in "credentials.php" according to your MySql database

To use the email verification, Turn on "Less secure app access" in Google->My Account->Security (Since gmail is used) Make sure, openssl and smtp is enabled in your XAMPP's php.ini file

## API used
TextLocal is used for SMS sending. Hash code, username and the whole code in php for sending sms can be acquired by registering on TextLocal

PHPMailer class is used for sending emails. Link: https://github.com/PHPMailer/PHPMailer
Include this in the same folder as the project
