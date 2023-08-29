$(document).ready(function(){
    //when + button click
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price*$qty;
        $parentNode.find('#total').html(`${$total} kyats`);

        //total summary
        summaryCalculation();
    })

    //when - button click
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price*$qty;
        $parentNode.find('#total').html(`${$total} kyats`);
        // if($qty == 0){
        //     $(".btn-minus").attr("disabled");
        // }

        //total summary
        summaryCalculation();
    })

    //calculate final price for order
    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace("kyats",""));
        });

        $('#subTotalPrice').html(`${$totalPrice} kyats`);
        $('#finalPrice').html(`${$totalPrice+3000} kyats`);
    }
})
