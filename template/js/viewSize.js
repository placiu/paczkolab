$(document).ready(function() {
    var url = '../../router.php/size/';
    var viewSize = $('#view-size');

    function loadSizeView() {

        $.get(url)
            .done(function (response) {
                insertContentSize(response);
            })
            .fail(function () {
                alert( "Wystąpił błąd");
            });
    }

    loadSizeView();

    function insertContentSize(size) {
        $.each(size, function(){
            var tr = $('<tr>'),
                tdId = $('<td>', {class: "id"}),
                tdSize = $('<td>', {class: "size"}),
                tdPrice = $('<td>', {class: "price"}),
                tdAction = $('<td>', {class: "action"}),
                actionDelete = $('<button>', {class: "delete-btn"}).text('Usuń'),
                actionEdit = $('<button>', {class: "edit-btn"}).text('Edytuj'),
                actionForm = $('<form>', {class: "edit-form hide"}),
                inputSize = $('<input>', {name: "size", id: "size"}),
                inputPrice = $('<input>', {name: "price", id: "price"}),
                inputSubmit = $('<input>', {type: "submit"});

            tr.append(tdId, tdSize, tdPrice, tdAction);
            tdAction.append(actionDelete, actionEdit, actionForm);
            actionForm.append(inputSize, inputPrice, inputSubmit);

            viewSize.append(tr);
            tdId.text(this.id);
            tdSize.text(this.size);
            tdPrice.text(this.price);
        });

        // Action - edit
        viewSize.on('click', '.edit-btn', function(){
        
            var editForm = $(this).next('form');
            var edit = $(this).next('form').find('input[type=submit]');

            editForm.toggleClass('hide');

            var parent = $(this).parent().parent();
            var id = parent.find('td[class=id]').text();
            var sizeValue = parent.find('td[class=size]').text();
            var priceValue = parent.find('td[class=price]').text();
            
            editForm.children('input[name=size]').val(sizeValue);
            editForm.children('input[name=price]').val(priceValue);
            
            edit.on('click', function(e){
                e.preventDefault();

                var size = $(this).siblings('#size').val();
                var price = $(this).siblings('#price').val();

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: {
                        id: id,
                        size: size,
                        price: price
                    },
                    dataType: 'json'
                }).done(function () {
                    alert('Rozmiar został zaktualizowany');
                    location.reload();
                }).fail(function () {
                    alert( "Wystąpił błąd");
                });
            });
        });

        // Action delete
        viewSize.on('click', '.delete-btn', function(e){
            e.preventDefault();
        
            var id = $(this).parent().parent().find('td[class=id]').text();
            $.ajax({
                type: "DELETE",
                url: url,
                data: {
                    id: id
                },
                dataType: 'json'
            }).done(function (response) {
                alert('Rozmiar zostanie usunięty');
                location.reload();
            }).fail(function (response) {
                alert( "Wystąpił błąd");
            });
           
        });
    }
});