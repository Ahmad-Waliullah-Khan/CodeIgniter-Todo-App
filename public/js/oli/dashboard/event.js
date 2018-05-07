var Event = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        // console.log('Event Created');
        Result = new Result();
        create_todo();
        create_note();
        update_note_display();
        update_todo();
        update_note();
        delete_todo();
        delete_note();
    };
    
    // ------------------------------------------------------------------------
    
    var create_todo = function() {
        $("#create_todo").submit(function(evt) {
            // evt = evt || window.event;
            evt.preventDefault();
            // event.stopImmediatePropagation();
            // console.log('create_todo clicked');

            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(obj){
                if(obj.result == 1)
                {
                    Result.success('Todo Created Successfully');
                    var output = Template.todo(obj.data[0]);
                    $('#list_todo').prepend(output);
                    $('#todo_input').val("");

                } else {    
                    Result.error(obj.error);
                }
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var create_note = function() {
        $("#create_note").submit(function(evt) {
            // evt = evt || window.event;
            evt.preventDefault();
            // event.stopImmediatePropagation();
            // console.log('create_todo clicked');

            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(obj){
                if(obj.result == 1)
                {
                    Result.success('Note Created Successfully');
                    var output = Template.note(obj.data[0]);
                    $('#list_note').prepend(output);

                    //Refresh the input fields after creating a note
                    $('#note_title_input').val("");
                    $('#note_body_input').val("");

                } else {    
                    Result.error(obj.error);
                }
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var update_todo = function() {

        $("body").on('click', '.todo_update', function(evt){
            evt.preventDefault();

            var self= $(this);

            var url = $(this).attr('href');
            var postData = {
                'todo_id' : $(this).attr('data-id'),
                'completed' : $(this).attr('data-completed')  
            };

            
            $.post(url, postData, function(o) {
                if(o.result ==1) {
                    // Result.success('Saved');
                    if(postData.completed ==1 ) {
                        self.parent('div').addClass('todo_complete');  
                        self.html('Uncomplete');
                        self.attr('data-completed', 0);
                    } else {
                        self.parent('div').removeClass('todo_complete');  
                        self.html('Complete');
                        self.attr('data-completed', 1);
                    }
                    
                    
                } else {
                    Result.error('Nothing Updated');
                }
            }, 'json');

        });
        
    };

    // ------------------------------------------------------------------------

    var update_note_display = function() {
        // console.log('!!!!!!!!');
        $("body").on('click', '.note_update_display', function(e){
            // alert(2);
            e.preventDefault();
            var note_id = $(this).data('id');
            var output = Template.note_edit(note_id);
            $('#note_edit_container_'+ note_id).html(output);
        });

        $("body").on('click', '.note_edit_cancel', function(e) {
            e.preventDefault();
            $(this).parents('.note_edit_container').html('');
        });
    };
    
    // ------------------------------------------------------------------------

    var update_note = function() {
        
    };
    
    // ------------------------------------------------------------------------
  
    var delete_todo = function() {

        $('body').on('click', '.todo_delete', function (evt) {
            evt.preventDefault();

            var self = $(this).parent('div');
            var url = $(this).attr('href');
            var postData = {
                'todo_id' : $(this).attr('data-id')
            };

            $.post(url, postData, function(o) {
                if(o.result == 1){
                    Result.success('Item Deleted');
                    self.remove();
                } else {
                    Result.error(o.msg);
                }
            }, 'json');


        });
        
    };

    // ------------------------------------------------------------------------

    var delete_note = function() {
        
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
