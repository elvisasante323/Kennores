<?php
if ($_SERVER['REQUEST_URI'] === "/"):?>
    <a class="nav-link" data-target="services">
        Our Services <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>

<?php
if ($_SERVER['REQUEST_URI'] === "/about"):?>
    <a class="nav-link" data-target="services">
       Our Services <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>

<?php
if ($_SERVER['REQUEST_URI'] === "/join"):?>
    <a href="/" class="nav-link">
        Our Services <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>
