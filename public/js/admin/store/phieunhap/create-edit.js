$(document).ready(function(){

    update_amounts();
    $('.qty').change(function() {
        update_amounts();
    });
});


function update_amounts()
{
    var sum = 0.0;
    $('#myTable > tbody  > tr').each(function() {
        var qty = $(this).find('option:selected').val();
        var price = $(this).find('.price').val();
        var amount = (qty*price)
        sum+=amount;
        $(this).find('.amount').text(''+amount);
    });
    //just update the total to sum  
    $('.total').text(sum);
}