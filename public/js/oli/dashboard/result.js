var Result = function() {
  
    // ------------------------------------------------------------------------
  
    this.__construct = function() {
        console.log('Result Created');
    };
    
    // ------------------------------------------------------------------------
    
    this.success = function(msg) {
        var dom_success = $('#success');

        if(typeof msg === 'undefined') {
            console.log('UNDEFINED');
            dom_success.html('Success').fadeIn();
        }

        dom_success.html(msg).fadeIn();
        console.log('Success : '+msg);

        setTimeout(function () {
            dom_success.fadeOut();
        }, 5000);
    };
    
    // ------------------------------------------------------------------------
    
    this.error = function(msg) {
        var dom_error = $('#error'); 

        if(typeof msg === 'undefined') {
            console.log('UNDEFINED');
            dom_error.html('Error').fadeIn();
        } 

        if(typeof msg === 'object') {
            var output = '<ul>';
            for(var key in msg) {
                output += '<li>' + msg[key] + '</li>';
                console.log(key);
                console.log(msg[key]);
            }
            output +='</ul>';

            dom_error.html(output).fadeIn();
        } else {
            dom_error.html(msg).fadeIn();
        }
        console.log('Error: '+msg);

        dom_error.html(msg).fadeIn();
        console.log('Success : '+msg);

        setTimeout(function () {
            dom_error.fadeOut();
        }, 5000);
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
