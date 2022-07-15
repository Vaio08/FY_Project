function deleteCategory(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    }
    })
    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You can not get back this data!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes!',
        cancelButtonText: 'No!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
        event.preventDefault();
        document.getElementById('delete-form-' + id).submit();
    } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
        ) {
        swalWithBootstrapButtons.fire(
        'Canceled',
        'Data is safe 🙂',
        'error'
        )
    }
    })
}
