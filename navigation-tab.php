<div class="header-login header-elements right">
    <div class="login-wrap">
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </div>
</div>

<div class="header-search-form header-elements right">
    <form role="search" method="GET" action="search">
    <input type="text" value="" name="q">
</form>
</div>

<div class="header-navigation header-elements right">
<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ,'container' => false) ); ?>
</div>