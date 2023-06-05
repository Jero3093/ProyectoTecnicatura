<?php
if (isset($_SESSION["usuarioActivo"]) && $_SESSION['usu_rol'] == 1) {

    echo '
    <!--Nav-->
    <nav class="nav">
        <div class="Nav_Menu-Open">
            <img src="./../assets/icons/Menu.png" class="LoginButton__Icon" />
        </div>
        <div class="TitleContainer">
            <a class="navbar-brand" href="./../ecommerce/index.php"><img src="./../assets/icons/icon.png" class="Icon" loading="lazy"></a>
        </div>
        <div class="Nav-Content-Container">
            <!--Categories List-->
            <div class="dropdown">
            <select name="categoria" id="select__categoria" class="form-select border-2 text-black Nav-DropdownButton">
                            <option value="none">Categorias</option>';
                           cargarCategorias();
              echo'</select>
            </div>
            <input type="search" name="txt_search" id="txt_search" class="Nav-InputSearch search_ecommerce" placeholder="Buscar: ">
        </div>
        <a href="./../maderastablas/principal.php">
            <img src="./../assets/icons/admin.png" class="LoginButton__Icon" />
        </a>
    </nav>';

} else if (isset($_SESSION["usuarioActivo"]) && $_SESSION['usu_rol'] > 1) {

    echo '<!--Nav-->
        <nav class="nav flex-nowrap">
            <div class="Nav_Menu-Open">
                <img src="./../assets/icons/Menu.png" class="LoginButton__Icon" />
            </div>
            <div class="TitleContainer">
            <a class="navbar-brand" href="./../ecommerce/index.php"><img src="./../assets/icons/icon.png" class="Icon" loading="lazy"></a>
            </div>
            <div class="Nav-Content-Container">
                <!--Categories List-->
                <div class="dropdown">
                <select name="categoria" id="select__categoria" class="form-select border-2 text-black Nav-DropdownButton">
                <option value="none">Categorias</option>';
               cargarCategorias();
        echo'</select>
                </div>
                <input type="search" name="txt_search" id="txt_search" class="Nav-InputSearch search_ecommerce" placeholder="Buscar: ">
            </div>
            <!--Login Button-->
        <div class="NavButtons_Container">
            <a href="./../maderastablas/index.php" class="LoginButton">
                <img src="./../assets/icons/user.svg" class="LoginButton__IconS" loading="lazy">
            </a>
        </div>
        </nav>';
} else {

    echo '<!--Nav-->
        <nav class="nav flex-nowrap">
            <div class="Nav_Menu-Open">
                <img src="./../assets/icons/Menu.png" class="LoginButton__Icon" />
            </div>
            <div class="TitleContainer">
            <a class="navbar-brand" href="./../ecommerce/index.php"><img src="./../assets/icons/icon.png" class="Icon" loading="lazy"></a>
            </div>
            <div class="Nav-Content-Container">
                <!--Categories List-->
                <div class="dropdown">
                <select name="categoria" id="select__categoria" class="form-select border-2 text-black Nav-DropdownButton">
                <option value="none">Categorias</option>';
               cargarCategorias();
        echo'</select>
                </div>
                <input type="search" name="txt_search" id="txt_search" class="Nav-InputSearch search_ecommerce" placeholder="Buscar: ">
            </div>
            <!--Login Button-->
        <div class="NavButtons_Container">
            <a href="./../maderastablas/index.php" class="LoginButton">
                <img src="./../assets/icons/user.svg" class="LoginButton__IconS" loading="lazy">
            </a>
        </div>
        </nav>';
}
