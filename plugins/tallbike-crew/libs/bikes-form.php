<div class="bikes_cf_box">
    <style scoped>
        .bikes_cf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .bikes_cf_field{
            display: contents;
        }
    </style>
    <p class="meta-options hcf_field">
        <label for="bikes_cf_Creator">Erbauer:in</label>
        <input id="bikes_cf_Creator" type="text" name="bikes_cf_Creator"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'bikes_cf_Creator', true ) ); ?>">
    </p><br>
    <p class="meta-options hcf_field">
        <label for="bikes_cf_Complexity">Schwierigkeit</label>
        <input id="bikes_cf_Complexity" type="text" name="bikes_cf_Complexity"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'bikes_cf_Complexity', true ) ); ?>">
    </p>
    <br>
</div>