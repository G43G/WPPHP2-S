$(document).ready(function(){
    $('a[id^="cat"]').click(function(e){
        e.preventDefault();
        var c = $(this).attr('id').slice(3);
        $.ajax({
            type: "GET",
            url: "http://localhost/Sajt/public/gallery/"+c,
            success: function(data){
                $('.content').html(data);
            }
        });
    });
    
    $(".wrapper-paging").show();
    TABLE.paginate('.table', 5);
});

var TABLE = {};

TABLE.paginate = function(table, pageLength){
    var $table = $(table);
    var $rows = $table.find('tbody > tr');
    var numPages = Math.ceil($rows.length / pageLength) - 1;
    var current = 0;
  
    var $nav = $table.parents('.table-wrapper').find('.wrapper-paging ul');
    var $back = $nav.find('li:first-child a');
    var $next = $nav.find('li:last-child a');
  
    $nav.find('a.paging-this strong').text(current + 1);
    $nav.find('a.paging-this span').text(numPages + 1);
    $back.addClass('paging-disabled').click(function(){
        pagination('<');
    });
    
    $next.click(function(){
        pagination('>');
    });
  
    $rows.hide().slice(0,pageLength).show();
    
    pagination = function(direction){
        reveal = function(current){
            $back.removeClass('paging-disabled');
            $next.removeClass('paging-disabled');
            $rows.hide().slice(current * pageLength, current * pageLength + pageLength).show();
            $nav.find('a.paging-this strong').text(current + 1);
        };

  	if(direction === '<'){
            if(current > 1){
                reveal(current -= 1);
            }
            else if(current === 1){
                reveal (current -= 1);
                $back.addClass('paging-disabled');
            }
        } 
        else{
            if(current < numPages - 1){
            reveal(current += 1);
            }
            else if(current === numPages - 1){
                reveal(current += 1);
                $next.addClass('paging-disabled');
            }
        }
    };
};

$(document).ready(function(){
    var exist;
    
    element = document.getElementById('exist');
    console.log(element);
    
    if(element != null)
    {
        exist = element.value;
    }
    else
    {
        exist = null;
    }
    
    $.ajax({
        type: 'GET',
        url: baseUrl + 'home/showPoll',
        success: function(data, xhr)
        {
            console.log(data);
            console.log(xhr);
            
            if(exist == 0)
            {
                showPoll(data);
            }
            else
            {
                $('#poll').html(showAnswers());
                $('#feedback').html('You have already voted!');
            }
        }, 
        error: function(xhr, status, error)
        {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
});

function showAnswers() 
{
    $.ajax({
        type: 'GET',
        url: baseUrl + 'home/showPoll',
        success : function(data)
        {
            var html = `<h2>`+data[0].poll_question+`</h2>`;
            $.each(data, function(key, value){
                html+=`<div>
                           <h3>`+value.answer+`: `+value.answer_votes+`</h3>
                       </div>`;
            });
            $('#poll').html(html);
        },
        error: function(errors)
        {
            console.log(errors);
        }
    });
}

function showPoll(data){
    var html = "";
    html+=`<form action='' method=''>`;
    html+=`<h3>`+data[0].poll_question+`</h3><input type='hidden' value='`+data[0].poll_id+`' id='idPoll'></input>`;
    $.each(data, function(key, value){
        html+=`<div>
                   <input type="radio" name="answers" value="`+value.answer_id+`">
                   <label>`+value.answer+`</label>
               </div>`;
    });
    html+=`<div>
               <input type="button" class="button" value="VOTE" onclick="vote();"/>
           </div>`;
    html+=`</form>`;
    $('#poll').html(html);
}

function vote()
{
    var idUser = document.getElementById('idUser').value;
    var idPoll = document.getElementById('idPoll').value;
    var idAnswer = $('input[name=answers]:checked').val();
    if(document.getElementsByName('answers')[0].checked || document.getElementsByName('answers')[1].checked)
    {
        $.ajax({
            type: 'POST',
            url: baseUrl + 'home/insertVote',
            data: 
            {
                _token: token,
                user_id: idUser,
                poll_id: idPoll,
                answer_id: idAnswer
            },
            success: function(data, xhr)
            {
                console.log(data);
                
                $('#feedback').html('You voted successfully!');
                $('#poll').html(showAnswers());
            },
            error: function(xhr, status, error)
            {
                console.log(error);
                $('#poll').html(showAnswers());
            }
        });
        
        console.log(baseUrl + 'home/insertVote');
        console.log(token);
        console.log(idPoll + ' ' + idUser + ' ' + idAnswer);
    }
    else
    {
        $('#feedback').html('<b>You must choose something!</b>');
    }
}

