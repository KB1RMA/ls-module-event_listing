<?php

class EventListing_Events extends Backend_Controller {

	public $implement = 'Db_ListBehavior, Db_FilterBehavior, Db_FormBehavior';
	public $list_model_class = 'EventListing_Event';
	
	public $list_search_enabled = true;
	public $list_search_fields = array('@title', '@short_description', '@description');
	public $list_search_prompt = 'find events by title or content';
	
	public $form_create_title = 'New Event';
	public $form_edit_title = 'Edit Event';
	public $form_not_found_message = 'Event not found';
	public $form_model_class = 'EventListing_Event';
	public $form_redirect = null;

	public function __construct() {
		parent::__construct();
		$this->list_record_url = url('/eventlisting/events/edit/');
		$this->form_redirect = url('/eventlisting/events/');
	}

	public function index() {
		$this->app_module_name = 'Event Listings';
		$this->app_page_title = 'Events';		
	}
	
}