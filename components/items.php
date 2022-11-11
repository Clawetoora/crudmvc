
<div class="row">
    <div class="grid mb-5">

     <?php foreach ($items as $item) {?>

 <div class="itemas">

<div class="img-container mb-3">
        <p><?=$item->category?></p>
                        <!-- IMAGES LOGIKA -->
<img src=<?php
if ($item->category == "Virtuvė") {
	echo "'./images/kitchen.jpg'";
}
	if ($item->category == "Svetainė") {
		echo "'./images/livingroom.jpg'";
	}
	if ($item->category == "Miegamasis") {
		echo "'./images/bedroom.jpg'";
	}
	if ($item->category == "Tualetas") {
		echo "'./images/bathroom.jpg'";
	}

	?> alt="">

</div>



        <div class="item-info-container">
        <h4><?=$item->name?></h4>
        <h5>Kaina <?=$item->price?>Eur</h5>
        <p><?=$item->about?></p>

        <div class="edit-btns-container">
            <form action="" method="post">
                <input type="hidden" name="id" value=" <?=$item->id?>">
                <button id="edit-btn"type="submit" name="edit" class="btn-edit">edit</button>
            </form>
            <form action="" method="post">
                <input type="hidden" name="id" value=" <?=$item->id?>">
                <button type="submit" name="destroy" class="btn-delete">delete</button>
            </form>
        </div>
    </div>
 </div>
            <?php }?>


        </div>

        </div>