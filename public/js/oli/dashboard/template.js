var Template = function() {

	// --------------------------------------------------------------------

	this.__construct = function() {
		//console.log('Template Created');
	};

	// --------------------------------------------------------------------

	this.todo = function(obj) {

		var output = '';
		output += '<div id="'+ obj.todo_id +'">';
		output += '<span>' + obj.content + '</span>';
		output += '</div>';
		return output;
	}

	// --------------------------------------------------------------------

	this.__construct();
};