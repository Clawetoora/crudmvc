<div class="form-container">

<form class="<?=($edit) ? "" : "hidden"?> mt-3"id="forma" action="" method="post" >
    <div class="form-group">
        <label for="sel1">Kategorija</label>
        <select class=" form-control" name="category"id="sel1" value="<?=($edit) ? $item->category : ""?>">
            <option value="Virtuvė">Virtuvė</option>
            <option value="Miegamasis">Miegamasis</option>
            <option value="Svetainė">Svetainė</option>
            <option value="Tualetas">Tualetas</option>
        </select>
    </div>
    <div class="form-group">
        <label for="f1">Prekės pavadinimas</label>
        <input type="text" name="name" id="f1" class="form-control" value="<?=($edit) ? $item->name : ""?>" placeholder="Įveskite prekės pavadinimą">
    </div>
    <div class="form-group">
        <label for="f2">Kaina</label>
        <input type="number" step="0.01"name="price" id="f2" class="form-control" value="<?=($edit) ? $item->price : ""?>" placeholder="0.00">
    </div>
    <div class="form-group">
        <label for="f4">Prekės aprašymas</label>
        <textarea name="about" cols="40" rows="3" id="f4" class="form-control inputs-design" placeholder="Trumpas tekstas apie prekę" ><?=($edit) ? $item->about : ""?></textarea>
    </div>
    <?php if ($edit) {?>
        <input type="hidden" name="id" value="<?=$item->id?>">
        <button type="submit" name="update" class="btn-update mt-3 mb-3">Atnaujinti</button>
        <?php } else {?>
            <button type="submit" name="save" class="btn-save mt-3 mb-3">Išsaugoti</button>
            <?php }?>
        </form>
    </div>