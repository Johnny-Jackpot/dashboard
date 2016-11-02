$(document).ready(function () {
	
    //switch to editing form of page name
    $('#editName').click(function (event) {
        var pageName = $('#pageName').html();

        $('#heading').hide();
        $('#headingForm').show();
        $('#inputPageName').val(pageName);
    });

    //save new page name and switch back
    $('#pageNameForm').submit(function (event) {

        event.preventDefault();

        var newPageName = $('#inputPageName').val();

        if (newPageName.length > 100) {
            alert('page name may contain only 100 chars');
            return;
        }

        $.post('/dashboard/editPageName', {"pageName": newPageName})
                .done(function (data) {
                    $('#headingForm').hide();
                    $('#heading').show();
                    $('#pageName').html(newPageName);
                })
                .fail(function () {
                    alert('Sorry, server error occured.');
                });
    });

    //switch to editing page description
    $('#editDescription').click(function (event) {
        var pageDescription = $('#pageDescription').html();

        $('#description').hide();
        $('#descriptionForm').show();
        $('#inputPageDescription').html(pageDescription);

    });

    //save new page description and switch back
    $('#pageDescriptionForm').submit(function (event) {

        event.preventDefault();

        var newPageDescription = $('#inputPageDescription').val();

        if (newPageDescription.length > 2000) {
            alert('Page description may contain 2000 chars');
            return;
        }

        $.post('/dashboard/editPageDescription',
                {"pageDescription": newPageDescription})
                .done(function (data) {
                    $('#descriptionForm').hide();
                    $('#description').show();
                    $('#pageDescription').html(newPageDescription);
                })
                .fail(function () {
                    alert('Sorry, server error occured.');
                });
    });

    //handle feedback form
    $('#feedback').submit(function (event) {

        event.preventDefault();

        var userData = $(this).serializeArray();

        /**
        * http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
        */
        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        var userName = userData[0]['value'],
        	userEmail = userData[1]['value'],
        	userFeedback = userData[2]['value'];
        
        //empty user name
        if (!userName) {
        	alert('Name is required');
        	return;
        }
        //empty email
        if (!userEmail) {
        	alert('Email is required');
        	return;
        }
        //invalid email
        if (!validateEmail(userEmail)) {
        	alert('Invalid email\nPlease, check your email');
        	return;
        }
        //empty message
        if (!userFeedback) {
        	alert('Message is required');
        	return;
        }

        //send feedback
        $.post('/dashboard/sendEmail', userData)

            .done(function (data) {

                function clearFields(arrFields) {
                    arrFields.map(function (item) {
                        $(item).val('');
                    });
                }
                clearFields([
                    '#userName',
                    '#userEmail',
                    '#userFeedback'
                ]);
                
                //add success message
                $('#feedback').prepend('<div id="feedSuccess" ' +
                 'class="alert alert-success" ' + 
                 ' role="alert">Feedback was send successfull</div>');
                //remove success message
                setTimeout(function(){
                	$('#feedSuccess').remove();
                }, 7000);
                
            })

            .fail(function () {
            	$('#feedback').prepend('<div id="feedFail" ' + 
            		' class="alert alert-danger" ' + 
            		' role="alert">Server error occured. Try again later.</div>');
                setTimeout(function(){
                	$('#feedFail').remove();
                }, 7000);
            });

    });

    //get coordanates of draggable image and place image on page
    $.get('/dashboard/getCoord', function(data) {
    	 $('#dragabbleImage').offset(JSON.parse(data));
    });

    //make image draggable and save it coordinates
    $('#dragabbleImage').draggable({
    	stop: function() {
    		$.post('/dashboard/setCoord', 
    			{"draggablePosition" : JSON.stringify($(this).offset())})
    		.fail(function() {
    			alert('Can`t save draggable image position');
    		});
    	}
    });


});