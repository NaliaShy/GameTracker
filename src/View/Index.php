<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/root.css">
    <link rel="stylesheet" href="../Css/Index.css">
    <link rel="stylesheet" href="../Css/darkmode.css">
    <title>GameTraker</title>
</head>

<body>
    <?php
    include '../components/header_sidebar_no_conexion.php';
    ?>

    <div class="body">
        <div class="index-search-filter-options">
            <?php
            include '../components/searchbar.php';
            ?>
        </div>
        <div class="games">
            <?php include '../components/show-games.php'; ?>
        </div>
    </div>
    
</body>

</html>