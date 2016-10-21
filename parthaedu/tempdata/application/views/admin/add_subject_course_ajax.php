<option value="0">---Select Course---</option>
    <?php foreach($s as $sc) { ?>

        <option value="<?php echo $sc->course_id; ?>"><?php echo $sc->course_name ?></option>
    <?php
    }
    ?>


