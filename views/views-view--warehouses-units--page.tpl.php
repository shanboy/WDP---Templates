<div id="locator-map">

</div>

<div class="wrapper center shadow">
    <br>
    <br>
    <br>

    <h1><?php print $header; ?></h1>
    <br>
    <br>
    <a id="quickResults" class="en pagestart switchDetails " href="/warehouses/quick">Show quick results</a>
    <a id="fullResults" class="en switchDetails active" href="/warehouses/">Show detailed results</a>
    <a id="downloadSelection" class="en switchDetails" href="#" target="_blank">Download selection</a>
    <br>
    <br>
    <br>

    <div id="warehouseResults">
        <?php
        $global_mez = 0;
        $global_warehouse = 0;
        $global_office = 0;
        $temp_id = '';
        $counter = 1;
        foreach ($view->result as $result) {
            if ($temp_id != $result->field_data_field_warehouse_units_id_field_warehouse_units_id) {
                if ($temp_id != '') {
                    // $node_tmp = $result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']];
                    foreach ($result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']]['field_warehouse_contact_entity'][0]['node'] as $elem) {
                        if (is_array($elem)) {
                            $elems = $elem;
                        }
                    }
                    $name = $elems['field_contacts_first_name'][0]['#markup'] . $elems['field_contacts_name'][0]['#markup'];
                    $email = $elems['field_contacts_email'][0]['#markup'];
                    $phone = $elems['field_contacts_telephone'][0]['#title'];
                    print '<tr class="total">
                <td class="unit">Total</td>
                <td> ca.' . $global_warehouse . 'm²</td>
                <td> ca.' . $global_mez . 'm²</td>
                <td> ca.' . $global_office . 'm²</td>
            </tr></tbody></table>
        <div class="contact">

            <h4>Contact</h4>                      <p>
              <span>' . $name . '</span>
                <span>E</span> ' . $email . '<br>
                <span>T</span> ' . $phone . '<br>
            </p>
        </div>

        <br class="clear">
    </div>
</div>';
                    $counter = 1;
                }
                $temp_id = $result->field_data_field_warehouse_units_id_field_warehouse_units_id;

                $related_entity = db_select('field_revision_field_warehouse_ref_wr_entity', 'refwr')
                    ->fields('refwr', array('entity_id'))
                    ->orderBy('entity_id', 'DESC')
                    ->condition('field_warehouse_ref_wr_entity_target_id', $temp_id,'=')
                    ->execute()
                    ->fetchField();
                $dco = db_select('field_data_field_warehouse_diff_co', 'dco')
                    ->fields('dco', array('field_warehouse_diff_co_value'))
                    ->condition('entity_id', $related_entity,'=')
                    ->execute()
                    ->fetchField();
                $euro = db_select('field_data_field_warehouse_diff_euro', 'euro')
                    ->fields('euro', array('field_warehouse_diff_euro_value'))
                    ->condition('entity_id', $related_entity,'=')
                    ->execute()
                    ->fetchField();

                $global_mez = 0;
                $global_warehouse = 0;
                $global_office = 0;
                @print '<div class="warehouse">
    <div class="main followLink">
        <img src="http://www.wdp.be/cache/warehouses/109/crop/285_209_WDP-Libercourt.jpg" class="warehousePreview"/>

        <div class="address">
            <div class="distance"></div>
            <div class="data">
                <p class="country">' . $result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']]['field_warehouse_country']['#items'][0]['taxonomy_term']->field_country_country_en['und'][0]['value'] . '</p>
                <p class="street">' . $result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']]['field_warehouse_address'][0]['#markup'] . '</p>
                <p class="city">' . $result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']]['field_warehouse_postcode'][0]['#markup'] . '<span>&nbsp;</span>' .  $result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']]['field_warehouse_city_en'][0]['#markup'] . '</p>
            </div>
        </div>

        <img src="/img/locator/breeam_cert.png" class="lblBreeam"/>';
        if ($dco || $euro) {
            print '<div class="list_es">
                            <div class="bg"></div>
                            <span><strong>save<br>' . $euro . '</strong><br>€/m²/y</span>
                            <span><strong>save<br>' . $dco . '</strong><br>kg CO₂/m²/y</span>
                        </div>';
        }
        print '<div class="button">
            <a href=node/' . $result->field_field_warehouse_units_id[0]['raw']['target_id'] . ' class="btnReadmore follow">Read more </a>
        </div>

        <br class="clear">
    </div>


    <div class="details">

        <table>
            <tbody><tr>
                <th class="unit">Unit</th>
                <th>Warehouse</th>
                <th>Mezzanine</th>
                <th>Office</th>
            </tr>
            <tr>
                <td class="unit">' . $counter . '</td>';
                if (!empty($result->field_field_warehouse_units_opp_may[0]['rendered']['#markup'])) {
                    print '<td> ca.' . preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_may[0]['rendered']['#markup']) . 'm²</td>';
                    $global_warehouse += (float)preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_may[0]['rendered']['#markup']);
                } else {
                    print '<td>-</td>';
                }
                if (!empty($result->field_field_warehouse_units_opp_mez[0]['rendered']['#markup'])) {
                    print '<td> ca.' . preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_mez[0]['rendered']['#markup']) . 'm²</td>';
                    $global_mez += (float) preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_mez[0]['rendered']['#markup']);
                } else {
                    print '<td>-</td>';
                }
                if (!empty($result->field_field_warehouse_units_opp_can[0]['rendered']['#markup'])) {
                    print '<td> ca.' . preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_can[0]['rendered']['#markup']) . 'm²</td>';
                    $global_office += (float)preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_can[0]['rendered']['#markup']);
                } else {
                    print '<td>-</td>';
                }
                print '</tr>';
            }
            else  {
                $counter++;
                print '<tr>
                <td class="unit">' . $counter . '</td>';
                if (!empty($result->field_field_warehouse_units_opp_may[0]['rendered']['#markup'])) {
                    print '<td> ca.' . preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_may[0]['rendered']['#markup']) . 'm²</td>';
                    $global_warehouse += (float)preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_may[0]['rendered']['#markup']);
                } else {
                    print '<td>-</td>';
                }
                if (!empty($result->field_field_warehouse_units_opp_mez[0]['rendered']['#markup'])) {
                    print '<td> ca.' . preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_mez[0]['rendered']['#markup']) . 'm²</td>';
                    $global_mez += (float)preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_mez[0]['rendered']['#markup']);
                } else {
                    print '<td>-</td>';
                }
                if (!empty($result->field_field_warehouse_units_opp_can[0]['rendered']['#markup'])) {
                    print '<td> ca.' . preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_can[0]['rendered']['#markup']) . 'm²</td>';
                    $global_office += (float)preg_replace("/[^0-9]/", '', $result->field_field_warehouse_units_opp_can[0]['rendered']['#markup']);
                } else {
                    print '<td>-</td>';
                }
                print '</tr>';

            }

        }

        // $node_tmp = $result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']];
        foreach ($result->field_field_warehouse_units_id[0]['rendered']['node'][$result->field_field_warehouse_units_id[0]['raw']['target_id']]['field_warehouse_contact_entity'][0]['node'] as $elem) {
            if (is_array($elem)) {
                $elems = $elem;
            }


        }
        $name = $elems['field_contacts_first_name'][0]['#markup'] . $elems['field_contacts_name'][0]['#markup'];
        $email = $elems['field_contacts_email'][0]['#markup'];
        $phone = $elems['field_contacts_telephone'][0]['#title'];
        print '<tr class="total">
                <td class="unit">Total</td>
                <td> ca.' . $global_warehouse . 'm²</td>
                <td> ca.' . $global_mez . 'm²</td>
                <td> ca.' . $global_office . 'm²</td>
            </tr></tbody></table>
        <div class="contact">

            <h4>Contact</h4>                      <p>
              <span>' . $name . '</span>
                <span>E</span> ' . $email . '<br>
                <span>T</span> ' . $phone . '<br>
            </p>
        </div>

        <br class="clear">
    </div>
