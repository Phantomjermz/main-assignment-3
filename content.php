<!-- About / Content Page -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Website Content">
       <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/footer.css">
        <title>Home</title>
    </head>
<body>
    <!-- Header Section (you can include your global header here) -->
    <header>
        <?php include 'includes/header.php'; ?>
        </header>

        <main>
        <section>
            <h2><?php echo $title; ?></h2>
            <p><?php echo $body; ?></p>
            <!-- Additional content goes here -->
        </section>
    </main>

   
     <!-- global footer here) -->
     <footer>
     <?php include 'includes/footer.php'; ?>
    </footer>
    
</body>


</html>