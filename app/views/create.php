
<form action="/user/store" method="post" id="form-create">
    <h2>Criar novo usuario</h2>
    <?php echo getFlash("message"); ?>
    <label for="">
        <input type="text" name="firstName" placeholder="Seu primeiro nome...">
        <?php echo getFlash("firstName")?>
    </label>

    <label for="">
        <input type="text" name="lastName" placeholder="Seu ultimo nome ...">
        <?php echo getFlash("lastName"); ?>
    </label>

    <label for="">
        <input type="text" name="username" placeholder="Seu nome de usuario ...">
        <?php echo getFlash("username")?>
    </label>

    <label for="">
        <input type="email" name="email" placeholder="Seu email...">
        <?php echo getFlash("email")?>
    </label>

    <label for="">
        <input type="password" name="password" placeholder="Sua senha ...">
        <?php echo getFlash("password")?>
    </label>

    <label for="">
        <input type="submit" value="Criar" style="background: green; color: white;">
    </label>
</form>