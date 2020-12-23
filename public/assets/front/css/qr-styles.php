<?php
header("Content-type: text/css; charset: UTF-8");

if(isset($_GET['color']))
{
  $color = '#'.htmlspecialchars($_GET['color']);
}
else {
  $color = "'" . htmlspecialchars($color) . "'";
}
?>

.title h2 {
    color: <?php echo htmlspecialchars($color); ?>;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background-color: <?php echo htmlspecialchars($color); ?>;
}
a {
    color: <?php echo htmlspecialchars($color); ?>;
}
.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a {
    color: <?php echo htmlspecialchars($color); ?>;
}
.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a::before {
    background: <?php echo htmlspecialchars($color); ?>2a;
}
.food-menu-area.food-menu-3-area .food-menu-items .single-menu-item .menu-price-btn a::after {
    border-color: <?php echo htmlspecialchars($color); ?>;
}
.food-menu-area .food-menu-items .single-menu-item .menu-price-btn span {
    color: <?php echo htmlspecialchars($color); ?>;
}
.menu-price-btn del {
    color: <?php echo htmlspecialchars($color); ?>;
}
.food-menu-area.food-menu-2-area .food-menu-items .single-menu-item:hover {
    border: 1px solid <?php echo htmlspecialchars($color); ?>;
}
#variationModal .btn-primary {
    background-color: <?php echo htmlspecialchars($color); ?>;
    border-color: <?php echo htmlspecialchars($color); ?>;
}

#variationModal .form-check span {
    color: <?php echo htmlspecialchars($color); ?>;
}

#variationModal .modal-title small {
    color: <?php echo htmlspecialchars($color); ?>;
}