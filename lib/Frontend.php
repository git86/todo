<?php
/**
 * Consult documentation on http://agiletoolkit.org/learn 
 */
class Frontend extends ApiFrontend {
    function init(){
        parent::init();
        // Keep this if you are going to use database on all pages
        $this->dbConnect();
        
        $this->add('Controller_Compat');

        // This will add some resources from atk4-addons, which would be located
        // in atk4-addons subdirectory.
        $this->addLocation('atk4-addons',array(
                    'php'=>array(
                        'mvc',
                        'misc/lib',
                        ),
                     'template'=>array(
                     	'misc/templates',
                     )
                    ))
            ->setParent($this->pathfinder->base_location);

        // A lot of the functionality in Agile Toolkit requires jUI
        $this->add('jUI');

        // Initialize any system-wide javascript libraries here
        // If you are willing to write custom JavaScritp code,
        // place it into templates/js/atk4_univ_ext.js and
        // include it here
        $this->js()
            ->_load('atk4_univ')
            ->_load('ui.atk4_notify')
            ;



        // If you wish to restrict actess to your pages, use BasicAuth class
        $this->add('SQLAuth')
        	
        	->setSource('user','email','password')
            ;
            
        $this->auth->dq->field('user.*');

        // This method is executed for ALL the peages you are going to add,
        // before the page class is loaded. You can put additional checks
        // or initialize additional elements in here which are common to all
        // the pages.

        // Menu:

        // If you are using a complex menu, you can re-define
        // it and place in a separate class
       
        
        if($this->api->auth->isLoggedIn()){
        
        	$this->add('Menu',null,'Menu')
            	->addMenuItem('Tasks','tasks')
            	->addMenuItem('account')
            	->addMenuItem('logout')
            	;
    	}else{
    	
    	    $this->add('Menu',null,'Menu')
            	->addMenuItem('Register','register')
            	->addMenuItem('Login','tasks')
            	;

    	
    	}
        
    }
    function page_examples($p){
        header('Location: '.$this->pm->base_path.'examples');
        exit;
    }
}
