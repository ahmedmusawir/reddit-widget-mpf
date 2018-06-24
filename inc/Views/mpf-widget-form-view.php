<p>
	<label 
		for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
		<?php esc_attr_e( 'Title:', 'text_domain' ); ?>
	</label> 
	<input class="widefat" 
		id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
		name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
		type="text" 
		value="<?php echo esc_attr( $title ); ?>"
	>
</p>

<!-- <p>
	<label 
		for="<?php echo esc_attr( $this->get_field_id( 'reddit_subject' ) ); ?>">
		<?php esc_attr_e( 'Reddit Subject:', 'text_domain' ); ?>
	</label> 
	<input class="widefat" 
		id="<?php echo esc_attr( $this->get_field_id( 'reddit_subject' ) ); ?>" 
		name="<?php echo esc_attr( $this->get_field_name( 'reddit_subject' ) ); ?>" 
		type="text" 
		value="<?php echo esc_attr( $reddit_subject ); ?>"
	>
</p> -->

<p>
	<label class="mpf-label"><?php _e( 'Reddit Subject:', 'front-to-back' ) ?></label>
    <select
        type="text"
        class="widefat mpf-input" 
        id="<?php echo $this->get_field_id( 'reddit_subject' ); ?>"
        name="<?php echo $this->get_field_name( 'reddit_subject' ); ?>"
    >
        <option value="wordpress" <?php selected( 'wordpress', $instance[ 'reddit_subject' ], true ); ?>>
            <?php _e( 'WordPress', 'front-to-back' ); ?>
        </option>
        <option value="javascript" <?php selected( 'javascript', $instance[ 'reddit_subject' ], true ); ?>>
            <?php _e( 'Javascript', 'front-to-back' ); ?>
        </option>
        <option value="science" <?php selected( 'science', $instance[ 'reddit_subject' ], true ); ?>>
            <?php _e( 'Science', 'front-to-back' ); ?>
        </option>
        
    </select> 	
</p>

<p>
	<label 
		for="<?php echo esc_attr( $this->get_field_id( 'reddit_count' ) ); ?>">
		<?php esc_attr_e( 'Reddit Count:', 'text_domain' ); ?>
	</label> 
	<input class="widefat" 
		id="<?php echo esc_attr( $this->get_field_id( 'reddit_count' ) ); ?>" 
		name="<?php echo esc_attr( $this->get_field_name( 'reddit_count' ) ); ?>" 
		type="number" 
		value="<?php echo $reddit_count; ?>"
	>
</p>