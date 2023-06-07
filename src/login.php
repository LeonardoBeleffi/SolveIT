<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="application-name" content="SolveIT" />
    <meta name="description" content="UNIBO Web Project" />
    <meta name="author" content="Beleffi Leonardo, Sangiorgi Marco, Vuksan Tiziano" />
    <meta name="keywords" content="Solveit, Solvit, Solveet, Slovit, Solveti, Bug, Solution, Solve, Fix, StackOverflow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In - SolveIT</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css" />
  </head>
  <body>
    <header>
      <div>
<!-- logo -->
        <img src="/resources/icons/logo.svg" alt="logo" />
      </div>
    </header>

    <main class="flexContainer">
      <section  id="loginSection">
        <h1>Log In</h1>
        <form>
          <div>
            <label>Username<input type="text" id="username" name="username"></label>
          </div>
          <div>
            <label>Password<input type="password" id="password" name="password"/></label>
          </div>
          <div>
            <a href="./forgotPassword.php">Forgot your password?</a>
          </div>  
          <div>
            <a href="./forgotUsername.php">Forgot your username?</a>
          </div>
          <div> 
            <input type="submit" value="Log In" />
          </div>
        </form>
      </section>
    </main>

    <footer>
      <a href="./about.php">
<!-- ALT tutorial -->
        <img src="../resources/icons/info.svg" alt="Informations about this site" />
      </a>
    </footer>
  </body>
</html>
<!-- missing php -->

