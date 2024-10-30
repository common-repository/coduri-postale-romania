<?php

/*
 * Widget to display news
 */

class CoduriPostale_Widget extends WP_Widget {

	function CoduriPostale_Widget() {
		$widget_ops = array( 'classname' => 'coduri_postale_widget', 'description' => __('Search for zip code or an address from Romania. ') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'coduri-postale-widget' );
		
		$this->WP_Widget( 'coduri-postale-widget', __('Coduri postale'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Variables from the widget settings.
		$title      = isset($instance['title']) ? $instance['title'] : '' ;
                $address    = ($instance['address'] == 'address') ? $instance['address'] : false ;
                $zip        = ($instance['zip'] == 'zip') ? $instance['zip'] : '' ;
                $email      = isset($instance['email']) ? $instance['email'] : '' ;
                $apiKey     = isset($instance['apiKey']) ? $instance['apiKey'] : '' ;
                $credits    = ($instance['credits'] == 'credits') ? $instance['credits'] : false ;
                                
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo '<h3 class="widget-title">' . $title . '</h3>';
                ?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#codpostal_form_adresa').hide();
    $('#codpostal_btn_adresa').click(function(){
        $(this).attr('checked','checked');
        $('#codpostal_btn_cod').removeAttr('checked');
        $('#codpostal_form_adresa').show();
        $('#codpostal_form_cod').hide();
    });
    $('#codpostal_btn_cod').click(function(){
        $(this).attr('checked','checked');
        $('#codpostal_btn_adresa').removeAttr('checked');
        $('#codpostal_form_adresa').hide();
        $('#codpostal_form_cod').show();
    });
});
</script>
<p id="codpostal_container_controls">
    <input type="radio" checked id="codpostal_btn_cod" /> <label for="codpostal_btn_cod"><?php echo _e('Cauta cod postal','coduri-postale'); ?></label> <input id="codpostal_btn_adresa" type="radio" /> <label for="codpostal_btn_adresa"><?php echo _e('Cauta adresa', 'coduri-postale'); ?></label>
</p>
<form id="codpostal_form_cod" method="POST" action="">
    <input type="hidden" value="<?php echo $email; ?>" name="uid1" />
    <input type="hidden" value="<?php echo $apiKey; ?>" name="uid2" />
    <input value="<?php echo $_POST['codpostal_judet'] ; ?>" type="text" placeholder="<?php echo _e('Judet','coduri-postale'); ?>" name="codpostal_judet" />
    <input value="<?php echo $_POST['codpostal_localitate'] ; ?>" type="text" placeholder="<?php echo _e('Localitate', 'coduri-postale'); ?>" name="codpostal_localitate" />
    <input value="<?php echo $_POST['codpostal_strada'] ; ?>" type="text" placeholder="<?php echo _e('Strada', 'coduri-postale'); ?>" name="codpostal_strada" />
    <input type="submit" name="codpostal_formular" value="<?php echo _e('Cauta', 'coduri-postale'); ?>" />
</form>
<form id="codpostal_form_adresa" method="POST" action="">
    <input type="hidden" value="<?php echo $email; ?>" name="uid1" />
    <input type="hidden" value="<?php echo $apiKey; ?>" name="uid2" />
    <input value="<?php echo $_POST['codpostal_cod'] ; ?>" type="text" placeholder="<?php echo _e('Cod postal','coduri-postale'); ?>" name="codpostal_cod" />
    <input type="submit" name="codpostal_formular_addr" value="<?php echo _e('Cauta', 'coduri-postale'); ?>" />
</form>
<div id="codpostal_mesaj_coduri">
<?php
    if($credits){
?>
Serviciu oferit de <a href="http://www.coduriro.ro" target="_blank">www.coduriro.ro</a>. <a target="_blank" href="http://www.coduriro.ro">Coduri postale romania</a>.
<?php
}
?>
</div>
<div id="codpostal_afisaredate">
    <?php include CODURIPOSTALE_PLUGIN_URL . 'check_form.php'; ?>
</div>
                <?php
                
		echo $after_widget;
        }

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
       
                $instance['address'] = strip_tags( $new_instance['address'] );
                $instance['credits'] = strip_tags( $new_instance['credits'] );
                $instance['title'] = strip_tags( $new_instance['title'] );
                $instance['zip'] = strip_tags( $new_instance['zip'] );
                $instance['email'] = strip_tags( $new_instance['email'] );
                $instance['apiKey'] = strip_tags( $new_instance['apiKey'] );
                
		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 
                    'title'             => __('Coduri postale'),
                    'credits'           => 'credits'
                );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
                <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget title:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<input <?php echo ($instance['address'] == 'address') ? 'checked' : ''; ?> id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="address" type="checkbox" /> Cautare coduri
		</p>
                <p>
			<input <?php echo ($instance['zip'] == 'zip') ? 'checked' : ''; ?> id="<?php echo $this->get_field_id( 'zip' ); ?>" name="<?php echo $this->get_field_name( 'zip' ); ?>" value="zip" type="checkbox" /> Cautare adrese
		</p>
                <p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email <i style="font-size:10px;color:#999;">(email address used to get the api key)</i>:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
		</p>
                <p>
			<label for="<?php echo $this->get_field_id( 'apiKey' ); ?>"><?php _e('Api Key <i style="font-size:10px;color:#999;">(api key recived via email)</i>:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'apiKey' ); ?>" name="<?php echo $this->get_field_name( 'apiKey' ); ?>" value="<?php echo $instance['apiKey']; ?>" style="width:100%;" />
                        <label for="<?php echo $this->get_field_id( 'apiKey' ); ?>"><?php _e('<i style="font-size:10px;color:#999;">Get your api key for free from <a href="http://www.coduriro.ro" target="_blank">here</a></i>:'); ?></label>
		</p>
        <p>
            <input <?php echo ($instance['credits'] == 'credits') ? 'checked' : ''; ?> id="<?php echo $this->get_field_id( 'credits' ); ?>" name="<?php echo $this->get_field_name( 'credits' ); ?>" value="credits" type="checkbox" /> Credits
        </p>
	<?php
	}
}

add_action( 'widgets_init', 'coduri_postale_new_widget' );
function coduri_postale_new_widget() {
        register_widget( 'CoduriPostale_Widget' );
}
?>
