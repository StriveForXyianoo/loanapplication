<?php
include "../controllers/connections.php";
if (isset($_POST['loantype'])) {
    $loantype = $_POST['loantype'];
    $sql = "SELECT * FROM loantype WHERE TPID = '$loantype'";
    $result = mysqli_query($conn, $sql);
    ?>
    <option value="" selected disabled>Select Loan</option>
    <?php
    foreach ($result as $row) {
        ?>
        <option value="<?= $row['ID'] ?>"><?= $row['LOANTYPE'] ?></option>
        <?php
    }
}
?>