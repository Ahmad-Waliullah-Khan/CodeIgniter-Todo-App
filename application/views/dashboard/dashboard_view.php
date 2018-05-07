<div class="row">
    
    <div id="dashboard-side" class="col-md-4">
        <form id="create_todo" class="form-horizontal" method="post" action="<?=site_url('api/create_todo')?>">
            <div class="input-append">
                <input id="todo_input" type="text" name="content" placeholder="Create New Todo Item" />
                <input type="submit" class="btn btn-success" value="Create" />
            </div>
        </form>
        
        <div id="list_todo">
            <div class="ajax-loader"></div>
        </div>
    </div>
    
    <div id="dashboard-main" class="offset-md-1 col-md-7">
        <form id="create_note" class="form-horizontal" method="post" action="<?=site_url('api/create_note')?>">
            <div class="input-append">
                <input id="note_title_input" tabindex="1" type="text" name="title" placeholder="Note Title" />
                <input tabindex="3" type="submit" class="btn btn-success" value="Create" />
            </div>
            
            <div class="clearfix"></div>
            
            <textarea id="note_body_input" tabindex="2" name="content"></textarea>
            
        </form>
        
        <div id="list_note">
            <span class="ajax-loader"></span>
        </div>
    </div>
    
    
</div>
