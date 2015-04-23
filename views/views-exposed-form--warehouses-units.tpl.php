<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>

<h2>Find an available WDP warehouse</h2>
<?php 
 $selectName = $form['#info']['filter-field_warehouse_country_tid']['value'];
 $inputTextName = $form['#info']['filter-field_warehouse_postcode_value']['value'];
 $optionsArr = $form['field_warehouse_country_tid']['#options'];

?>

<?php
print '<select name="'.$selectName.'" placeholder="All Countries" id="ddlCustom" class="cd-select">';
                foreach ($optionsArr as $key => $value) {

                  if($value=="- Any -"){
                    $value = "All Countries";
                    print '<option selected value="'.$key.'">'.$value.'</option>';
                  }else{
                    print '<option value="'.$key.'">'.$value.'</option>';
                  }
                  
                }

print '</select>';
print '<input type="text" name="'.$inputTextName.'" id="txtLocator" placeholder="TOWN OR POSTAL CODE"/>';

?> 


<button type="submit">Find a warehouse <img src="/themes/WDP/img/template/btn_search.png"></button>
<br class="clear"/>


