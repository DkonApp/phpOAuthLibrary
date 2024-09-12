<?php
require 'OAuthLibrary.php';

$clientId = '1302'; // Your clientId
$clientSecret = 'your_client_secret'; // Your clientSecret
$tokenUrl = 'https://api.dkon.app/api/v3/method/account.signIn'; // URL to get the token
$redirectUri = 'your_redirect_uri'; // URL to redirect after authentication

$oauth = new OAuthLibrary($clientId, $clientSecret, $tokenUrl, $redirectUri);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $oauth->authenticate($username, $password);

    if ($result['success']) {
        // Successful authentication
        session_start();
        $_SESSION['accessToken'] = $result['accessToken'];
        $_SESSION['accountId'] = $result['accountId'];
        header('Location: dialogs.html');
        exit();
    } else {
        // Authentication error
        $errorMessage = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/a.css">
</head>
<body>
    <div class="container">
        <h1 class="logo">𝓓𝓪𝓵𝓪𝓶 𝓚𝓸𝓷𝓽𝓪𝓴</h1>
        <h2>Login</h2>
        <form id="login-form" class="form" method="POST">
            <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" class="button">Login</button>
        </form>
        <?php if (isset($errorMessage)): ?>
            <div id="login-error" class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <a href="register.html" class="link">Register</a>
    </div>
</body>
</html>
