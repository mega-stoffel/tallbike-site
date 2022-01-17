<div class="events_cf_box">
    <style scoped>
        .events_cf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .events_cf_field{
            display: contents;
        }
    </style>
    <p class="meta-options events_cf_field">
        <label for="events_cf_Date">Datum</label>
        <input id="events_cf_Date" type="datetime-local" name="events_cf_Date"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'events_cf_Date', true ) ); ?>" >
    </p>
    <p class="meta-options events_cf_field">
        <label for="events_cf_Place">Treffpunkt</label>
        <input id="events_cf_Place" type="text" name="events_cf_Place"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'events_cf_Place', true ) ); ?>" >
    </p>
    <p class="meta-options events_cf_field">
        <label for="events_cf_Length">L&auml;nge (km)</label>
        <input id="events_cf_Length" type="number" name="events_cf_Length" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'events_cf_Length', true ) ); ?>" >
    </p>
    <!--
    </p>
    <p class="meta-options events_cf_field">
        <label for="events_cf_Time">Zeit</label>
        <input id="events_cf_Time" type="time" name="events_cf_Time" />
    -->
    <!--
    <p class="meta-options hcf_field">
        <label for="hcf_published_date">Published Date</label>
        <input id="hcf_published_date" type="date" name="hcf_published_date">
    </p><br>
    <p class="meta-options hcf_field">
        <label for="hcf_price">Price</label>
        <input id="hcf_price" type="number" name="hcf_price">
    </p>
    -->
</div>