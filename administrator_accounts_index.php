<?php include('administrator_connection.php'); ?>

<!doctype html>

<html lang="en">



<head>

  <!-- Required meta tags -->

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->

  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

  <title>Manage Accounts</title>
	<br>

  <style type="text/css">

    .btnAdd {

      text-align: right;

      width: 83%;

      margin-bottom: 20px;

    }

  </style>

</head>



<body>

  <div class="container-fluid">

    <h2 class="text-center">Manage Accounts</h2>
    <div class="row">

      <div class="container">

        <div class="btnAdd">

          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Add Account</a>

        </div>

        <div class="row">

          <div class="col-md-2"></div>

          <div class="col-md-8">

            <table id="example" class="table">

              <thead>

                <th>Id</th>

                <th>First Name</th>

                <th>Last Name</th>

                <th>Username</th>

                <th>Email</th>

                <th>Account Type</th>

                <th>Options</th>

              </thead>

              <tbody>

              </tbody>

            </table>

          </div>

          <div class="col-md-2"></div>

        </div>

      </div>

    </div>

  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->

  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <!--

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  -->

  <script type="text/javascript">

    $(document).ready(function() {

      $('#example').DataTable({

        "fnCreatedRow": function(nRow, aData, iDataIndex) {

          $(nRow).attr('id', aData[0]);

        },

        'serverSide': 'true',

        'processing': 'true',

        'paging': 'true',

        'order': [],

        'ajax': {

          'url': 'administrator_fetch_accounts.php',

          'type': 'post',

        },

        "aoColumnDefs": [{

            "bSortable": false,

            "aTargets": [6]

          },



        ]

      });

    });

    $(document).on('submit', '#addUser', function(e) {

      e.preventDefault();

      var first_name = $('#addFirstNameField').val();

      var last_name = $('#addLastNameField').val();

      var username = $('#addUserField').val();

      var email = $('#addEmailField').val();

      var account_type = $('#addAccountTypeField').val();

      if (first_name != '' && last_name != '' && username != '' && email != '' && account_type != '' ) {

        $.ajax({

          url: "administrator_add_account.php",

          type: "post",

          data: {

            first_name: first_name,

            last_name: last_name,

            username: username,

            email: email, 

            account_type: account_type

          },

          success: function(data) {

            var json = JSON.parse(data);

            var status = json.status;

            if (status == 'true') {

              mytable = $('#example').DataTable();
              mytable.draw();

              $('#addUserModal').modal('hide');

            } else {

              alert('failed');

            }

          }

        });

      } else {

        alert('Fill all the required fields');

      }

    });

    $(document).on('submit', '#updateUser', function(e) {

      e.preventDefault();

      //var tr = $(this).closest('tr');

      var first_name = $('#firstNameField').val();

      var last_name = $('#lastNameField').val();

      var username = $('#nameField').val();

      var email = $('#emailField').val();

      var account_type = $('#accountTypeField').val();

      var trid = $('#trid').val();

      var id = $('#id').val();

      if (first_name != '' && last_name != '' && username != '' && email != '' && account_type != '' ) {

        $.ajax({

          url: "administrator_update_account.php",

          type: "post",

          data: {

            first_name: first_name,

            last_name: last_name,

            username: username,

            email: email,

            account_type: account_type,

            id: id

          },

          success: function(data) {

            var json = JSON.parse(data);

            var status = json.status;

            if (status == 'true') {

              table = $('#example').DataTable();

              // table.cell(parseInt(trid) - 1,0).data(id);

              // table.cell(parseInt(trid) - 1,1).data(username);

              // table.cell(parseInt(trid) - 1,2).data(email);

              // table.cell(parseInt(trid) - 1,3).data(mobile);

              // table.cell(parseInt(trid) - 1,4).data(city);

              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';

              var row = table.row("[id='" + trid + "']");

              row.row("[id='" + trid + "']").data([id, first_name, last_name, username, email, account_type, button]);

              $('#exampleModal').modal('hide');

            } else {

              alert('failed');

            }

          }

        });

      } else {

        alert('Fill all the required fields');

      }

    });

    $('#example').on('click', '.editbtn ', function(event) {

      var table = $('#example').DataTable();

      var trid = $(this).closest('tr').attr('id');

      // console.log(selectedRow);

      var id = $(this).data('id');

      $('#exampleModal').modal('show');



      $.ajax({

        url: "administrator_get_single_account.php",

        data: {

          id: id

        },

        type: 'post',

        success: function(data) {

          var json = JSON.parse(data);

          $('#firstNameField').val(json.first_name);

          $('#lastNameField').val(json.last_name);

          $('#nameField').val(json.username);

          $('#emailField').val(json.email);

          $('#accountTypeField').val(json.account_type);

          $('#id').val(id);

          $('#trid').val(trid);

        }

      })

    });



    $(document).on('click', '.deleteBtn', function(event) {

      var table = $('#example').DataTable();

      event.preventDefault();

      var id = $(this).data('id');

      if (confirm("Are you sure want to delete this User ? ")) {

        $.ajax({

          url: "administrator_delete_account.php",

          data: {

            id: id

          },

          type: "post",

          success: function(data) {

            var json = JSON.parse(data);

            status = json.status;

            if (status == 'success') {

              //table.fnDeleteRow( table.$('#' + id)[0] );

              //$("#example tbody").find(id).remove();

              //table.row($(this).closest("tr")) .remove();

              $("#" + id).closest('tr').remove();

            } else {

              alert('Failed');

              return;

            }

          }

        });

      } else {

        return null;

      }







    })

  </script>

  <!-- Modal -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Update Account</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <form id="updateUser">

            <input type="hidden" name="id" id="id" value="">

            <input type="hidden" name="trid" id="trid" value="">

            <div class="mb-3 row">

              <label for="firstNameField" class="col-md-3 form-label">First Name</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="firstNameField" name="first_name">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="lastNameField" class="col-md-3 form-label">Last Name</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="lastNameField" name="last_name">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="nameField" class="col-md-3 form-label">Name</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="nameField" name="name">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="emailField" class="col-md-3 form-label">Email</label>

              <div class="col-md-9">

                <input type="email" class="form-control" id="emailField" name="email">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="accountTypeField" class="col-md-3 form-label">Account Type</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="accountTypeField" name="account_type">

              </div>

            </div>

            <div class="text-center">

              <button type="submit" class="btn btn-primary">Submit</button>

            </div>

          </form>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>

      </div>

    </div>

  </div>

  <!-- Add user Modal -->

  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <form id="addUser" action="">

            <div class="mb-3 row">

              <label for="addFirstNameField" class="col-md-3 form-label">First Name</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="addFirstNameField" name="first_name">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="addLastNameField" class="col-md-3 form-label">Last Name</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="addLastNameField" name="last_name">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="addUserField" class="col-md-3 form-label">Name</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="addUserField" name="name">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="addEmailField" class="col-md-3 form-label">Email</label>

              <div class="col-md-9">

                <input type="email" class="form-control" id="addEmailField" name="email">

              </div>

            </div>

            <div class="mb-3 row">

              <label for="addAccountTypeField" class="col-md-3 form-label">Account Type</label>

              <div class="col-md-9">

                <input type="text" class="form-control" id="addAccountTypeField" name="account_type">

              </div>

            </div>

            <div class="text-center">

              <button type="submit" class="btn btn-primary">Submit</button>

            </div>

          </form>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>

      </div>

    </div>

  </div>

</body>



</html>

<script type="text/javascript">

  //var table = $('#example').DataTable();

</script>