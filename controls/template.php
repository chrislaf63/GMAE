<div class="travel">
                <div class="select">
                    <input type="radio" name="edit" value=<?php echo $row->id_voyage ?>>
                </div>
                <div class="travel__picture">
                    <img src=<?php echo $row->image_url ?> alt="" width="500px">
                </div>
                <div class="travel__text">
                    <p class="formule"><?php echo $row->formule.' - '.$row->formule_2   ?></p>
                    <div class="travel__text_description">
                        <p class="travel__text__title"><?php echo $row->title ?></p>
                        <p class="description"><?php echo $row->description ?></p>
                        <p class="description"><?php echo $row->description2 ?></p>
                        <p class="description"><?php echo $row->description3?></p>
                        <p class="description"><?php echo $row->description4 ?></p>
                    </div>
                </div>
            </div>