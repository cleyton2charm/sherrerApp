<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="fonts/roboto/" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase.js"></script>
      <script src="js/firebase.js"></script>
      <!--
      <script src="https://cdn.firebase.com/libs/firebaseui/3.1.1/firebaseui.js"></script>
      <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.1.1/firebaseui.css" />      
      -->
      <script src="https://www.gstatic.com/firebasejs/ui/3.4.1/firebase-ui-auth__pt.js"></script>
      <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/3.4.1/firebase-ui-auth.css" />
    </head>
    <body>
      <!--<h1>Sherrer Menager App</h1>-->
      <div id="firebaseui-auth-container"></div>
      <div id="loader">Loading...</div>
      <script>
        // Initialize the FirebaseUI Widget using Firebase.
        var ui = new firebaseui.auth.AuthUI(firebase.auth());
        var uiConfig = {
          callbacks: {
            signInSuccessWithAuthResult: function(authResult, redirectUrl) {
              // User successfully signed in.
              // Return type determines whether we continue the redirect automatically
              // or whether we leave that to developer to handle.
              return true;
            },
            uiShown: function() {
              // The widget is rendered.
              // Hide the loader.
              document.getElementById('loader').style.display = 'none';
            }
          },
          // Will use popup for IDP Providers sign-in flow instead of the default, redirect.
          signInFlow: 'popup',
          signInSuccessUrl: 'index.php',
          signInOptions: [
            firebase.auth.EmailAuthProvider.PROVIDER_ID,
          ],
          // Terms of service url.
          tosUrl: '',
          // Privacy policy url.
          privacyPolicyUrl: ''
        };
        // The start method will wait until the DOM is loaded.
        ui.start('#firebaseui-auth-container', uiConfig);
      </script>
    </body>
  </html>