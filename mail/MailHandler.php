<?php
class MailHandler {
    private $conf;
    
    public function __construct($config) {
        $this->conf = $config;
    }
    
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public function sendWelcomeEmail($userEmail, $username) {
        // Load PHPMailer from your plugins directory
        require 'plugins/PHPMailer/vendor/autoload.php';
        
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $this->conf['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->conf['smtp_user'];
            $mail->Password = $this->conf['smtp_pass'];
            $mail->SMTPSecure = $this->conf['smtp_secure'];
            $mail->Port = $this->conf['smtp_port'];
            
            // Recipients
            $mail->setFrom($this->conf['admin_email'], $this->conf['site_name']);
            $mail->addAddress($userEmail, $username);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to ' . $this->conf['site_name'];
            $mail->Body = $this->getWelcomeEmailBody($username);
            $mail->AltBody = "Welcome to {$this->conf['site_name']}, $username! Thank you for joining our community.";
            
            return $mail->send();
            
        } catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
    
    private function getWelcomeEmailBody($username) {
        return "
            <html>
            <body>
                <h2>Welcome to {$this->conf['site_name']}!</h2>
                <p>Dear $username,</p>
                <p>Thank you for joining our community. We're excited to have you on board!</p>
                <p>Best regards,<br/>The {$this->conf['site_name']} Team</p>
            </body>
            </html>
        ";
    }
}
?>