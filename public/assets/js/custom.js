// $(function () {
//     $("form[name='department']").on('submit', function (e) {
//         e.preventDefault();
//
//         let formData = {
//             name: $("#department_name").val(),
//             building: $("#department_building").val(),
//             token: $("#department__token").val()
//         };
//
//         //let token = $("#department__token").val();
//         // let action = $(this).closest('form').serialize();
//
//         // console.log(action);
//         let url = $(location).attr('href');
//         let formURL = $(this).attr('action');
//
//         $.post(formURL, formData)
//             .then(function (res) {
//                 console.log(res)
//             });
//     })
//
//
// })

// Non sticky version

// Sticky version
// $.toast({
//     text: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, consequuntur doloremque eveniet eius eaque dicta repudiandae illo ullam. Minima itaque sint magnam dolorum asperiores repudiandae dignissimos expedita, voluptatum vitae velit.",
//     hideAfter: false
// })

// $.toast('test toast');