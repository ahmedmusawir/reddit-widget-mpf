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

<p>
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