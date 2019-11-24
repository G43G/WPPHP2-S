(function($) {

    'use strict';

    $(document).ready(function() {
        close();
        show();
        active();
        slide();
    });

    function close() {
        var closeIcon = $('.close');

        closeIcon.click(function() {
            $(this).parents('.error').fadeOut();
        });

        closeIcon.click(function() {
            $(this).parents('.success').fadeOut();
        });
    }

    function show() {
        var show = $('.show');

        show.click(function() {
            $(this).children().fadeToggle();
        });
    }

    function active() {
        var button = $('.button');

        button.click(function() {
            $(this).addClass('active');
            $(this).parent().siblings().children().removeClass('active');
        });
    }

    function slide() {
        $('.arrow-down').click(function() {
            $(this).parent().animate({top: '0px'}).delay(1000);
            $(this).parent().animate({top: '-67px'});
        });
    }

})(jQuery);

function checkMail()
{
    var mail = document.getElementById('emailRegister').value;
    var regMail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if(!regMail.test(mail))
    {
        document.getElementById('emailRegister').style.border = '2px solid red';
        document.getElementById('emailRegister').style.color = 'red';
    }
    else
    {
        document.getElementById('emailRegister').style.border = '2px solid green';
        document.getElementById('emailRegister').style.color = 'black';
    }
}

function checkUsername()
{
	var username = document.getElementById('usernameRegister').value;
	var regUsername = /^[a-zA-Z0-9]{3,15}$/;
	
	if(!regUsername.test(username))
	{
            document.getElementById('usernameRegister').style.border = '2px solid red';
            document.getElementById('usernameRegister').style.color = 'red';
	}
	else
	{
            document.getElementById('usernameRegister').style.border = '2px solid green';
            document.getElementById('usernameRegister').style.color = 'black';
	}
}

function checkPassword()
{
    var password = document.getElementById('passwordRegister').value;
    var regPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;

    if(!regPassword.test(password))
    {
        document.getElementById('passwordRegister').style.border = '2px solid red';
        document.getElementById('passwordRegister').style.color = 'red';
    }
    else
    {
        document.getElementById('passwordRegister').style.border = '2px solid green';
        document.getElementById('passwordRegister').style.color = 'black';
    }
}

function checkPasswordConfirm()
{
    var password = document.getElementById('passwordRegister').value;
    var password2 = document.getElementById('passwordRegister_confirmation').value;

    if(!password.match(password2))
    {
        document.getElementById('passwordRegister_confirmation').style.border = '2px solid red';
        document.getElementById('passwordRegister_confirmation').style.color = 'red';
    }
    else
    {
        document.getElementById('passwordRegister_confirmation').style.border = '2px solid green';
        document.getElementById('passwordRegister_confirmation').style.color = 'black';
    }
}