<?php

class EventListing_Event extends Db_ActiveRecord {

	public $table_name = 'eventlisting_events';
	
	public $custom_columns = array('multi_day'=>db_number);
	
	public $implement = 'Db_AutoFootprints';
	public $auto_footprints_visible = true;
	public $auto_footprints_default_invisible = false;
	
	public function define_columns( $context = null ) {
		$this->define_column('id', '#');
		$this->define_column('title', 'Title')->validation()->required('Please specify a title for the event');
		$this->define_column('url_title', 'URL Title')->validation()->fn('mb_strtolower')->regexp('/^[0-9a-z_-]*$/i', 'URL Title can contain only latin characters, numbers, underscores and the minus sign')->unique('The URL Title "%s" already in use. Please enter another URL Title.');		
		$this->define_column('start_date', 'Event Start Date')->validation()->required('Please specify a date for the event');
		$this->define_column('end_date', 'Event End Date');
		$this->define_column('description', 'Description');
		$this->define_column('event_url', 'Registration URL')->validation()->url('Must be a valid url!');
		$this->define_column('short_description', 'Short Description');
		
	}
	
	public function define_form_fields( $context = null ) {
		$this->add_form_field('title', 'left')->tab('General parameters')->comment('Used to display the title of the event in the listing', 'above');
		$this->add_form_field('url_title', 'right')->tab('General parameters')->comment('To reference the event in URLs.', 'above');
		$this->add_form_field('start_date', 'left')->tab('General parameters')->comment('The day the event starts', 'above');
		$this->add_form_field('end_date', 'right')->tab('General parameters')->comment('If only a single day event, leave this field blank.', 'above');
		$this->add_form_field('event_url')->tab('General parameters');
		$this->add_form_field('short_description')->tab('General parameters')->renderAs(frm_html)->comment('Short description to be shown on the event listing page', 'above');
		$this->add_form_field('description')->renderAs(frm_html)->size('huge')->tab('General parameters');
	
	}

	public static function create() {
		return new self();
	}
	
	public function eval_multi_day() {
	
		if ( $this->start_date != $this->end_date )
			return true;
		
		return false;
	
	}
	
	public function before_validation_on_create( $deferred_sesion_key = null ) {
	
		if ( empty($this->url_title) )
			$this->url_title = $this->generate_unique_url_title($this->title);	
	
	}
	
	public function before_save( $deferred_session_key = null ) {
		
		if ( empty($this->end_date) )
			$this->end_date = $this->start_date;
	
	}
	
	public function generate_unique_url_title( $name ) {
		$separator = Phpr::$config->get('URL_SEPARATOR', '_');
		
		$url_name = preg_replace('/[^a-z0-9]/i', $separator, $name);
		$url_name = str_replace($separator.$separator, $separator, $url_name);
		if (substr($url_name, -1) == $separator)
			$url_name = substr($url_name, 0, -1);
			
		$url_name = trim(mb_strtolower($url_name));

		$orig_url_name = $url_name;
		$counter = 1;
		while (Db_DbHelper::scalar('select count(*) from eventlisting_events where url_title=:url_title', array('url_title'=>$url_name))) {
			$url_name = $orig_url_name.$separator.$counter;
			$counter++;
		}
		return $url_name;
	}

}
