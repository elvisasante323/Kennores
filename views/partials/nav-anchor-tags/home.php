<?php
if ($_SERVER['REQUEST_URI'] === "/"):?>
    <a class="nav-link" data-target="home">
        Home <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>

<?php
if ($_SERVER['REQUEST_URI'] === "/about" || $_SERVER['REQUEST_URI'] === "/join"):?>
   <a href="/" class="nav-link">
     Home <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>


