<?php

require_once('logic/DrinksManagement.php');
require_once('logic/OrdersManagement.php');
require_once('logic/TablesManagement.php');

if (isset($_POST['delete_order'])) {
    deleteOrder($connection, $_POST['tableNumber']);
}

if (isset($_POST['addDrinksToTables'])) {
    addOrder($connection, [
        'TableNumber' => $_POST['TableNumber'],
        'IdDrink' => $_POST['IdDrink'],
        'Description'=>"add order ".$_POST['IdDrink'],
        'Time'=>time()
    ]);
}

if (isset($_POST['deleteSingleOrder'])) {
    deleteSingleOrder($connection, $_POST['id']);
}

$drinks = getDrinks($connection);

?>
<!-- Start Add Order -->
<h2 class="text-success"><i class="fa fa-plus"></i> Add Order</h2>
<form method="POST">
    <input type="hidden" name="addDrinksToTables">
    <div class="row">
        <div class="col">
            <label>Table Number</label>
            <select name="TableNumber" class="custom-select">
                <?php foreach(getTables($connection) as $table):?>
                    <option value="<?=$table['id']?>"> <?=$table['id']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col">
            <label>Drink Name</label>
            <select name="IdDrink" id="" class="custom-select">
                <?php foreach($drinks as $drink):?>
                    <option value="<?=$drink['id']?>" ><?=$drink['Name']?> </option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-center">
            <button class="btn btn-success">
                <i class="fa fa-plus"></i> Add
            </button>

        </div>
    </div>
</form>
<hr>
<!-- End Add Order -->

<!-- Start Show Orders -->
<h2><i class="fa fa-table"></i> Orders</h2>
<table class="table table-bordered table-striped">
    <thead>
        <th>Table Number</th>
        <th>Drinks</th>
        <th>Action</th>
    </thead>
    <tbody>
    <?php foreach(getTablesUnique($connection) as $value):?>
        <tr>
            <td><?=$value['TableNumber']?></td>
            <td>
                <?php $total = 0?>
                <?php foreach (getDrinksByTableNum($connection, $value['TableNumber']) as $drink):?>
                    <div class="row">
                        <div class="col">
                            <?=$drink['Name']?>:
                        </div>
                        <div class="col">
                            <strong><?=$drink['price']?>LE</strong>
                        </div>
                        <div class="col">
                            <form method="POST">
                                <input type="hidden" name="deleteSingleOrder">
                                <input type="hidden" name="id" value="<?=$drink['order_id']?>">
                                <button class="btn btn-warning mb-2">
                                    <i class="fa fa-trash"></i> Delete This Order
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php $total += $drink['price']?>
                <?php endforeach;?>
                <hr>
                <div class="row">
                    <div class="col">
                        <span class="text-danger">Total:</span>
                    </div>
                    <div class="col">
                        <strong class="text-success"><?=$total?>LE</strong>
                    </div>
                    <div class="col"></div>
                </div>
            </td>
            <td>
                <form method="POST" >
                    <input type="hidden" name="tableNumber" value="<?=$value['TableNumber']?>">
                    <input type="hidden" name="delete_order">
                    <button class="btn btn-danger">
                        <i class="fa fa-trash"></i> Delete All
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<!-- End Show Orders -->