</div>';
        $counter = 1;
        print $footer;
        print '</div></div>';
        ?>
<script type="text/javascript">
    


        if($("#locator-map").length>0)
        {
            var mapOptions = 
            {
                zoom: 5,
                disableDefaultUI: false,
                center: new google.maps.LatLng(44.447, 26.5086),// center the map to the country lat lang :)
                mapTypeControlOptions: 
                {
                  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                }
            };
            var map = new google.maps.Map(document.getElementById('locator-map'), mapOptions);

            var projects = new Array();
            var infoWindows = new Array();
                                 
                    project = new Object();
                    project.id = 127;
                    project.address = "Calarasi County, Fundulea (Romania)";
                    project.longitude = '26.5086';
                    project.latitude = '44.447';
                    project.url = '/warehouses/details/127';
                    project.total = '';
                    project.imageUrl = '/warehouses/127/crop/285_209_foto_sys_Galerij_Afbeelding_85.jpg';
                    projects.push(project);
                    
            if(projects.length>0)
            {
                    alert(projects);  
                $.each(projects, function(index, value){
                    var image = '/themes/WDP/img/marker.png';
                    var marker = new google.maps.Marker({
                      position: new google.maps.LatLng(value.latitude, value.longitude),
                      map: map,
                      project: value,
                      icon: image
                    });

                    var contentString = '<div>'+
                                        '<h4>'+ value.address +'</h4><br />'+
                                        '<div id="info-window-content">'+
                                        '<img style="float:left; margin-right:10px;" width="120" height="88" src="'+value.imageUrl+'" />' + 
                                        '<p><strong>Warehouse Total:</strong><br /> ' + value.total + '<br /><br /><a href="'+ value.url +'"">Read more</a></p>'+
                                        '</div>'+
                                        '</div>';

                    var infowindow = new google.maps.InfoWindow({
                          content: contentString
                    });

                    infoWindows.push(infowindow);

                    google.maps.event.addListener(marker, 'click', function()
                    {
                        $.each(infoWindows, function(index, iw){
                            iw.close();
                        });

                        infowindow.open(map,marker);
                    });

                });
            }

        }
</script>


