<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="application-name" content="SolveIT" />
        <meta name="description" content="UNIBO Web Project" />
        <meta name="author" content="Beleffi Leonardo, Sangiorgi Marco, Vuksan Tiziano" />
        <meta name="keywords" content="Solveit, Solvit, Solveet, Slovit, Solveti, Bug, Solution, Solve, Fix, StackOverflow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign In - SolveIT</title>
        <link rel="stylesheet" type="text/css" href="./css/login.css" />
    </head>
    <body>
        <header>
            <img src="/resources/icons/logo.svg" alt="logo" />
        </header>

        <main>
            <section>
                <form>
                    <h1>Sign In</h1>
                    <div>
                        <div>
                            <label>Username<input type="text" id="username" name="username" /></label>
                            <label>Password<input type="password" id="password" name="password" /></label>
                            <a href="./forgotPassword.php">Forgot your password?</a>
                            <a href="./forgotUsername.php">Forgot your username?</a>
                        </div>
                        <input type="submit" value="Sign In" />
                    </div>
                </form>
            </section>
            <footer>
                <p>New to SolveIT? <a href="./register.php">Register here!</a></p>
            </footer>
        </main>

        <footer>
            <a href="./about.php">
                <!-- ALT tutorial -->
                <img src="/resources/icons/info.svg" alt="Informations about this site" />
            </a>
        </footer>
    </body>
</html>

