<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <title>Server Side CRUD Ajax Operations</title>
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
    <h2 class="text-center">CRUD</h2>
    <p class="datatable design text-center">Andres Buitrago</p>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Add User</a>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>Opciones</th>
                <th>Id</th>
                <th>Tipo documento</th>
                <th>Numero documento</th>
                <th>Primer nombre</th>
                <th>Segundo nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Genero</th>
                <th>Departamento</th>
                <th>Municipio</th>
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
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5]
          },

        ]
      });
    });
    $(document).on('submit', '#addUser', function(e) {
      e.preventDefault();
      var tipo_documento_id = $('#tipo_documento_field').val();
      var numero_documento = $('#numero_documento_field').val();
      var nombre1 = $('#primer_nombre_field').val();
      var nombre2 = $('#segundo_nombre_field').val();
      var apellido1 = $('#primer_apellido_field').val();
      var apellido2 = $('#segundo_apellido_field').val();
      var genero_id = $('#genero_field').val();
      var departamento_id = $('#departamento_field').val();
      var municipio_id = $('#municipio_field').val();
      if (tipo_documento_id != '' && numero_documento != '' && nombre1 != '' && nombre2 != '' && apellido1 != ''&& apellido2 != ''&& genero_id != ''&& departamento_id != ''&& municipio_id) {
        $.ajax({
          url: "add_user.php",
          type: "post",
          data: {
            tipo_documento_id: tipo_documento_id,
            numero_documento: numero_documento,
            nombre1: nombre1,
            nombre2: nombre2,
            apellido1: apellido1,
            apellido2: apellido2,
            genero_id: genero_id,
            departamento_id: departamento_id,
            municipio_id: municipio_id
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
    });$(document).on('submit', '#updateUser', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var tipo_documento_id = $('#tipo_documento_update').val();
      var numero_documento = $('#numero_documento_update').val();
      var nombre1 = $('#primer_nombre_update').val();
      var nombre2 = $('#segundo_nombre_update').val();
      var apellido1 = $('#primer_apellido_update').val();
      var apellido2 = $('#segundo_apellido_update').val();
      var genero_id = $('#genero_update').val();
      var departamento_id = $('#departamento_update').val();
      var municipio_id = $('#municipio_update').val();
      var trid = $('#trid').val();
      var id = $('#id').val();
      if (tipo_documento_id != '' && numero_documento != '' && nombre1 != '' && nombre2 != '' && apellido1 != ''&& apellido2 != ''&& genero_id != ''&& departamento_id != ''&& municipio_id != '')  {
        $.ajax({
          url: "update_user.php",
          type: "post",
          data: {
            tipo_documento_id: tipo_documento_id,
            numero_documento: numero_documento,
            nombre1: nombre1,
            nombre2: nombre2,
            apellido1: apellido1,
            apellido2: apellido2,
            genero_id: genero_id,
            departamento_id: departamento_id,
            municipio_id: municipio_id,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([button, id, tipo_documento_id, numero_documento, nombre1, nombre2,apellido1,apellido2,
              genero_id,departamento_id,municipio_id]);
              $('#exampleModal').modal('hide');
            } else {
              alert("failed");
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
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#tipo_documento_update').val(json.tipo_documento_id);
          $('#numero_documento_update').val(json.numero_documento);
          $('#primer_nombre_update').val(json.nombre1);
          $('#segundo_nombre_update').val(json.nombre2);
          $('#primer_apellido_update').val(json.apellido1);
          $('#segundo_apellido_update').val(json.apellido2);
          $('#genero_update').val(json.genero_id);
          $('#departamento_update').val(json.departamento_id);
          $('#municipio_update').val(json.municipio_id);
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
          url: "delete_user.php",
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
              <label for="tipo_documento_field" class="col-md-3 form-label">Tipo documento</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tipo_documento_field" name="tipo_documento_id">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_documento_field" class="col-md-3 form-label">Numero documento</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="numero_documento_field" name="numero_documento">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="primer_nombre_field" class="col-md-3 form-label">Primer nombre</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="primer_nombre_field" name="nombre1">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_nombre_field" class="col-md-3 form-label">Segundo nombre</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="segundo_nombre_field" name="nombre2">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="primer_apellido_field" class="col-md-3 form-label">Primer apellido</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="primer_apellido_field" name="apellido1">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_apellido_field" class="col-md-3 form-label">Segundo apellido</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="segundo_apellido_field" name="apellido2">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="genero_field" class="col-md-3 form-label">Genero</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="genero_field" name="genero_id">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="departamento_field" class="col-md-3 form-label">Departamento</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="departamento_field" name="departamento_id">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="municipio_field" class="col-md-3 form-label">Municipio</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="municipio_field" name="municipio_id">
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="tipo_documento_update" class="col-md-3 form-label">Tipo documento</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tipo_documento_update" name="tipo_documento_id">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_documento_update" class="col-md-3 form-label">Numero documento</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="numero_documento_update" name="numero_documento">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="primer_nombre_update" class="col-md-3 form-label">Primer nombre</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="primer_nombre_update" name="nombre1">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_nombre_update" class="col-md-3 form-label">Segundo nombre</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="segundo_nombre_update" name="nombre2">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="primer_apellido_update" class="col-md-3 form-label">Primer apellido</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="primer_apellido_update" name="apellido1">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_apellido_update" class="col-md-3 form-label">Segundo apellido</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="segundo_apellido_update" name="apellido2">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="genero_update" class="col-md-3 form-label">Genero</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="genero_update" name="genero_id">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="departamento_update" class="col-md-3 form-label">Departamento</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="departamento_update" name="departamento_id">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="municipio_update" class="col-md-3 form-label">Municipio</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="municipio_update" name="municipio_id">
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
