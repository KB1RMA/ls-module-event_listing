<?php

class EventListing_Actions extends Cms_ActionScope {

	public function events() {
	
		$this->data['events'] = EventListing_Event::create()->find_all();
		
	}

}
