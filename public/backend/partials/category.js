$(document).ready(function(event) {

    var table = $('#categories').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 10,
        order: [0, 'asc'],
        "ajax": {
            "url": baseUrl + "/getAllCategories",
            "type": "POST",
            "data": {
                "_token": $("meta[name='csrf_token']").attr('content')
            },
        },
        columns: [
            { data: 'id', 'name': 'id' },
            { data: 'name', 'name': 'name' },
            { data: 'created_at', 'name': 'created_at' },
            { data: 'updated_at', 'name': 'updated_at' },
            { data: 'action', 'name': 'action', orderable: false, searchable: false },
            { data: 'action1', 'name': 'action1', orderable: false, searchable: false },
        ],
        "columnDefs": [{

                "render": function(data, type, row, meta) {
                    return `<a href="#" class="btn btn-primary btn-sm editCategory" id="${row.id}"><i class="fas fa-pencil-alt"></i></a>`
                },
                "targets": 4
            },
            {

                "render": function(data, type, row, meta) {
                    return `<a href="#" class="btn btn-danger btn-sm deleteCategory" id="${row.id}">Delete</a>`
                },
                "targets": 5
            },

        ]
    });
    //create category
    $('#addCategory').submit(function(event) {
        event.preventDefault();
        var form = $('#addCategory')[0];
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: baseUrl + '/addCategory',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#addCategoryModal').modal('hide');
                onSuccessRemoveErrors();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Category Created Successfully !',
                })
                table.ajax.reload();

            },
            error: function(reject) {
                if (reject.status === 422) {
                    removeErrors();
                    var errors = $.parseJSON(reject.responseText);
                    $.each(errors.errors, function(key, value) {
                        $('#' + key).addClass('is_invalid');
                        $('#' + key + "_help").text(value[0]);
                    })
                }
            }
        });
    });

    //Get category for update

    $(document).on('click', '.editCategory', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: baseUrl + '/getCategory/' + id,
            type: 'Get',
            processData: false,
            contentType: false,
            success: function(data) {
                $('#category_id').val(data.id);
                $('#edit_category').val(data.id);
                $('#edit_category').val(data.name);
                $('#editCategoryModal').modal('show');

            },
            error: function(data, textStatus, xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Not Found',
                    text: 'Sorry we are unable to find this record !',
                })
            }
        })
    });

    $('#editCategory').submit(function(e) {
        e.preventDefault();
        var form = $('#editCategory')[0];
        var formData = new FormData(form);
        $.ajax({
            url: baseUrl + '/updateCategory',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#editCategoryModal').modal('hide');
                onSuccessRemoveEditErrors();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Category Updated Successfully !',
                });
                table.ajax.reload();
            },
            error: function(reject) {
                if (reject.status === 422) {
                    removeErrors();
                    var errors = $.parseJSON(reject.responseText);
                    $.each(errors.errors, function(key, value) {
                        $('#' + key).addClass('is_invalid');
                        $('#' + key + "_help").text(value[0]);
                    })
                }
            }
        })
    });
    ///////Delete  CAtegory////////
    $(document).on('click', '.deleteCategory', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: baseUrl + '/deleteCategory/' + id,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Category Deleted Successfully !',
                        });
                        table.ajax.reload();

                    },
                    error: function(data, textStatus, xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Not Found',
                            text: 'Sorry we are unable to find this record !',
                        })
                    }
                });
            }
        })
    })

    function onSuccessRemoveEditErrors() {
        $('#edit_category').removeClass('is-invalid');
        $('#edit_category').val('');
        $('#edit_category_help').text('');
    }


    $('#editCategoryModal').on('hidden.bs.modal', function() {
        onSuccessRemoveEditErrors();
    })


    function onSuccessRemoveErrors() {
        $('#category_name').removeClass('is-invalid');
        $('#category_name').val('');
        $('#category_name_help').text('');
    }

    function removeErrors() {
        $('#category_name').removeClass('is-invalid');
        $('#category_name_help').text('');
    }

    $('#addCategoryModal').on('hidden.bs.modal', function() {
        onSuccessRemoveErrors();
    })
});