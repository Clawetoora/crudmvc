
<form class=" mt-5 pb-3 filter-form mb-4"method="GET">


    <div class="filter-container mb-3">
        <div class="input-container">
            <input  type="radio" value="" name="filter" checked>
            <input type="radio" value="" id="visi" name="filter">
            <div class="radio-tile">
                <label for="visi">Visi</label>
            </div>
        </div>

    <?php foreach ($params as $key => $param) {?>
        <div class="input-container">
            <input type="radio" value="<?=$param?>" name="filter"  <?=(isset($_GET['filter'])) ? (($_GET['filter'] == $param) ? "checked" : "") : ""?> >
            <div class="radio-tile">
            <label for=""><?=$param?></label>
            </div>
        </div>
           <?php ;}?>

    </div>
    <!-- <select class="inputs-design " name="filter">
    <option value="">Visi</option>
        <?php foreach ($params as $key => $param) {?>
            <option value="<?=$param?>"><?=$param?></option>
           <?php ;}?>
    </select> -->
    <div class="col-1"></div>
    <div class="d-flex justify-content-center flex-wrap">
        <div>


        <select class="inputs-design" name="sort">
            <option disabled selected value="0">Rūšiuoti pagal...</option>
            <option value="1">Kaina nuo mažiausios</option>
            <option value="2">Kaina nuo didžiausios</option>
            <option value="3">Pagal pavadinimą a-z</option>
            <option value="4">Pagal pavadinimą z-a</option>
        </select>


        </div>

        <div>

            <label>Kaina nuo</label>
            <input type="number" name="from" class="fromto">
        </div>
        <div>
            <label>Kaina iki</label>
            <input type="number" name="to" class="fromto">
        </div>

    </div>
    <div class="col-1"></div>
    <div class="d-flex justify-content-center mt-3">
    <button class="d-flex justify-content-center pagr-filter" type="submit">Rūšiuoti</button>

        </div>
</form>


<form action="" method="GET">
    <div class="search-container d-flex align-items-center justify-content-center">
        <input type="text" name="search" id="" placeholder="Ieškoti...">
        <button type="submit" class="search-button">Ieškoti<ion-icon name="search-outline"></ion-icon></button>
    </div>
</form>