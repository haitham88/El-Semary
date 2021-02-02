$(document).ready(function () {
    $('.AddNew').click(function () {
        var row = $(this).closest('tr').clone();
        row.find('input').val('');
        $(this).closest('tr').after(row);
        $('input[type="button"]', row).removeClass('AddNew')
            .addClass('RemoveRow').val('Remove item');
    });

    $('table').on('click', '.RemoveRow', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('click', 'td', function () {
        var col = $(this).index(),
            row = $(this).parent().index();
        if (col == 1) {
            var sub_categories = document.getElementsByName('sub_category[]');
            var specs = document.getElementsByName('specs[]');
            var price = document.getElementsByName('price[]');
            // specs[row - 1].value = sub_categories[row - 1].value
            var id = sub_categories[row - 1].value;
            if(id == 0){
                specs[row - 1].value = ""
                price[row - 1].value = ""
            }
            else {
                $.ajax({
                    url: 'getSC',
                    type: "GET",
                    success: function(data){
                        console.log(data);
                        var i ;
                        for (i =0; i < data.length; i++){
                            if (data[i].id == id){
                                specs[row - 1].value = data[i].specs
                                price[row - 1].value = data[i].price
                            }
                        }
                    },
                    error: function(data){
                        console.log(data)
                    },
                });
            }

        }

        console.log("row index:" + row + ", col index :" + col);
    });
    function getSubCategory(item) {
        console.log(item)
    }
});
// $(document).ready(function () {
//     filldd();
//     // CreateDP();
//     var rowstring = "<tr class='row'><td class='number'></td><td><input name='fn[]' type='text'/></td><td><select  name='name[]'  class='myDropDownLisTId'/></select></td><td><input type='submit'></input></td></tr>";
//     $("#addField").click(function (event) {
//         $("#field tbody").append(rowstring);
//         filldd();
//         // CreateDP();
//
//         if ($("td").hasClass("number")) {
//             var i = parseInt($(".num:last").text()) + 1;
//             $('.row').last().attr("id", "row"+i);
//             $($("<span class='num'> " + i + " </span>")).appendTo($(".number")).closest("td").removeClass('number');
//         }
//         event.preventDefault();
//     });
//
//     $("#deleteField").click(function (event) {
//         var lengthRow = $("#field tbody tr").length;
//         if (lengthRow > 1)
//             $("#field tbody tr:last").remove();
//         event.preventDefault();
//     });
// $('td').click(function() {
//     var col = $(this).index(),
//         row = $(this).parent().index();
//
//     console.log("row index:" + row + ", col index :" + col);
// });
//
// $(document).on('click', 'td', function () {
//     var col = $(this).index(),
//         row = $(this).parent().index();
//     var input = document.getElementsByName('name[]');
//     var fname = document.getElementsByName('fn[]');
//     var a = input[row];
//     fname[row].value = input[row].value
//     console.log(input[0].value)
//     console.log(input[1].value)
//     console.log("row index:" + row + ", col index :" + col);
// });

// $(".myDropDownLisTId").change(function() {
//     console.log("adsfsadfdasfsdsdafads")

// var input = document.getElementsByName('name[]');
// console.log($(this).closest('td').val());
//
// for (var i = 0; i < input.length; i++) {
//     var a = input[i];
//     console.log(a.value)
//
//     a.value = "haitham" + i;
//     console.log(a.value)
//
// }
// console.log($(this).val())
// document.getElementById("name").value[0] = "haitham";
//
// console.log($('#name').val())
// console.log($('#name').val())

// });


//
// });
//
// function filldd(){
//     var data = [
//         { id: '0', name: 'test 0' },
//         { id: '1', name: 'test 1' },
//         { id: '2', name: 'test 2' },
//         { id: '3', name: 'test 3' },
//         { id: '4', name: 'test 4' },
//     ];
//
//     for (i = 0; i < data.length; i++) {
//         $(".myDropDownLisTId").last().append(
//             $('<option />', {
//                 'value': data[i].id,
//                 'name': 'name1',
//                 'text': data[i].name
//             })
//         );
//     }
// }
//
// // function CreateDP(){
// //     $(".datepicker").last().datepicker();
// // }
//
// $(document).on('click','input[type="submit"]',function(){
//
//     alert($(this).closest('tr')[0].sectionRowIndex);
//     alert($(this).closest('tr').find('.myDropDownLisTId').val());
//
// })