<section>
    <form action="/src/utils/checkLogin.php" method="post">
        <h1>Sign In</h1>
        <div>
            <div>
                <label>Username<input type="text" id="username" name="username" /></label>
                <label>Password<input type="password" id="password" name="password" /></label>
                <a href="./forgotPassword.php">Forgot your password?</a>
                <a href="./forgotUsername.php">Forgot your username?</a>
            </div>
            <input type="submit" value="Sign In" />
            <?php   if(!empty(getErrorMsg())) : ?>
                        <div>
                            <label>ERROR: <?php echo getErrorMsg(); ?></label>
                        </div>
            <?php       setErrorMsg("");
                    endif; ?>
        </div>
    </form>
</section>
<footer>
<p>New to SolveIT? <a href="./register.php">Register here!</a></p>
</footer>