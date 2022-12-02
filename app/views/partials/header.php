<ul id="menu_list">
    <li> <a href="/"> Home </a> </li>
    <?php  if(!logged()): ?>
        <li> <a href="/login"> Login </a> </li>
        <li> <a href="/user/create"> Create </a> </li>
    <?php  endif; ?>
</ul>

<div id="status_login">
    Bem vindo, <?php echo (logged()) ? user()->firstName ." | <a href='/logout'> Sair </a>" : "visitante"; ?>
</div>
