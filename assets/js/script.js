/**
 * Created by user on 24.12.16.
 */
$(document).ready(function(){

    $('input[type=checkbox].active').attr('checked', true);


    $('body').on('click', '.add', function() {
        var i = parseInt($(this).attr('data-id'));
        i = i + 1;
        $('.adding-fields').append('<div class="form-inline row-' + i + '"> \
            <div class="form-group field-block-params-' + i + '-key has-success"> \
            <label class="control-label" for="block-params-' + i + '-key"></label> \
            <input id="block-params-' + i + '-key" class="form-control" name="' + $(this).attr('data-class') + '[params][' + i + '][key]" placeholder="Ключ" type="text"> \
            <div class="help-block"></div> \
            </div><div class="form-group field-block-params-' + i + '-value"> \
            <label class="control-label" for="block-params-' + i + '-value"></label> \
            <input id="block-params-' + i + '-value" class="form-control" name="' + $(this).attr('data-class') + '[params][' + i + '][value]" placeholder="Значение" type="text"> \
            <div class="help-block"></div> \
            </div>                <div class="form-group"> \
            <button type="button" class="btn btn-primary add" data-class="' + $(this).attr('data-class') + '" data-id="' + i + '">+</button><div class="help-block"></div> \
            </div> \
            </div>');
        $(this).html('-');
        $(this).removeClass('add');
        $(this).addClass('delete');


    });
    $('body').on('click', '.delete', function() {
        $('.row-' + $(this).data('id')).remove();
        return false;
    });
})