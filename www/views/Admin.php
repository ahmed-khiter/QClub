<?php

require_once('logic/UserManagement.php');
require_once('logic/DrinksManagement.php');

if (isset($_POST['login'])) {
    login($connection, [
       'username' => $_POST['username'],
       'password' => $_POST['password']
    ]);
}

if (isset($_GET['logout'])) {
    logout();
}

if (!isset($_SESSION['userID'])) {
    require_once('views/Login.php');
    exit;
}

if (isset($_POST['add'])) {
    addDrink($connection, [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
    ]);
}

if (isset($_POST['delete'])) {
    deleteDrink($connection, $_POST['id']);
}

if (isset($_POST['edit'])) {
    updateDrink($connection , [
       'name' => $_POST['name'],
       'price' => $_POST['price'],
       'id' => $_POST['id']
    ]);
}
?>
<a href="?view=manage&logout" class="btn btn-warning">
    <i class="fa fa-close"></i> Logout
</a>
<hr>
<h2 class="text-success"><i class="fa fa-plus"></i> Add Drinks</h2>
<form method="POST">
    <input type="hidden" name="add">
    <div class="row">
        <div class="col">
            <label>Drink Name</label>
            <input name="name" type="text" placeholder="Ex: Tea" class="form-control mb-3" required>
        </div>
        <div class="col">
            <label>Drink Price</label>
            <input name="price" type="number" min="1" placeholder="Ex: 11 L.E" class="form-control mb-3" required>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <button class="btn btn-success">
                <i class="fa fa-plus"></i> Add
            </button>
        </div>
    </div>
</form>
<hr>
<h2 class="text-primary"><i class="fa fa-coffee"></i> Drinks List</h2>
<table class="table table-bordered">
    <thead>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Action</th>
    </thead>
    <tbody>
    <?php foreach(getDrinks($connection) as $drink):?>
        <tr>
            <td><?=$drink['id']?></td>
            <td><?=$drink['Name']?></td>
            <td><?=$drink['price']?></td>
            <td>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?=$drink['id']?>">
                    <input type="hidden" name="delete">
                    <button class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                <button class="btn btn-info edit-btn"
                        data-id="<?=$drink['id']?>"
                        data-name="<?=$drink['Name']?>"
                        data-price="<?=$drink['price']?>">
                    <i class="fa fa-edit"></i>
                </button>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<!-- Modal -->
<button type="button" class="btn btn-primary edit-modal" data-toggle="modal" data-target="#exampleModal" style="display: none">
    Launch demo modal
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit Drink</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="edit-form">
                    <input type="hidden" name="edit">
                    <input type="hidden" name="id" value="">
                    <label>Drink Name</label>
                    <input type="text" name="name" value="" class="form-control mb-3">
                    <label>Drink Price</label>
                    <input type="number" min="1" name="price" value="" class="form-control mb-3">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button id="save-btn" type="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    var editForm = document.getElementById('edit-form');
    $('.edit-btn').on('click', function () {
       editForm.id.value = $(this).data('id');
       editForm.name.value = $(this).data('name');
       editForm.price.value = $(this).data('price');
       $('.edit-modal').click();
    });
    $('#save-btn').on('click', function () {
        $(this).html('<i class="fa fa-hourglass-half"></i>').attr('disabled', 'disabled');
        editForm.submit();
    });
</script>
