<div class="badges_cf_box">
    <style scoped>
        .badges_cf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .badges_cf_field{
            display: contents;
        }
    </style>
    <p class="meta-options badges_cf_field">
        <label for="badges_cf_Points">Punkte</label>
        <input id="badges_cf_Points" type="number" name="badges_cf_Points"
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'badges_cf_Points', true ) ); ?>" >
    </p>

</div>