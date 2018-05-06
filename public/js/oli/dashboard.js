var Dashboard = function() {

	// --------------------------------------------------------------------
	var self = this;

	this.__construct = function() {
		// console.log('Dashboard Created');
		Template = new Template();
		Event = new Event();
		// Result = new Result();
		load_todo();
		load_note();
		// console.log(
		// 		Template.todo({'todo_id': 1, 'content': "This is life"})
		// 	);
	};

	// --------------------------------------------------------------------
	
	var load_todo = function() {
		$.get('api/get_todo', function(obj) {
			var output = '';
			for(var i = 0; i<obj.length; i++) {
				output += Template.todo(obj[i]);
			}
			$('#list_todo').html(output);
		}, 'json');

	};

	// --------------------------------------------------------------------
	
	var load_note = function() {
		$.get('api/get_note', function(obj) {
			var output = '';
			for(var i = 0; i<obj.length; i++) {
				output += Template.note(o[i]);
			}
			$('#list_note').html(output)
		}, 'json');

	};

	// --------------------------------------------------------------------

	var create_todo = function() {

	};

	// --------------------------------------------------------------------

	var create_todo = function() {

	};

	// --------------------------------------------------------------------

	var update_todo = function() {

	};

	// --------------------------------------------------------------------

	var update_note = function() {

	};

	// --------------------------------------------------------------------

	var delete_todo = function() {

	};

	// --------------------------------------------------------------------

	var delete_note = function() {

	};

	// --------------------------------------------------------------------

	this.__construct();
};