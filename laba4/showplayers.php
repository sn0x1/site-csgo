<?php
include("includes/header.php");
session_start();
include("menu.php");

if (!isset($_SESSION["session_id"])) {
    echo "<p class='error'>User not logged in.</p>";
    header("Location: login.php");
    exit();
}

if(isset($_GET['reset'])) {
    unset($_GET['search']); 
    header("Location: {$_SERVER['PHP_SELF']}"); 
    exit();
}
?>

<div id="welcome" style="width: 85%;">
    <h1><span>List of players:</span></h1>
    <form method="GET">
        <label for="search">Search by nickname:</label>
        <input type="text" id="search" name="search" placeholder="Enter nickname">
        <button type="submit">Search</button>
        <button type="submit" name="reset">Reset</button> 
    </form>

    <?php
    $whereClause = ""; 
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $whereClause = " WHERE nickname LIKE '%$search%'";
    }

    $query = mysqli_query($con, "SELECT * FROM player" . $whereClause);
    $edit_button = "https://cdn.icon-icons.com/icons2/620/PNG/32/pencil-striped-symbol-for-interface-edit-buttons_icon-icons.com_56782.png";
    $delete_button = "https://cdn.icon-icons.com/icons2/868/PNG/32/trash_bin_icon-icons.com_67981.png";

    if(mysqli_num_rows($query) > 0) {
        echo "<p>Total players: " . mysqli_num_rows($query) . "</p>";
        echo "<table style='border-collapse: collapse;'><tr><th style='padding: 8px;'>Nickname</th><th style='padding: 8px;'>First and Last name</th><th style='padding: 8px;'>Country</th><th style='padding: 8px;'>Rating</th><th style='padding: 8px;'>Actions</th></tr>";

        foreach ($query as $row) {
            echo "<tr>";
            echo "<td style='padding: 8px;'>" . $row["nickname"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["first_last_name"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["country"] . "</td>";
            echo "<td style='padding: 8px;'>" . $row["rating"] . " </td>";
            echo "<td style='padding: 8px;'><form method='post'>";
            echo "<input type='hidden' name='get_id' value='" . $row["id"] . "'>";
            if ($_SESSION["session_id"] == 10) {
                echo "<button type='submit' name='edit'><img src='$edit_button' /></button>";
                echo "<button type='submit' name='delete'><img src='$delete_button' /></button>";
            }
            echo "</form></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No players found.</p>";
    }
    ?>

    <p></p>
    <?php
    if ($_SESSION["session_id"] == 10) {
        echo "<a href='add.php' class='button'>Add new player</a>";
    }
    ?>
</div>

<?php
if (isset($_POST["edit"])) {
    $_SESSION['edit_id'] = $_POST["get_id"];
    echo "<script>location.href='edit.php';</script>";
}

if (isset($_POST["delete"])) {
    $get_id = $_POST["get_id"];
    $query = mysqli_query($con, "DELETE FROM player WHERE id='$get_id'");

    if (mysqli_error($con)) {
        $message = "This element is in the order list.";
    } else {
        $message = "Element was deleted!";
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>

<?php
if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
}
?>

<?php include("includes/footer.php"); ?>