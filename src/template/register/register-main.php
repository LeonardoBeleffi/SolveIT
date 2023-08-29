<section>
    <div>
        <form action="/src/utils/register.php" method="post" id="registration-form">
            <h2>Sign Up</h2>
            <?php loadErrorMsg(); ?>
            <div>
                <div>
                    <label>Name<input type="text" id="name" name="name" maxlength="128"required/></label>
                    <label>Surname<input type="text" id="surname" name="surname" maxlength="128" required/></label>
                    <label>Date of birth<input type="date" id="birth_date" name="birth_date"/></label>
                    <label>Phone number<input type="number" id="phone_number" name="phone_number" maxlength="45"/></label>
                    <label>Email<input type="email" id="email" name="email" maxlength="128" required/></label>
                    <label>Bio<textarea name="bio" form="registration-form" contentEditable maxlength="256">Your bio</textarea></label>
                    <label>Username<input type="text" id="username" name="username" maxlength="128" required/></label>
                    <label>Password<input type="password" id="password" name="password" maxlength="128" required/></label>
                </div>
                <div class="suggestions"></div>
                <input type="submit" value="Sign Up"/>
            </div>
        </form>
    </div>
</section>
<footer>
    <p>Already have an accout? <a href="./login.php">Log in here!</a></p>
</footer>
