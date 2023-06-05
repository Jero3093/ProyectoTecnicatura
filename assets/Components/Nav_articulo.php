<?php
if (isset($_SESSION["usuarioActivo"]) && $_SESSION['usu_rol'] == 1) {

    echo '
    <!--Nav-->
    <nav class="nav flex-nowrap">
        <a class="navbar-brand" onclick="irPaginaAnterior()"><img src="./../assets/icons/flecha-izquierda.png" class="Nav_BackButton-Icon" loading="lazy"></a>
        <!--Logo-->
        <div class="TitleContainer">
            <a class="navbar-brand" href="./../ecommerce/index.php"><img src="./../assets/icons/icon.png" class="Icon" loading="lazy"></a>
            </div>
        <a href="./../maderastablas/principal.php">
            <img src="./../assets/icons/admin.png" class="LoginButton__Icon" />     
        </a>
    </nav>';
} else if (isset($_SESSION["usuarioActivo"]) && $_SESSION['usu_rol'] > 1) {

    echo '<!--Nav-->
        <nav class="nav flex-nowrap">
            <a class="navbar-brand" onclick="irPaginaAnterior()"><img src="./../assets/icons/flecha-izquierda.png" class="Nav_BackButton-Icon" loading="lazy"></a>
            <!--Logo-->
            <div class="TitleContainer">
            <a class="navbar-brand" href="./../ecommerce/index.php"><img src="./../assets/icons/icon.png" class="Icon" loading="lazy"></a>
            </div>
            <!--Login Button-->
            <div class="NavButtons_Container">
                <a href="./../maderastablas/index.php"" class="LoginButton">
                    <img src="./../assets/icons/user.svg" class="LoginButton__Icon" loading="lazy">
                </a>
            </div>
        </nav>
        ';
   
    
} else {
    echo '<!--Nav-->
        <nav class="nav flex-nowrap">
            <a class="navbar-brand" onclick="irPaginaAnterior()"><img src="./../assets/icons/flecha-izquierda.png" class="Nav_BackButton-Icon" loading="lazy"></a>
            <!--Logo-->
            <div class="TitleContainer">
            <a class="navbar-brand" href="./../ecommerce/index.php"><img src="./../assets/icons/icon.png" class="Icon" loading="lazy"></a>
            </div>
            <!--Login Button-->
            <div class="NavButtons_Container">
                <a href="./../maderastablas/index.php" class="LoginButton">
                    <img src="./../assets/icons/user.svg" class="LoginButton__Icon" loading="lazy">
                </a>
            </div>
        </nav>';
}
