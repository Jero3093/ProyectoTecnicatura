<?php
echo '
    <div class="Menu">
        <div class="Menu_Search">
        <input type="text" name="txt_search" id="txt_search" class="Menu_Search-Input search_ecommerce" placeholder="Buscar: ">
            <button class="Menu_Search-Button">
                <img src="./../assets/icons/Buscar.png" class="Menu_Search-Button-Icon" />
            </button>
        </div>
        <!--Categories List-->
            <div class="dropdown dropdown_menu" id="dropdown_menu">
            <select name="categoria" id="seleccionarOpcionMenu" class="form-select border-2 text-black Menu_DropdownButton">
                            <option value="none">Categorias</option>';
                            cargarCategorias();
            echo '</select>
            </div>
    </div>';
