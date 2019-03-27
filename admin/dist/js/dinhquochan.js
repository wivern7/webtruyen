$(document).ready(function() {
    var url = window.location;
    var element = $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().parent().parent().addClass('active').addClass('menu-open');

    $('form#dqhStoryForm').bind("keypress", function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        return false;
      }
    });

    $('#dataTableList').DataTable({
            responsive: true
    });
    $('#flash').delay(3000).slideUp();
    // Chosen
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({ allow_single_deselect: true });

    $("#addNewCategoryF").hide();
    $("#addNewAuthorF").hide();
    $('#addNewCategory').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        $("#addNewCategoryF").slideToggle();
        return false;
    });
    $('#createCategory').on('click', function(event) {
        event.preventDefault();
        nameCategory = $("#nameCategory").val();
        token        = $('input[name="_token"]').val();

        $.ajax({
            url: '/dashboard/api/category',
            type: 'POST',
            dataType: 'json',
            data: {'_token': token, 'nameCategory': nameCategory},
        })
        .done(function(data) {
            console.log(data);
            $("#nameCategory").val("");
            $("#selectCategory").append('<option value="' + data.idCategory + '" selected>' + nameCategory + '</option>');
            $(".chosen-select").trigger("chosen:updated");
            $("#result").append('<strong id="flash">' + nameCategory + ' đã được tạo !</strong>');
            $('#flash').delay(3000).slideUp();
        })
        .fail(function( jqXHR) {
            $("#nameCategory").val("");
            alert("Có lỗi xảy ra, vui lòng kiểm tra lại tên chuyên mục !");
        })
        .always(function() {
            console.log("complete !");
        });

        return false;
    });

    $('#addNewAuthor').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        $("#addNewAuthorF").slideToggle();
        return false;
    });
    $('#createAuthor').on('click', function(event) {
        event.preventDefault();
        nameAuthor = $("#nameAuthor").val();
        token        = $('input[name="_token"]').val();

        $.ajax({
            url: '/dashboard/api/author',
            type: 'POST',
            dataType: 'json',
            data: {'_token': token, 'nameAuthor': nameAuthor},
        })
        .done(function(data) {
            console.log(data);
            $("#nameAuthor").val("");
            $("#selectAuthor").append('<option value="' + data.idAuthor + '" selected>' + nameAuthor + '</option>');
            $(".chosen-select").trigger("chosen:updated");
            $("#result").append('<strong id="flash">' + nameAuthor + ' đã được tạo !</strong>');
            $('#flash').delay(3000).slideUp();
        })
        .fail(function() {
            $("#nameAuthor").val("");
            alert("Có lỗi xảy ra, vui lòng kiểm tra lại tên tác giả !");
        })
        .always(function() {
            console.log("complete !");
        });

        return false;
    });

});

function areYouSureDeleteIt(msg){
    if(window.confirm(msg)){
        return true;
    }
    else {
        return false;
    }
}

// TinyMCE
tinymce.init({
    selector: '.editor',
    menubar: false,
    plugins: ['link image emoticons textcolor media'],
    toolbar1: 'styleselect | bold italic | alignleft aligncenter | bullist numlist | outdent indent | link image forecolor backcolor'
});
