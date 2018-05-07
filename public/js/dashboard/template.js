var Template = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        // console.log('Template Created');
    };
    
    // ------------------------------------------------------------------------
    
    this.todo = function(obj) {
        var output = '';
        if(obj.completed == 1) {

            output += '<div id="todo_'+ obj.todo_id +'" ">';
            output += '<span class="todo_complete">' + obj.content + '</span>';
        } else {
            output += '<div id="todo_'+ obj.todo_id +'">';
            output += '<span>' + obj.content + '</span>';
        }

        var data_completed = (obj.completed == 1) ? 0 : 1;
        var data_completed_text = (obj.completed == 1) ? 'Uncomplete' : 'Complete';
        
        output += '<a class="todo_update" data-id="'+ obj.todo_id +'" data-completed="'+ data_completed +'" href="api/update_todo">'+ data_completed_text +'</a>';

        output += '<a data-id="'+ obj.todo_id +'" class="todo_delete" href="api/delete_todo">Delete</a>';
        output += '</div>';
        return output;
    };
    
    // ------------------------------------------------------------------------
    
    this.note = function(obj) {
        var output = '';
        output += '<div id="note_'+ obj.note_id +'">';
        output += '<span><a class="note_toggle" data-id="'+ obj.note_id +'" id="note_title_'+ obj.note_id +'" href="#">' + obj.title + '</a></span> ';
        output += '<a class="note_update_display" data-id="'+ obj.note_id +'" href="#">Edit</a>';
        output += '<a data-id="'+ obj.note_id +'" class="note_delete" href="api/delete_note">Delete</a>';
        output += '<div class="note_edit_container" id="note_edit_container_'+ obj.note_id +'"></div>';
        output += '<div class="hide" id="note_content_'+ obj.note_id +'">'+ obj.content +'</div>';
        output += '</div>';
        return output;
    };
    
    // ------------------------------------------------------------------------
    
    this.note_edit = function(note_id) {
        var output = '';
        
        output += '<form method="post" class="note_edit_form" action="api/update_note">';
            output += '<input class="title" type="text" name="title" />';
            output += '<input class="note_id" type="hidden" name="note_id" value="'+ note_id +'" />';
            output += '<textarea class="content" name="content"></textarea>';
            output += '<input type="submit" value="Save"/>';
            output += '<input type="submit" class="note_edit_cancel" value="Cancel"/>';
        output += '</form>';

        return output;
    };
    
    // ------------------------------------------------------------------------

    this.__construct();
    
};
