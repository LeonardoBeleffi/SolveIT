<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="application-name" content="SolveIT" />
        <meta name="description" content="UNIBO Web Project" />
        <meta name="author" content="Beleffi Leonardo, Sangiorgi Marco, Vuksan Tiziano" />
        <meta name="keywords" content="Solveit, Solvit, Solveet, Slovit, Solveti, Bug, Solution, Solve, Fix, StackOverflow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign Up - SolveIT</title>
        <link rel="stylesheet" type="text/css" href="./css/register.css" />
    </head>
    <body>
        <header>
            <!-- logo -->
            <img src="/resources/icons/logo.svg" alt="logo" />
        </header>

        <main class="flexContainer">
            <section  id="registerSection">
                <h1>Sign Up</h1>
                <form>
                    <div>
                        <label>Username<input type="text" id="username" name="username" /></label>
                    </div>
                    <div>
                        <label>Password<input type="password" id="password" name="password" /></label>
                    </div>
                    <div>
                        <a href="./login.php">Already an account? Sign in here!</a>
                    </div>
                    <div> 
                        <input type="submit" value="Sign Up" />
                    </div>
                </form>
            </section>
        </main>

        <footer>
            <a href="./about.php">
                <!-- ALT tutorial -->
                <img src="/resources/icons/info.svg" alt="Informations about this site" />
            </a>
        </footer>
    </body>
</html>
<!-- missing php -->

