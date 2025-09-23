<?php
if ($_SERVER['REQUEST_URI'] === "/"):?>
    <a class="nav-link" data-target="about">
        About Us <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>


<?php
if ($_SERVER['REQUEST_URI'] === "/about"):?>
    <a class="nav-link" data-target="about">
        About Us <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>

<?php
if ($_SERVER['REQUEST_URI'] === "/join"):?>
    <a href="/about" class="nav-link">
        About Us <i class="bx bx-plus"></i>
    </a>
<?php endif; ?>


