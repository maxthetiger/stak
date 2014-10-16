/************************
 * 	 	Modules			*
 ************************/

ModulA = {

	init: function() {

	},

	fonction1: function() {

	}

}



/************************
*						*
*	Objet Principal	*
*						*
************************/


app = {
	
	/*
	 * Chargement du DOM
	 */
	init: function() {

		// On lance le ModulA
		ModulA.init()

	}

}

/************************
*						*
*	Chargement du DOM	*
*						*
************************/

$(function (){
	app.init()
})