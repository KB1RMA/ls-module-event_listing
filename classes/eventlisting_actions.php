<?php

class EventListing_Actions extends Cms_ActionScope {

	public function events() {
	
		$this->data['events'] = EventListing_Event::create()->find_all();
		
	}
	
	public function event() {

		$this->data['event'] = EventListing_Event::create()->find_by_url_title( $this->request_param(-1) );

	}

}
