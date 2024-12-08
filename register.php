<!DOCTYPE html>
<html lang="en">

<?php require("start.php"); ?>

  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Page</title>
  </head>

  <body>
    <div class="flex-container arialfont">
      <div class="center">
        <img
          class="default-image-size img-rounded"
          src="./images/user.png"
          class="img-rounded"
          alt="Login page"
        />
        <h3>Register yourself</h3>
        <fieldset class="dotted-border fieldsetstyling">
          <legend>Register</legend>
          <form id="register_form" action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required /><br />
            <br />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />
            <br />
            <br />
            <label for="confirm_password">Confirm Password:</label>
            <input
              type="password"
              id="confirm_password"
              name="confirm_password"
              required
            /><br /><br />
          </form>
        </fieldset>
        <a class="nicebutton" button href="login.html" type="button">Cancel</a>
        <button
          class="nicebutton justbluebkgrd"
          type="submit"
          form="register_form"
          id="register_button"
          disabled
        >
          Register
        </button>
      </div>
    </div>
    <script src="register.js"></script>
  </body>
</html>