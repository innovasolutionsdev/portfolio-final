<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $business = $_POST['business'] ?? '';
    $industry = $_POST['industry'] ?? '';
    $email = $_POST['email'] ?? '';
    $website = $_POST['website'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $timeline = $_POST['timeline'] ?? '';
    $notes = $_POST['notes'] ?? '';
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit;
    }
    
    // Email recipient (your email address)
    $to = "nimeshraja18@gmail.com";
    
    // Email subject
    $subject = "New Contact Form Submission from $name";
    
    // Email message
    $message = "
    <html>
    <head>
        <title>New Contact Form Submission</title>
    </head>
    <body>
        <h2>New Contact Form Submission</h2>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Name:</td>
                <td>$name</td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td>$phone</td>
            </tr>
            <tr>
                <td>Business Name:</td>
                <td>$business</td>
            </tr>
            <tr>
                <td>Industry:</td>
                <td>$industry</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>$email</td>
            </tr>
            <tr>
                <td>Website:</td>
                <td>$website</td>
            </tr>
            <tr>
                <td>Budget:</td>
                <td>$budget</td>
            </tr>
            <tr>
                <td>Timeline:</td>
                <td>$timeline</td>
            </tr>
            <tr>
                <td>Notes:</td>
                <td>$notes</td>
            </tr>
        </table>
    </body>
    </html>
    ";
    
    // Set email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";
    
    // Send email
    $mailSent = mail($to, $subject, $message, $headers);
    
    // Save to database (optional)
    // Database code would go here
    
    // Send response back
    if ($mailSent) {
        echo json_encode(['success' => true, 'message' => 'Form submitted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    }
} else {
    // If not a POST request
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>

