<?php 



$option = '<ul class="list-group list-group-root well">';

foreach ($pincodes as $pincode) {

    if (in_array($pincode->pincodes_id, $pincodes_ids)) {
        $checked = 'checked';
    } else {
        $checked = '';
    }

    if (!in_array($pincode->pincodes_id, $usedPincodes)) {
        $option .= '<li href="#" class="list-group-item">
        <label style="width:100%">
          <input id="categories_' . $pincode->pincodes_id . '" ' . $checked . ' type="checkbox" class=" required_one categories sub_categories" name="pincodes[]" value="' . $pincode->pincodes_id . '">
        ' . $pincode->pincodes_val . '
        </label></li>';
    }
}
$option .= '</ul>';


print_r($option);


?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/manufacturers/pincode_view.blade.php ENDPATH**/ ?>