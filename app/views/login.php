<?php  if(!logged()): ?>
    <div id="box-login">
        <h2>Login</h2>

        <form action="/login" method="post" id="form-login">
            <label>
                <input type="text" name="username" placeholder="Seu usuario" value="marco">
            </label>

            <label>
                <input type="password" name="password" placeholder="Sua senha" value="123456">
            </label>

            <?php echo getFlash("message"); ?>

            <button class="button-green" type="submit"> Login </button>
        </form>
    </div>

<?php  else: ?>
    <h2>Ja está Logado! </h2>
<?php  endif; ?>