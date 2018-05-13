// Group checkbox
$('input[type="checkbox"][group]').on('change', function() {
    var that = this;
    var groupKey = $(this).attr('group');
    var groupEles = $("input[type='checkbox'][group='" + groupKey +"']");
    groupEles.not(that).each(function() {
        if($(this).attr('id') === $('#setai_num_many').attr('id'))
        {
            $(this).prop('checked', false);
            //EnableOrDisableSetaiNumMany($(this));
        }
        else {
            $(this).prop('checked', false);
        }
    });
});

$("*[bind-type='parent']").each(function() { 
    var parentValue = $(this).val();
    var children = $("*[bind-type='children'][bind-key='" + $(this).attr('bind-key') + "']:last");
    children.each(function() {
       $(this).val(parentValue);
    })
});