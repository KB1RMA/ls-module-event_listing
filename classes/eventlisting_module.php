<?php

class EventListing_Module extends Core_ModuleBase  {
    /**
     * Creates the module information object
     * @return Core_ModuleInfo
     */
	 
    protected function createModuleInfo() {
      return new Core_ModuleInfo(
        "Event Listing",
        "Adds an event listing and admin entry for them to be displayed on the frontend",
        "Keyed-Up Media LLC" );
    }
	
	public function listTabs($tabCollection) {
		$menu_item = $tabCollection->tab('eventlisting', 'Event Listings', 'events', 90);
		$menu_item->addSecondLevel('events', 'Events', 'events');
	}
	
}
