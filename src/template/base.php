<?php 
    // require defaults PHPs
    require_once 'utils/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="application-name" content="SolveIT" />
        <meta name="description" content="UNIBO Web Project" />
        <meta name="author" content="Beleffi Leonardo, Sangiorgi Marco, Vuksan Tiziano" />
        <meta name="keywords" content="Solveit, Solvit, Solveet, Slovit, Solveti, Bug, Solution, Solve, Fix, StackOverflow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo getTitle() ?></title>
        <link rel="icon" type="image/x-icon" href="../resources/icons/logo.svg"/>
        <!-- load CSS -->
        <?php loadRemoteCSS()?>
        <?php loadCSS()?>
        <!-- load JS -->

    </head>
    <body>
        <header>
            <!-- load header -->
            <?php require getHeader()?>
        </header>

        <main>
            <!-- load main -->
            <?php require getMain()?>
        </main>

        <footer>
            <!-- load footer -->
            <?php require getFooter()?>
        </footer>
        <!-- <script>let _USERNAME = "<?php echo getUsername()?>"</script> -->
        <?php loadJS(getUsername()); setUsername(getUsername())?>
    </body>
</html>

