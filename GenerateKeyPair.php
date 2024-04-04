<!DOCTYPE html>
<html>
<head>
    <title>PHP Code in HTML</title>
</head>
<body>
    <?php
    // FILEPATH: Untitled-2
    // Generate a new RSA key pair
    $rsaKey = openssl_pkey_new([
        'private_key_bits' => 1024,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ]);

    // Check if the RSA key pair was generated successfully
    if ($rsaKey === false) {
        echo 'Failed to generate RSA key pair.';
        exit;
    }

    // Get the private key
    $privateKey = '';
    openssl_pkey_export($rsaKey, $privateKey);

    // Check if the private key was obtained successfully
    if (empty($privateKey)) {
        echo 'Failed to get private key.';
        exit;
    }

    // Get the public key details
    $publicKeyDetails = openssl_pkey_get_details($rsaKey);

    // Check if the public key details were obtained successfully
    if ($publicKeyDetails === false) {
        echo 'Failed to get public key details.';
        exit;
    }

    // Get the public key
    $publicKey = $publicKeyDetails['key'];

    // Check if the public key was obtained successfully
    if (empty($publicKey)) {
        echo 'Failed to get public key.';
        exit;
    }

    // Generate a div element with the private key and public key
    echo '<div>Private Key: ' . $privateKey . '</div>';
    echo '<div>Public Key: ' . $publicKey . '</div>';

    // Generate the private key PEM file
    $privateKeyPem = openssl_pkey_get_private($privateKey);
    openssl_pkey_export_to_file($privateKeyPem, 'private_key.pem');

    // Generate the public key PEM file
    $publicKeyPem = openssl_pkey_get_public($publicKey);
    openssl_pkey_export_to_file($publicKeyPem, 'public_key.pem');

    // Display the private key and public key PEM files in div elements
    echo '<div>Private Key PEM: ' . file_get_contents('private_key.pem') . '</div>';
    echo '<div>Public Key PEM: ' . file_get_contents('public_key.pem') . '</div>';

    // Generate Ethereum private key
    $ethPrivateKey = bin2hex(random_bytes(32));

    // Derive Ethereum public key from private key
    $ethPublicKey = '0x' . substr(hash('sha256', hex2bin($ethPrivateKey)), 0, 40);

    // Derive Ethereum address from public key
    $ethAddress = '0x' . substr(hash('ripemd160', hex2bin($ethPublicKey)), 0, 40);

    // Display Ethereum private key, public key, and address in div elements
    echo '<div>Ethereum Private Key: ' . $ethPrivateKey . '</div>';
    echo '<div>Ethereum Public Key: ' . $ethPublicKey . '</div>';
    echo '<div>Ethereum Address: ' . $ethAddress . '</div>';

    // Display the RSA key pair generation message in a div
    echo '<div>RSA key pair generated and saved to private_key.pem and public_key.pem files.</div>';
    ?>
</body>
</html>
