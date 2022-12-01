 $(document).ready(function(event) {
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
 });