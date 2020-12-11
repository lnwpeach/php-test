<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="12242211159-i2vo8ot586440flv34vv14pcl7r2i1un.apps.googleusercontent.com">
    <title>Document</title>
</head>
<body>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }
    </script>
</body>
</html>