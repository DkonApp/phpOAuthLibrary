# OAuth Library for PHP

This is a simple PHP library for handling OAuth authentication. It provides a straightforward way to authenticate users using their credentials and manage access tokens.

## Features

- Easy integration with OAuth-based APIs.
- Simple authentication method.
- Session management for storing access tokens and account IDs.

## Requirements

- PHP 7.0 or higher
- cURL extension enabled in PHP

## Installation

1. Clone the repository or download the files.
2. Include the `OAuthLibrary.php` file in your project.

```php
require 'OAuthLibrary.php';
```

## Usage

### Step 1: Initialize the Library

Create an instance of the `OAuthLibrary` class by providing the necessary parameters:

```php
$clientId = 'your_client_id';
$clientSecret = 'your_client_secret';
$tokenUrl = 'https://api.example.com/oauth/token'; // Replace with your token URL
$redirectUri = 'your_redirect_uri'; // Replace with your redirect URI

$oauth = new OAuthLibrary($clientId, $clientSecret, $tokenUrl, $redirectUri);
```

### Step 2: Authenticate User

You can authenticate a user by calling the `authenticate` method with the username and password:

```php
$result = $oauth->authenticate($username, $password);

if ($result['success']) {
    // Successful authentication
    session_start();
    $_SESSION['accessToken'] = $result['accessToken'];
    $_SESSION['accountId'] = $result['accountId'];
    header('Location: dialogs.html'); // Redirect to the desired page
    exit();
} else {
    // Handle authentication error
    $errorMessage = $result['message'];
}
```

### Step 3: HTML Form

You can create a simple HTML form for user login:

```html
<form id="login-form" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
```

## Example

An example of how to use the library can be found in the `example.php` file. This file demonstrates the complete flow of user authentication.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue for any suggestions or improvements.

## Contact

For any questions or inquiries, please contact https://dkon.app/dev .

---

Feel free to modify the README as needed to fit your project specifics, such as the license type, contact information, and any additional features or instructions you want to include.
