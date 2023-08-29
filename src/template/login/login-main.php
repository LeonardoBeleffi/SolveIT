<section>
    <div>
        <form action="/src/utils/checkLogin.php" method="post">
            <h2>Sign In</h2>
            <?php loadErrorMsg(); ?>
            <div>
                <div>
                    <label>Username<input type="text" id="username" name="username" maxlength="128"/></label>
                    <label>Password<input type="password" id="password" name="password" maxlength="128" required/></label>
                    <!-- <a href="./forgotPassword.php">Forgot your password?</a>
                    <a href="./forgotUsername.php">Forgot your username?</a> -->
                </div>
                <input type="submit" value="Sign In"/>
            </div>
        </form>
    </div>
</section>
<footer>
    <p>New to SolveIT? <a href="./register.php">Register here!</a></p>
</footer>

