$(document).ready(function () {
    $('.adduser').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "adduser.php",
            type: 'POST',
            data: $(this).serialize(),
            success: function (data) { //data correspond aux données que l'on traite
                $('table tbody').append(data);
            }
        });
    });
    $('.moduser').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "update_user.php",
            type: 'POST',
            data: $(this).serialize(),
            success: function (data) {
                console.log(data);
                $('table tbody').append(data);
                alert('coucou');
            }
        })
    })
});