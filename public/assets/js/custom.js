$(function () {
    $("form[name='user']").on('submit', function (event) {
        event.preventDefault();

        let url = $(this).attr('action');
        let cardId = $("#user_cardId");
        let username = $("#user_username");
        let firstName = $("#user_firstName");
        let lastName = $("#user_lastName");
        let employeeId = $("#user_employeeId");
        let gender = $("#user_gender");
        let email = $("#user_email");
        let phone = $("#user_phoneNumber");
        let dof = $("#user_dateOfBirth");
        let token = $("#user_csrfToken");
        let data = {};

        data[$(cardId).attr('name')] = cardId.val();
        data[$(username).attr('name')] = username.val();
        data[$(firstName).attr('name')] = firstName.val();
        data[$(lastName).attr('name')] = lastName.val();
        data[$(employeeId).attr('name')] = employeeId.val();
        data[$(gender).attr('name')] = gender.val();
        data[$(email).attr('name')] = email.val();
        data[$(phone).attr('name')] = phone.val();
        data[$(dof).attr('name')] = dof.val();
        data[$(token).attr('name')] = token.val();

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function (response) {
                $.toast({
                    heading: 'Success',
                    text: response.success,
                    icon: 'success',
                    position: 'top-right',
                    hideAfter: 4000,
                    bgColor: '#62A786',
                    textColor: 'white',
                })

                $("#modalEdit").modal('hide');
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        })
    })

    $("#modalAddDepartment").on('submit', function (event) {
        event.preventDefault();

        const departmentName = $("#department_name");
        const departmentBuilding = $("#department_building");
        const headDepartment = $("#department_headDepartment");
        const token = $("#department_csrToken");

        let formData = {};
        formData[$(departmentName).attr('name')] = departmentName.val();
        formData[$(departmentBuilding).attr('name')] = departmentBuilding.val();
        formData[$(headDepartment).attr('name')] = headDepartment.val();
        formData[$(token).attr('name')] = token.val();


        $.ajax({
            url: '/department/new',
            method: 'POST',
            data: formData,
            success: function (response) {
                showToast('New Department', response.success, 'success', '#62A786');
                $("#modalAddDepartment").modal('hide');
                departmentName.val('');
                departmentBuilding.val('')
                headDepartment.val('')
            },
            error: function (xhr, status, error) {
                console.log(xhr, status, error);
            }
        })
    })

    $(".delete-record").on('click', function (e) {
        e.preventDefault();

        const form = e.target.form;

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                cancelButton: 'btn btn-label-danger me-3',
                confirmButton: 'btn btn-label-primary',
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this record if you deleted it!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Record has been deleted.',
                    'success'
                ).then(() => {
                    form.submit();
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your record is safe 😃',
                    'error'
                )
            }
        })
    })
})

function showToast(heading, message, icon, color) {
    $.toast({
        heading: heading,
        text: message,
        icon: icon,
        position: 'top-right',
        hideAfter: 4000,
        bgColor: color,
        textColor: 'white',
    })
}